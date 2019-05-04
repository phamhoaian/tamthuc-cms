<?php 
App::uses('AdminController', 'Controller');

class AdminPromotionsController extends AdminController {

    public $uses = array('TransactionManager', 'Promotion', 'Event');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Khuyến mãi'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Khuyến mãi"),
            'url'   => array('controller' => 'admin_prodotions', 'action' => 'admin_index')
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
                                'Promotion.id',
                                'Promotion.title', 
                                'Promotion.content',
                                'Promotion.status_cd',
                                'Promotion.expire_date',
                                'Promotion.created',
                                'Promotion.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Promotion');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'promotion_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        $this->Ring->bindUp('Promotion');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Promotion->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Promotion->validates($this->request->data)) {
                $params['Promotion']['title'] = json_encode(array(
                    'en' => $params['Promotion']['title_en'],
                    'vi' => $params['Promotion']['title_vi']
                ));
                $params['Promotion']['content'] = json_encode(array(
                    'en' => $params['Promotion']['content_en'],
                    'vi' => $params['Promotion']['content_vi']
                ));
                if ($this->Promotion->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo khuyến mãi mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật khuyến mãi thành công!');
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
            $promotion = $this->Promotion->findById($id);
            if(!$promotion) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $promotion['Promotion']['title_en'] = json_decode($promotion['Promotion']['title'], TRUE)['en'];
            $promotion['Promotion']['title_vi'] = json_decode($promotion['Promotion']['title'], TRUE)['vi'];
            $promotion['Promotion']['content_en'] = json_decode($promotion['Promotion']['content'], TRUE)['en'];
            $promotion['Promotion']['content_vi'] = json_decode($promotion['Promotion']['content'], TRUE)['vi'];
            $this->request->data = $promotion;
        }

        // get event list
        $event_list = array();
		$temp_events = $this->Event->find('all', array('conditions' => array('status_cd' => STATUS_PUBLIC)));
		if ($temp_events) {
			foreach ($temp_events as $event) {
				$event_list[$event['Event']['id']] = json_decode($event['Event']['title'], TRUE)['vi'];
			}
		}
		$this->set(compact('event_list'));

        $this->set('active_menu', 'promotion_edit');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm khuyến mãi mới")
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

        $promotion = $this->Promotion->findById($id);
        if ($promotion) {
            if($this->Promotion->delete($id)){
                $this->Flash->error('Xóa khuyến mãi thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa khuyến mãi này. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Khuyến mãi không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }
}
