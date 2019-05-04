<?php 
App::uses('AdminController', 'Controller');

class AdminEventsController extends AdminController {

    public $uses = array('TransactionManager', 'Event', 'EventRegister', 'Agency');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'admin';
        $this->set('page_title', __('Sự kiện'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Sự kiện"),
            'url'   => array('controller' => 'admin_events', 'action' => 'admin_index')
        ));
    }

    public function admin_index()
    {
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('Event');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'event_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_edit($id = '')
    {   
        parent::check_admin_user();
        $this->Ring->bindUp('Event');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Event->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Event->validates($this->request->data)) {
                $params['Event']['title'] = json_encode(array(
                    'en' => $params['Event']['title_en'],
                    'vi' => $params['Event']['title_vi']
                ));
                $params['Event']['content_top'] = json_encode(array(
                    'en' => $params['Event']['content_top_en'],
                    'vi' => $params['Event']['content_top_vi']
				));
				$params['Event']['content_bottom'] = json_encode(array(
                    'en' => $params['Event']['content_bottom_en'],
                    'vi' => $params['Event']['content_bottom_vi']
				));
				$params['Event']['condition'] = json_encode(array(
                    'en' => $params['Event']['condition_en'],
                    'vi' => $params['Event']['condition_vi']
                ));
                $params['Event']['agency'] = implode($params['Event']['agency'], ',');
                if ($this->Event->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo sự kiện mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật sự kiện thành công!');
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
            $event = $this->Event->findById($id);
            if(!$event) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $event['Event']['title_en'] = json_decode($event['Event']['title'], TRUE)['en'];
            $event['Event']['title_vi'] = json_decode($event['Event']['title'], TRUE)['vi'];
            $event['Event']['content_top_en'] = json_decode($event['Event']['content_top'], TRUE)['en'];
			$event['Event']['content_top_vi'] = json_decode($event['Event']['content_top'], TRUE)['vi'];
			$event['Event']['content_bottom_en'] = json_decode($event['Event']['content_bottom'], TRUE)['en'];
			$event['Event']['content_bottom_vi'] = json_decode($event['Event']['content_bottom'], TRUE)['vi'];
			$event['Event']['condition_en'] = json_decode($event['Event']['condition'], TRUE)['en'];
            $event['Event']['condition_vi'] = json_decode($event['Event']['condition'], TRUE)['vi'];
            $event['Event']['agency'] = explode(',', $event['Event']['agency']);
            $this->request->data = $event;
		}
		
		// get all agencies
		$agencies = array();
		$list_agency = $this->Agency->getAllAgency();
		if ($list_agency) {
			foreach ($list_agency as $agency) {
				$agencies[$agency['Agency']['id']] = json_decode($agency['Agency']['title'], TRUE)['vi'];
			}
		}
		$this->set(compact('agencies'));

        $this->set('active_menu', 'event_edit');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm sự kiện mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật sự kiện")
            ));
        }
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb', 'mode'));
    }

    public function admin_registered($id)
    {
        $list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'conditions' => array('event_id' => $id),
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('EventRegister');
        $this->set(compact('list', 'page'));

        $this->set('active_menu', 'event_list');

        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách đăng ký")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }

    public function admin_accept($event_id, $id) {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_registered', $event_id));
        }

        $eventRegister = $this->EventRegister->findById($id);
        if ($eventRegister) {
            $eventRegister['EventRegister']['read_flag'] = READ_FLAG;
            if($this->EventRegister->save($eventRegister)){
                $this->Flash->success('Đã duyệt đăng ký!');
                $this->redirect(array('action' => 'admin_registered', $event_id));
            }else{
                $this->Session->setFlash('Có lỗi xảy ra!');
            }
        } else {
            $this->Flash->error('Đăng ký không tồn tại!');
            $this->redirect(array('action' => 'admin_registered', $event_id));
        }
    } 
}
