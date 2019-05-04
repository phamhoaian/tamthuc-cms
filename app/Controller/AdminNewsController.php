<?php 
App::uses('AdminController', 'Controller');

class AdminNewsController extends AdminController {

    public $uses = array('TransactionManager', 'News', 'NewsCategory');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
		$this->layout = 'admin';
        $this->set('page_title', __('Tin tức'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Tin tức"),
            'url'   => array('controller' => 'admin_news', 'action' => 'admin_index')
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
                                'News.id',
                                'News.title', 
                                'News.content',
                                'News.status_cd',
                                'News.created',
                                'News.updated',
                                'NewsCategory.title'
                        ),
            'joins' => array(
                array(
                    'table' => 'news_categories',
                    'alias' => 'NewsCategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'News.cat_id = NewsCategory.id'
                    )
                )
            ),
            'order' => array('News.created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('News');
		$this->set(compact('list', 'page'));
		
		// active menu
		$this->set('active_menu', 'news_list');

		// breadcrumbs
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Danh sách")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
	}
	
	public function admin_edit($id = '')
	{
		$this->Ring->bindUp('News');
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->News->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->News->validates($this->request->data)) {
                $params['News']['title'] = json_encode(array(
                    'en' => $params['News']['title_en'],
                    'vi' => $params['News']['title_vi']
                ));
                $params['News']['content'] = json_encode(array(
                    'en' => $params['News']['content_en'],
                    'vi' => $params['News']['content_vi']
                ));
                if ($this->News->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo tin mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật tin thành công!');
                    }
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
		}
		
		// get list news categories
		$news_categories = array();
		$temp_categories = $this->NewsCategory->find('all');
		if ($temp_categories) {
			foreach ($temp_categories as $cat) {
				$news_categories[$cat['NewsCategory']['id']] = json_decode($cat['NewsCategory']['title'], TRUE)['vi'];
			}
		}
		$this->set(compact('news_categories'));

        if (!empty($id)) {
            $news = $this->News->findById($id);
            if(!$news) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $news['News']['title_en'] = json_decode($news['News']['title'], TRUE)['en'];
            $news['News']['title_vi'] = json_decode($news['News']['title'], TRUE)['vi'];
            $news['News']['content_en'] = json_decode($news['News']['content'], TRUE)['en'];
            $news['News']['content_vi'] = json_decode($news['News']['content'], TRUE)['vi'];
            $this->request->data = $news;
        }

        $this->set('active_menu', 'news_list');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm tin mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật tin")
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

        $news = $this->News->findById($id);
        if ($news) {
            if($this->News->delete($id)){
                $this->Flash->error('Xóa tin thành công!');
                $this->redirect(array('action' => 'admin_index'));
            }else{
                $this->Session->setFlash('Không thể xóa tin này. Vui lòng thử lại.');
            }
        } else {
            $this->Flash->error('Tin không tồn tại!');
            $this->redirect(array('action' => 'admin_index'));
        }
    }

	public function admin_categories()
	{
		$list = array();
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        $this->paginate = array(
            'limit' => PAGI_LIMIT,
            'page' => 1,
            'fields' => array(
                                'NewsCategory.id',
                                'NewsCategory.title',
                                'NewsCategory.status_cd',
                                'NewsCategory.created',
                                'NewsCategory.updated'
                        ),
            'order' => array('created' => 'desc'),
            'paramType' => 'querystring',
        );

        $list = $this->paginate('NewsCategory');
        $this->set(compact('list', 'page'));

		// active menu
		$this->set('page_title', __('Thể loại'));
		$this->set('active_menu', 'news_categories');

		// breadcrumbs
		$this->Breadcrumb->addCrumb(array(
            'title'	=> __("Thể loại")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
	}

	public function admin_category_edit($id = '')
	{
        if ($this->request->is('post') || $this->request->is('put')) {
            $params = $this->request->data;
            $this->NewsCategory->set($params);
            $trans = $this->TransactionManager->begin();
            if ($this->NewsCategory->validates($this->request->data)) {
                $params['NewsCategory']['title'] = json_encode(array(
                    'en' => $params['NewsCategory']['title_en'],
                    'vi' => $params['NewsCategory']['title_vi']
                ));
                if ($this->NewsCategory->save($params)) {
                    $this->TransactionManager->commit($trans);
                    if (empty($id)) {
                        $this->Flash->success('Tạo thể loại mới thành công!');
                    } else {
                        $this->Flash->success('Cập nhật thể loại thành công!');
                    }
                    $this->redirect(array('action' => 'admin_categories'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_categories'));
                }
            }
        }

        if (!empty($id)) {
            $news_category = $this->NewsCategory->findById($id);
            if(!$news_category) {
                $this->Flash->error('Trang không tồn tại!');
                $this->redirect(array('action' => 'admin_index'));
            }
            $news_category['NewsCategory']['title_en'] = json_decode($news_category['NewsCategory']['title'], TRUE)['en'];
            $news_category['NewsCategory']['title_vi'] = json_decode($news_category['NewsCategory']['title'], TRUE)['vi'];
            $this->request->data = $news_category;
        }

		$this->set('page_title', __('Thể loại'));
        $this->set('active_menu', 'news_categories');

        if (empty($id)) {
            $mode = 'create';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Thêm thể loại mới")
            ));
        } else {
            $mode = 'edit';
            $this->Breadcrumb->addCrumb(array(
                'title'	=> __("Cập nhật thể loại")
            ));
        }
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb', 'mode'));
    }
    
    public function admin_category_delete($id)
    {
        if ( ! $id) {
            $this->Flash->error('Có lỗi xảy ra!');
            $this->redirect(array('action' => 'admin_index'));
        }

        $news_category = $this->NewsCategory->findById($id);
        if ($news_category) {
            $news_belong_to_category = $this->News->findByCatId($news_category['NewsCategory']['id']);
            if ($news_belong_to_category) {
                $this->Flash->error('Vui lòng xóa tất cả tin tức thuộc thể loại này!');
                $this->redirect(array('action' => 'admin_categories'));
            } else {
                if ($this->NewsCategory->delete($id)) {
                    $this->Flash->error('Xóa thể loại thành công!');
                    $this->redirect(array('action' => 'admin_categories'));
                } else {
                    $this->Session->setFlash('Không thể xóa thể loại này. Vui lòng thử lại.');
                }
            }
        } else {
            $this->Flash->error('Thể loại không tồn tại!');
            $this->redirect(array('action' => 'admin_categories'));
        }
    }
}