<?php 
App::uses('AdminController', 'Controller');

class AdminPagesController extends AdminController {

    public $uses = array('TransactionManager', 'Page');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Quản lý trang'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
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
                                'Page.id',
                                'Page.title', 
                                'Page.content',
                                'Page.status_cd',
                                'Page.created',
                                'Page.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Page');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'pages_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách trang tĩnh")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Page');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Page->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Page->validates($this->request->data)) {
                $params['Page']['title'] = json_encode(array(
                    'en' => $params['Page']['title_en'],
                    'vi' => $params['Page']['title_vi']
                ));
                $params['Page']['content'] = json_encode(array(
                    'en' => $params['Page']['content_en'],
                    'vi' => $params['Page']['content_vi']
                ));
                if ($this->Page->save($params)) {
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
            $page = $this->Page->findById($id);
            if(!$page) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $page['Page']['title_en'] = json_decode($page['Page']['title'], TRUE)['en'];
            $page['Page']['title_vi'] = json_decode($page['Page']['title'], TRUE)['vi'];
            $page['Page']['content_en'] = json_decode($page['Page']['content'], TRUE)['en'];
            $page['Page']['content_vi'] = json_decode($page['Page']['content'], TRUE)['vi'];
            $this->request->data = $page;
        }

        $this->set('active_menu', 'pages_edit');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách trang tĩnh"),
            'url'   => array('controller' => 'admin_pages', 'action' => 'admin_index')
        ));
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

        $page = $this->Page->findById($id);
        if ($page) {
            if($this->Page->delete($id)){
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
