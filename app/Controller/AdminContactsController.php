<?php 
App::uses('AdminController', 'Controller');

class AdminContactsController extends AdminController {

    public $uses = array('TransactionManager', 'Contact', 'Agency');

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Liên hệ'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Liên hệ"),
            'url'   => array('controller' => 'admin_contacts', 'action' => 'admin_index')
        ));
    }

    public function admin_index()
    {
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'order' => array('Contact.created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Contact');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'contact_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Chi nhánh")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_accept($id) {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $contact = $this->Contact->findById($id);
        if ($contact) {
            $contact['Contact']['read_flag'] = READ_FLAG;
            if($this->Contact->save($contact)){
                $this->Flash->success('Đã duyệt yêu cầu!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Có lỗi xảy ra!');
            }
        } else {
            $this->Flash->error('Liên hệ không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    } 

    public function admin_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $contact = $this->Contact->findById($id);
        if ($contact) {
            if($this->Contact->delete($id)){
                $this->Flash->success('Xóa thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Liên hệ không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_agency()
    {
        $list = $this->Agency->find('all');
        $this->set(compact('list'));

        $this->set('active_menu', 'contact_agency');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Chi nhánh")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_agency_edit($id = '')
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Agency->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Agency->validates($this->request->data)) {
                $params['Agency']['title'] = json_encode(array(
                    'en' => $params['Agency']['title_en'],
                    'vi' => $params['Agency']['title_vi']
                ));
                $params['Agency']['content'] = json_encode(array(
                    'en' => $params['Agency']['content_en'],
                    'vi' => $params['Agency']['content_vi']
                ));
                if ($this->Agency->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo chi nhánh mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật chi nhánh thành công!');
                    }
                    $this->redirect(array('action' => 'admin_agency'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_agency'));
                }
            }
        }

        if (!empty($id)) {
            $agency = $this->Agency->findById($id);
            if(!$agency) {
                $this->Flash->error('Chi nhánh không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $agency['Agency']['title_en'] = json_decode($agency['Agency']['title'], TRUE)['en'];
            $agency['Agency']['title_vi'] = json_decode($agency['Agency']['title'], TRUE)['vi'];
            $agency['Agency']['content_en'] = json_decode($agency['Agency']['content'], TRUE)['en'];
            $agency['Agency']['content_vi'] = json_decode($agency['Agency']['content'], TRUE)['vi'];
            $this->request->data = $agency;
        }

        $this->set('active_menu', 'contact_agency');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm chi nhánh mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật chi nhánh")
            ));
        }
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb', 'mode'));
    }

    public function admin_agency_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $agency = $this->Agency->findById($id);
        if ($agency) {
            if($this->Agency->delete($id)){
                $this->Flash->error('Xóa chi nhánh thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa chi nhánh này. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Chi nhánh không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }
}
