<?php 
/**
* Breadcrumbs Component
*/
class BreadcrumbComponent extends Component
{
	protected $_crumbs = array();

	public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function addCrumb($params = array()) 
    {
        if (isset($params['title']) && !empty($params['title'])) 
        {
            $title = $params['title'];

            if (isset($params['url']) && !empty($params['url'])) 
            {
                $link = $params['url'];
            }
            else 
            {
                $link = null;
            }

            if (isset($params['options']) && !empty($params['options'])) 
            {
                $options = $params['options'];
            }
            else 
            {
                $options = null;
            }
            $this->_crumbs[] = array($title, $link, $options);
        }
		return false;
    }

    public function getCrumbs()
    {
    	return $this->_crumbs;
    }
}