<?php 
App::uses('AdminController', 'Controller');

class AdminFeaturesController extends AdminController {

    public $uses = array('TransactionManager', 'Feature', 'Optional');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->Auth->allow(array('admin_add_more_step', 'admin_remove_step'));
        $this->layout = 'admin';
        $this->set('page_title', __('Nét đặc sắc'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Nét đặc sắc"),
            'url'   => array('controller' => 'admin_features', 'action' => 'admin_index')
        ));
    }

    public function admin_index()
    {
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'fields' => array(
                                'Feature.id',
                                'Feature.title', 
                                'Feature.content',
                                'Feature.status_cd',
                                'Feature.created',
                                'Feature.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Feature');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'feature_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Feature');
        $this->Ring->bindUp('Optional');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Feature->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Feature->validates($this->request->data)) {
                $resFeature = $resOptional = true;
                $params['Feature']['title'] = json_encode(array(
                    'en' => $params['Feature']['title_en'],
                    'vi' => $params['Feature']['title_vi']
                ));
                $params['Feature']['content'] = json_encode(array(
                    'en' => $params['Feature']['content_en'],
                    'vi' => $params['Feature']['content_vi']
                ));
                $resFeature = $this->Feature->save($params['Feature']);
                if (!empty($params['Optional'])) {
                    $sort_order_how_to_enjoy = $params['sort_order_how_to_enjoy'] ? explode(',', $params['sort_order_how_to_enjoy']) : array();
                    $sort_order_sauce = $params['sort_order_sauce'] ? explode(',', $params['sort_order_sauce']) : array();
                    // prepare optional data
                    foreach ($params['Optional'] as $key => $optional) {
                        if (empty($optional['content_en']) && empty($optional['content_vi']) && empty($optional['top_pic'])) {
                            unset($params['Optional'][$key]);
                            continue;
                        }
                        $params['Optional'][$key]['content'] = json_encode(array(
                            'en' => $optional['content_en'],
                            'vi' => $optional['content_vi']
                        ));
                        $params['Optional'][$key]['model'] = 'Feature';
                        $params['Optional'][$key]['model_id'] = $id ? $id : $this->Feature->id;
                        $params['Optional'][$key]['sort_order'] = $optional['id'] ? array_search($optional['id'], $optional['cat_id'] == OPTIONAL_HOW_TO_ENJOY ? $sort_order_how_to_enjoy : $sort_order_sauce) + 1 : null;
                    }
                    $resOptional = $this->Optional->saveMany($params['Optional']);
                }
                
                if ($resFeature && $resOptional) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo trang mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật trang thành công!');
                    }
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        }

        if (!empty($id)) {
            $feature = $this->Feature->findById($id);
            if(!$feature) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $feature['Feature']['title_en'] = json_decode($feature['Feature']['title'], TRUE)['en'];
            $feature['Feature']['title_vi'] = json_decode($feature['Feature']['title'], TRUE)['vi'];
            $feature['Feature']['content_en'] = json_decode($feature['Feature']['content'], TRUE)['en'];
            $feature['Feature']['content_vi'] = json_decode($feature['Feature']['content'], TRUE)['vi'];
            $this->request->data = $feature;

            $optional_enjoy = $this->Optional->findOptionalByModel('Feature', $id, OPTIONAL_HOW_TO_ENJOY);
            if ($optional_enjoy) {
                foreach ($optional_enjoy as &$enjoy) {
                    $enjoy['Optional']['content_en'] = json_decode($enjoy['Optional']['content'], TRUE)['en'];
                    $enjoy['Optional']['content_vi'] = json_decode($enjoy['Optional']['content'], TRUE)['vi'];
                }
                unset($enjoy);
            }
            $this->set(compact('optional_enjoy'));
            $optional_sauce = $this->Optional->findOptionalByModel('Feature', $id, OPTIONAL_SAUCE);
            if ($optional_sauce) {
                foreach ($optional_sauce as &$sauce) {
                    $sauce['Optional']['content_en'] = json_decode($sauce['Optional']['content'], TRUE)['en'];
                    $sauce['Optional']['content_vi'] = json_decode($sauce['Optional']['content'], TRUE)['vi'];
                }
                unset($sauce);
            }
            $this->set(compact('optional_sauce'));
        }

        $this->set('active_menu', 'feature_edit');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm trang mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật trang")
            ));
        }
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb', 'mode'));
    }

    public function admin_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $feature = $this->Feature->findById($id);
        if ($feature) {
            if($this->Feature->delete($id)){
                $this->Flash->error('Xóa trang thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa trang này. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Trang không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_add_more_step()
    {
        // disable layout template
        $this->layout = 'ajax';
        $this->autoRender = false;

        // create view
        $view = new View($this, false);

        // params
        $type = $this->request->data('type');
        $key = $this->request->data('key');
        $view->set(compact('key', 'type'));

        // render view
        $content = $view->element('admin_features/step');
        return $content;
    }

    public function admin_remove_step()
    {
        // disable layout template
        $this->layout = 'ajax';
        $this->autoRender = false;

        // params
        $step_id = $this->request->data('step_id');
        $res = $this->Optional->delete(array('id' => $step_id));
        if ($res) {
            return json_encode(array('error' => false, 'message' => 'Xóa thành công'));
        } else {
            return json_encode(array('error' => true));
        }
    }
}
