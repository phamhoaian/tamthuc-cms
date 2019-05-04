<?php
/**
 * Application model for Cake.
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 * @package       app.Model
 */
class AppModel extends Model
{
    public $recursive = -1;

    public function begin()
    {
        $dataSource = $this->getDataSource();
        $dataSource->begin();
    }

    public function commit()
    {
        $dataSource = $this->getDataSource();
        $dataSource->commit();
    }

    public function rollback()
    {
        $dataSource = $this->getDataSource();
        $dataSource->rollback();
    }

    //validate file size custom
    public function validFileSize($value, $validSize) {
        
        if(!is_array($value)) return false;
        $file = array_shift($value);
        if(!isset($file['size'])) return false;
        
        $size = $file['size'];
        $validSize = $this->calcFileSizeUnit($validSize);
        
        if($size <= $validSize) return true;
        return false;
        
    }
    public function calcFileSizeUnit($size)
    {
        $units = array(
                'K', 'M', 'G', 'T'
        );
        $byte  = 1024;
        if(is_numeric($size) || is_int($size)){
            return $size;
        }else if(is_string($size)
                 && preg_match('/^([0-9]+(?:\.[0-9]+)?)('.implode('|', $units).')B?$/i', $size, $matches)
        ){
            return $matches[1] * pow($byte, array_search($matches[2], $units) + 1);
        }
        return false;
    }

    public function validOnlyNumber($input){
        $value = array_values($input)[0];
        
        if(empty($value)) return true;
        $pattern = '/^[0-9]*$/i';
        $res =  preg_match($pattern, $value);
        return $res?true:false;
    }

    public function validEtherAddress($data) {
        $data = array_values($data);
        $token = strtolower($data[0]);
        if( strlen($token) <> 42 ) return false; 
        $prefix = substr($token, 0, 2);
        if($prefix != '0x') return false;
        return true;
    }

    public function contentMaxLength($input, $max)
    {
        return mb_strlen(strip_tags(array_values($input)[0])) <= $max;
    }
}
