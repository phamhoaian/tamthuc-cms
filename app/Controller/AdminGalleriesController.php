<?php 
App::uses('AdminController', 'Controller');

class AdminGalleriesController extends AdminController {

    public $uses = array('TransactionManager', 'Gallery');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Hình ảnh'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Hình ảnh"),
            'url'   => array('controller' => 'admin_galleris', 'action' => 'admin_index')
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
                                'Gallery.id',
                                'Gallery.title', 
                                'Gallery.status_cd',
                                'Gallery.created',
                                'Gallery.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Gallery');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'gallery_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Gallery');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Gallery->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Gallery->validates($this->request->data)) {
                $params['Gallery']['title'] = json_encode(array(
                    'en' => $params['Gallery']['title_en'],
                    'vi' => $params['Gallery']['title_vi']
                ));
                if ($this->Gallery->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo hình ảnh mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật hình ảnh thành công!');
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
            $gallery = $this->Gallery->findById($id);
            if(!$gallery) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $gallery['Gallery']['title_en'] = json_decode($gallery['Gallery']['title'], TRUE)['en'];
            $gallery['Gallery']['title_vi'] = json_decode($gallery['Gallery']['title'], TRUE)['vi'];
            $this->request->data = $gallery;
        }

        $this->set('active_menu', 'gallery_list');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm hình ảnh mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật hình ảnh")
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

        $gallery = $this->Gallery->findById($id);
        if ($gallery) {
            if($this->Gallery->delete($id)){
                $this->Flash->error('Xóa hình ảnh thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa hình ảnh này. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Hình ảnh không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }
}
