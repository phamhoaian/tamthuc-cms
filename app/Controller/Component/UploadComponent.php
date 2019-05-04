<?php 
/**
* Upload Component
*/
class UploadComponent extends Component
{
    public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function uploadImageBase64($file, $file_type = 'jpg')
    {
        if (!$file) {
            return false;
        }
        list($type, $file) = explode(';', $file);
        list(, $file)      = explode(',', $file);
        $imgbase64 = base64_decode($file);
        $imgbase64_path = Configure::read('file_path').'tmp'.DS.'imgbase64_'.date('YmdHis').'.'.$file_type;
        file_put_contents($imgbase64_path, $imgbase64);
        return $imgbase64_path;
    }
}