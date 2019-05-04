<?php 
App::uses('AdminController', 'Controller');

class AdminMenusController extends AdminController {

    public $uses = array('TransactionManager', 'Menu');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Thực đơn'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Thực đơn"),
            'url'   => array('controller' => 'admin_menus', 'action' => 'admin_index')
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
                                'Menu.id',
                                'Menu.title', 
                                'Menu.content',
                                'Menu.status_cd',
                                'Menu.created',
                                'Menu.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Menu');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'menu_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Menu');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Menu->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Menu->validates($this->request->data)) {
                $params['Menu']['title'] = json_encode(array(
                    'en' => $params['Menu']['title_en'],
                    'vi' => $params['Menu']['title_vi']
                ));
                $params['Menu']['content'] = json_encode(array(
                    'en' => $params['Menu']['content_en'],
                    'vi' => $params['Menu']['content_vi']
                ));
                if ($this->Menu->save($params)) {
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
            $menu = $this->Menu->findById($id);
            if(!$menu) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $menu['Menu']['title_en'] = json_decode($menu['Menu']['title'], TRUE)['en'];
            $menu['Menu']['title_vi'] = json_decode($menu['Menu']['title'], TRUE)['vi'];
            $menu['Menu']['content_en'] = json_decode($menu['Menu']['content'], TRUE)['en'];
            $menu['Menu']['content_vi'] = json_decode($menu['Menu']['content'], TRUE)['vi'];
            $this->request->data = $menu;
        }

        $this->set('active_menu', 'menu_edit');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm thực đơn mới")
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

        $menu = $this->Menu->findById($id);
        if ($menu) {
            if($this->Menu->delete($id)){
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
