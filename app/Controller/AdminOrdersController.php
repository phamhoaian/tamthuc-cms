<?php 
App::uses('AdminController', 'Controller');

class AdminOrdersController extends AdminController {

    public $uses = array('Order', 'Agency');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'admin';
        $this->set('page_title', __('Đặt bàn'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Đặt bàn"),
            'url'   => array('controller' => 'admin_orders', 'action' => 'admin_index')
        ));
    }

    public function admin_index()
    {
		// get all agencies
		$agencies = $this->Agency->find('list', array(
			'fields' => array('Agency.id', 'Agency.title')
		));
		$this->set(compact('agencies'));
		
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'order' => array('Order.created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Order');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'order_table');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Đặt bàn")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
	}
	
	public function admin_accept($id) {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $order = $this->Order->findById($id);
        if ($order) {
            $order['Order']['read_flag'] = READ_FLAG;
            if($this->Order->save($order)){
                $this->Flash->success('Đã duyệt đặt bàn!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Có lỗi xảy ra!');
            }
        } else {
            $this->Flash->error('Yêu cầu không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    } 

    public function admin_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $order = $this->Order->findById($id);
        if ($order) {
            if($this->Order->delete($id)){
                $this->Flash->success('Xóa thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Đặt bàn không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }
}
