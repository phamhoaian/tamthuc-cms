<?php 
App::uses('AdminController', 'Controller');

class AdminVipMembersController extends AdminController {

    public $uses = array('TransactionManager', 'Policy', 'Request');

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Thành viên VIP'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
    }

    public function admin_policy()
    {   
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Policy->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Policy->validates($this->request->data)) {
                $params['Policy']['content'] = json_encode(array(
                    'en' => $params['Policy']['content_en'],
                    'vi' => $params['Policy']['content_vi']
                ));
                if ($this->Policy->save($params)) {
                    $this->TransactionManager->commit($trans);
                    $this->Flash->success('Cập nhật chính sách thành viên thành công!');
                    $this->redirect(array('action' => 'admin_request'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_request'));
                }
            }
        }

        $policy = $this->Policy->find('first');
        if($policy) {
            $policy['Policy']['content_en'] = json_decode($policy['Policy']['content'], TRUE)['en'];
            $policy['Policy']['content_vi'] = json_decode($policy['Policy']['content'], TRUE)['vi'];
            $this->request->data = $policy;
        }

        $this->set('active_menu', 'vip_member_policy');

        // breadcrumbs
        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Thành viên VIP")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_request()
    {
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'fields' => array(
                                'Request.id',
                                'Request.name', 
                                'Request.email',
                                'Request.phone',
                                'Request.created',
                                'Request.updated',
                                'Request.read_flag'
                        ),
            'order' => array('Request.created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Request');
        $this->set(compact('list', 'page'));
		
		// active menu
		$this->set('active_menu', 'vip_member_request');

		// breadcrumbs
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Yêu cầu xem điểm tích lũy")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_accept($id) {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_request'));
        }

        $request = $this->Request->findById($id);
        if ($request) {
            $request['Request']['read_flag'] = READ_FLAG;
            if($this->Request->save($request)){
                $this->Flash->success('Đã duyệt yêu cầu!');
                $this->redirect(array('action' => 'admin_request'));
            }else{
                $this->Session->setFlash('Có lỗi xảy ra!');
            }
        } else {
            $this->Flash->error('Yêu cầu không tồn tại!');
            $this->redirect(array('action' => 'admin_request'));
        }
    } 

    public function admin_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_request'));
        }

        $request = $this->Request->findById($id);
        if ($request) {
            if($this->Request->delete($id)){
                $this->Flash->success('Xóa thành công!');
                $this->redirect(array('action' => 'admin_request'));
            }else{
                $this->Session->setFlash('Không thể xóa. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Yêu cầu không tồn tại!');
            $this->redirect(array('action' => 'admin_request'));
        }
    }
}
