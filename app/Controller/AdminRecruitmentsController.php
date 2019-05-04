<?php 
App::uses('AdminController', 'Controller');

class AdminRecruitmentsController extends AdminController {

    public $uses = array('TransactionManager', 'Recruitment');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Tuyển dụng'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
    }

    public function admin_index()
    {   
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->Recruitment->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->Recruitment->validates($this->request->data)) {
                $params['Recruitment']['content'] = json_encode(array(
                    'en' => $params['Recruitment']['content_en'],
                    'vi' => $params['Recruitment']['content_vi']
                ));
                if ($this->Recruitment->save($params)) {
                    $this->TransactionManager->commit($trans);
                    $this->Flash->success('Cập nhật tin tuyển dụng thành công!');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        }

        $recruitment = $this->Recruitment->find('first');
        if($recruitment) {
            $recruitment['Recruitment']['content_en'] = json_decode($recruitment['Recruitment']['content'], TRUE)['en'];
            $recruitment['Recruitment']['content_vi'] = json_decode($recruitment['Recruitment']['content'], TRUE)['vi'];
            $this->request->data = $recruitment;
        }

        $this->set('active_menu', 'recruitment');

        // breadcrumbs
        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Tuyển dụng")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }
}
