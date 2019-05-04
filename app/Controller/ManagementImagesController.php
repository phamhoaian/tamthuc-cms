<?php
App::uses('AppController', 'Controller');

class ManagementImagesController extends AppController {

	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow(array('load', 'upload', 'delete'));
		$this->autoRender = false;
    	$this->layout = 'ajax';
	}

	public function load()
	{
		// Load the images.
		try {
			$response = FroalaEditor_Image::getList('/app/webroot/uploads/Editor/');
			echo stripslashes(json_encode($response));
		}
		catch (Exception $e) {
			http_response_code(404);
		}
	}

	public function upload()
	{
		$options = array(
			'validation' => array(
				'allowedExts' => array('gif', 'jpeg', 'jpg', 'png', 'svg', 'blob'),
				'allowedMimeTypes' => array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/svg+xml')
			)
		);

		// Store the image.
		try {
			$response = FroalaEditor_Image::upload('/app/webroot/uploads/Editor/', $options);
			echo stripslashes(json_encode($response));
		}
		catch (Exception $e) {
			http_response_code(404);
		}
	}

	public function delete()
	{
		// Delete the image.
		try {
			$response = FroalaEditor_Image::delete($_POST['src']);
			echo stripslashes(json_encode('Success'));
		}
		catch (Exception $e) {
			http_response_code(404);
		}
	}
}