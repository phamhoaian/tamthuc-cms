<?php 
App::uses('AdminController', 'Controller');

class AdminIntroductionsController extends AdminController {

    public $uses = array('TransactionManager', 'Introduction');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Giới thiệu'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __('Giới thiệu'),
            'url'   => array('controller' => 'admin_introductions', 'action' => 'admin_index')
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
                                'Introduction.id',
                                'Introduction.title', 
                                'Introduction.content',
                                'Introduction.status_cd',
                                'Introduction.created',
                                'Introduction.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Introduction');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'introduction_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Introduction');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Introduction->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Introduction->validates($this->request->data)) {
                $params['Introduction']['title'] = json_encode(array(
                    'en' => $params['Introduction']['title_en'],
                    'vi' => $params['Introduction']['title_vi']
                ));
                $params['Introduction']['content'] = json_encode(array(
                    'en' => $params['Introduction']['content_en'],
                    'vi' => $params['Introduction']['content_vi']
                ));
                if ($this->Introduction->save($params)) {
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
            $introduction = $this->Introduction->findById($id);
            if(!$introduction) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $introduction['Introduction']['title_en'] = json_decode($introduction['Introduction']['title'], TRUE)['en'];
            $introduction['Introduction']['title_vi'] = json_decode($introduction['Introduction']['title'], TRUE)['vi'];
            $introduction['Introduction']['content_en'] = json_decode($introduction['Introduction']['content'], TRUE)['en'];
            $introduction['Introduction']['content_vi'] = json_decode($introduction['Introduction']['content'], TRUE)['vi'];
            $this->request->data = $introduction;
        }

        $this->set('active_menu', 'introduction_edit');

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

        $introduction = $this->Introduction->findById($id);
        if ($introduction) {
            if($this->Introduction->delete($id)){
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
}
