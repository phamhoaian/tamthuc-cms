<?php
class CommonComponent extends Component
{
    public function createDir($dir) {
        if (trim($dir) == "")
            return false;
        if (is_dir($dir) == false) {
            return mkdir($dir, 0777);
        }
        return false;
    }

    function parseImageToTemp($image_data, $filename) {
        try {
            $upload_dir = TMP_DIR;
            $this->createDir(WWW_ROOT . $upload_dir);
            $ifp = fopen(WWW_ROOT . $upload_dir . $filename, "wb");
            fwrite($ifp, $image_data); 
            fclose($ifp);
            return $filename;
        } catch (Exception $e) {
            return false;
        }
    }

    function moveTempFileToUpload($file, $user_dir = '', $model, $field_name) {
    	if(empty($file)) return false;
    	try {
            $upload_dir = UPLOAD_DIR. $model .'/';
            $this->createDir(WWW_ROOT . $upload_dir);
            $upload_dir .= ($user_dir . '/');
            $this->createDir($upload_dir);
            $upload_dir .= ($field_name . '/');
            $this->createDir($upload_dir);

            $dest_full_path = WWW_ROOT . $upload_dir . $file;
            $source = WWW_ROOT . TMP_DIR . $file;

            if(file_exists($source)){
            	$res = copy($source, $dest_full_path);
            	unlink($source);
            	return $res;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function dateDiff($date_1, $date_2)
    {
        $datetime1 = strtotime($date_1);
        $datetime2 = strtotime($date_2);
       
        $interval = abs($datetime2 - $datetime1);
        $intervalHours = $interval/3600;
        
        return $intervalHours;
    }

    public function parseErrors($errors) {
        $res = array();
        foreach ($errors as $key => $value) {
            $res[$key] = $value[0];
        }
        return $res;
    }

    public function getCurrentBalance($user_id, $sponsee_id, $own_address = false){
        if(empty($user_id)) return 0;
        $user_model = ClassRegistry::init('User');
        $user_data = $user_model->findById($user_id);

        $coin_model = ClassRegistry::init('Coin');
        $coin_data = $coin_model->findBySponseeId($sponsee_id);
        $coin_address = '';
        if(!empty($coin_data['Coin']['coin_address'])) {
            $coin_address = $coin_data['Coin']['coin_address'];
        }

        $sc_url = Configure::read('sc_url');
        
        if(!$user_data) {
            return 0;
        }
        
        if(!$user_id != $sponsee_id){
            $ether_address = $user_data['User']['ether_address'];
        }
        else{
            $ether_address = $coin_data['Coin']['received_address'];
        }

        
        $data = array('address' => $ether_address);
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $sc_url.'/get-balance');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec ($ch);

        $info = curl_getinfo($ch);
        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($server_output, true);
            
            if(isset($data['state']) && 
                $data['state'] == 'success') {
                $balance_list = $data['data'];
                
                foreach ($balance_list as $key => $balance) {
                    if(!$own_address){
                        if(strtolower($coin_address) == $balance['tokenAddress']) {
                            return (int)$balance['value'];
                        }
                    }
                    else{
                        if(strtolower($own_address) == $balance['tokenAddress']){
                            return (int)$balance['value'];
                        }
                    }
                }
            }
            return 0;
        }
        return 0;
    }

    public function getCurrentBalanceAddress($ether_address, $sponsee_id){
        if(empty($ether_address)) return 0;

        $coin_model = ClassRegistry::init('Coin');
        $coin_data = $coin_model->findBySponseeId($sponsee_id);
        $coin_address = '';
        if(!empty($coin_data['Coin']['coin_address'])) {
            $coin_address = $coin_data['Coin']['coin_address'];
        }

        $sc_url = Configure::read('sc_url');
        
        $data = array('address' => $ether_address);
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $sc_url.'/get-balance');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec ($ch);

        $info = curl_getinfo($ch);
        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($server_output, true);
            
            if(isset($data['state']) && 
                $data['state'] == 'success') {
                $balance_list = $data['data'];
                
                foreach ($balance_list as $key => $balance) {
                    if(strtolower($coin_address) == $balance['tokenAddress']) {
                        return (int)$balance['value'];
                    }
                }
            }
            return 0;
        }
        return 0;
    }

    public function getReceivedBalance($sponsee_id){
        if(empty($sponsee_id)) return 0;
        $user_model = ClassRegistry::init('User');
        $user_data = $user_model->findById($sponsee_id);

        $coin_model = ClassRegistry::init('Coin');
        $coin_data = $coin_model->findBySponseeId($sponsee_id);
        $coin_address = '';



        if(!empty($coin_data['Coin']['coin_address'])) {
            $coin_address = $coin_data['Coin']['coin_address'];
            $received_address = $this->getSponseeReceivedAddress($coin_address);
        }
        else{
            return 0;
        } 

        if(strtolower($received_address) == strtolower($user_data['User']['ether_address'])) {
            return 0;
        } 

        $sc_url = Configure::read('sc_url');
        $data = array('address' => $received_address);
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $sc_url.'/get-balance');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec ($ch);

        $info = curl_getinfo($ch);
        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($server_output, true);
            
            if(isset($data['state']) && 
                $data['state'] == 'success') {
                $balance_list = $data['data'];
                
                foreach ($balance_list as $key => $balance) {
                    if(strtolower($coin_address) == $balance['tokenAddress']) {
                        return (int)$balance['value'];
                    }
                }
            }
            return 0;
        }
        return 0;
    }

    public function getCurrencyRate(){
        $ExchangeRate = ClassRegistry::init('ExchangeRate');
        $currentEx = $ExchangeRate->find('first');
        if($currentEx) {
            $lastUpdated = $currentEx['ExchangeRate']['usd_yen_updated'];
            $diff = $this->dateDiff($lastUpdated, date('Y-m-d H:i:s')) * 60; // in minutes

            if($diff > 60) {
                $rate = $this->_requestLayer();
                if($rate !== false){
                    $currentEx['ExchangeRate']['usd_yen_rate'] = $rate;
                    $currentEx['ExchangeRate']['usd_yen_updated'] = date('Y-m-d H:i:s');
                    $ExchangeRate->save($currentEx);
                    return $rate;
                }
                return $currentEx['ExchangeRate']['usd_yen_rate'];
            }
            else{
                return $currentEx['ExchangeRate']['usd_yen_rate'];
            } 
        }
        else{
            $rate = $this->_requestLayer();
            if($rate !== false){
                $currentEx['usd_yen_updated'] = date('Y-m-d H:i:s');
                $currentEx['usd_yen_rate'] = $rate;
                $ExchangeRate->save($currentEx);
                return $rate;
            }
        }
        return 0;
    }

    public function getEtherRate(){
        $ExchangeRate = ClassRegistry::init('ExchangeRate');
        $currentEx = $ExchangeRate->find('first');
        if($currentEx) {
            $lastUpdated = $currentEx['ExchangeRate']['eth_cent_updated'];
            $diff = $this->dateDiff($lastUpdated, date('Y-m-d H:i:s')) * 5; // in minutes

            if($diff > 5) {
                $rate = $this->_getEthRate();
                if($rate !== false){
                    $currentEx['ExchangeRate']['eth_cent_rate'] = $rate;
                    $currentEx['ExchangeRate']['eth_cent_updated'] = date('Y-m-d H:i:s');
                    $ExchangeRate->save($currentEx);
                    return $rate;
                }
                else{
                    return $currentEx['ExchangeRate']['eth_cent_rate'];
                } 
            }
            else{
                return $currentEx['ExchangeRate']['eth_cent_rate'];
            } 
        }
        else{
            $rate = $this->_getEthRate();
            $currentEx['eth_cent_updated'] = date('Y-m-d H:i:s');
            $currentEx['eth_cent_rate'] = $rate;
            $ExchangeRate->save($currentEx);
            return $rate;
        }
        return 0;
    }

    private function _requestLayer(){
        $endpoint = 'live';
        // $access_key = '6470dbbfce3ab80492ba4ec721555904';
        $setting_model = ClassRegistry::init('Setting');
        $setting_data = $setting_model->find('first');
        $access_key = $setting_data['Setting']['currency_layer_key'];
        // Initialize CURL:
        $ch = curl_init(API_LAYER.$endpoint.'?access_key='.$access_key.'&currencies=JPY&source=USD&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->log('APILAYER:'.date('Y-m-d H:i:s'), LOG_DEBUG);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);
        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $rate = json_decode($json, true);
            return isset($rate['quotes']['USDJPY']) ? $rate['quotes']['USDJPY'] : false;
        }
        return false;
    }

    private function _getEthRate(){
        $sc_url = Configure::read('sc_url');

        $ch = curl_init($sc_url. '/get-rate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $rate = json_decode($json, true);
            if($rate['state'] == 'success'){
                return $rate['data']['value'];
            }
        }
        return false;
    }

    public function getSponseeTotalSupport($tokenAddress){
        $sc_url = Configure::read('sc_url');
        $data = array('tokenAddress' => $tokenAddress);

        $ch = curl_init($sc_url. '/get-total-support');

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($json, true);
            if($data['state'] == 'success'){
                return (float)$data['data']/WEI_NUMBER;
            }
        }
        return 0;
    }

    public function getSponseeReceivedAddress($tokenAddress){
        $sc_url = Configure::read('sc_url');
        $data = array('tokenAddress' => $tokenAddress);

        $ch = curl_init($sc_url. '/get-sponsee');

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($json, true);
            if($data['state'] == 'success'){
                return $data['data'];
            }
        }
        return '';
    }

    public function changeSponseeAddress($tokenAddress, $newReceivedAddress, $password){

        $sc_url = Configure::read('sc_url');
        $data = array('tokenAddress' => strtolower($tokenAddress),
                        'sponseeAddress' => strtolower($newReceivedAddress),
                        'password' => $password);

        $ch = curl_init($sc_url. '/change-sponsee-address');
        $this->log(date('Y-m-d H:i:s') . '| changeSponseeAddress: ' . http_build_query($data), LOG_DEBUG );
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($json, true);
            $this->log(date('Y-m-d H:i:s') . '| changeSponseeAddress Result: ' . $json, LOG_DEBUG );
            if($data['state'] == 'success'){
                return true;
            }
        }
        return false;
    }

    public function copyS3File($src, $des){
        $options = array(
                                    'key' => Configure::read('Filebinder.S3.key'),
                                    'secret' => Configure::read('Filebinder.S3.secret'),
                            );
        $s3     = new AmazonS3($options);
        $region =  Configure::read('Filebinder.S3.region');
        if(!empty($region)){
            $s3->set_region($region);
        }
        $urlPrefix   = null;
        $currentMask = umask();
        umask(0);

        $source = array('bucket' => Configure::read('Filebinder.S3.bucket'),'filename' => $src);
        $destination = array('bucket' => Configure::read('Filebinder.S3.bucket'),'filename' => $des);
        
        $responce = $s3->copy_object($source, $destination, array('acl'=>AmazonS3::ACL_PUBLIC));
        
        if($responce->isOk()){//copy success
            return true;
        }
        return false;
    }

    public function moveS3File($src, $des){
        $options = array(
                                    'key' => Configure::read('Filebinder.S3.key'),
                                    'secret' => Configure::read('Filebinder.S3.secret'),
                            );
        $s3     = new AmazonS3($options);
        $region =  Configure::read('Filebinder.S3.region');
        if(!empty($region)){
            $s3->set_region($region);
        }
        $urlPrefix   = null;
        $currentMask = umask();
        umask(0);

        $source = array('bucket' => Configure::read('Filebinder.S3.bucket'),'filename' => $src);
        $destination = array('bucket' => Configure::read('Filebinder.S3.bucket'),'filename' => $des);
        
        $responce = $s3->copy_object($source, $destination, array('acl'=>AmazonS3::ACL_PUBLIC));
        
        if($responce->isOk()){//copy success
            $this->deleteS3File($src);
            return true;
        }
        return false;
    }

    public function deleteS3File($file){

        
        $options = array(
                                    'key' => Configure::read('Filebinder.S3.key'),
                                    'secret' => Configure::read('Filebinder.S3.secret'),
                            );
        $s3     = new AmazonS3($options);
        $region =  Configure::read('Filebinder.S3.region');
        if(!empty($region)){
            $s3->set_region($region);
        }
        $urlPrefix   = null;
        $currentMask = umask();
        umask(0);
        return $s3->delete_object(Configure::read('Filebinder.S3.bucket'), $file);
    }

    public function isOK($codes = array(200, 201, 204, 206))
    {
        if (is_array($codes))
        {
            return in_array($this->status, $codes);
        }

        return $this->status === $codes;
    }

    function number_format_short( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format . $suffix;
    }

    public function makeS3Link($attachment) {
        $path = $attachment['model'].DS. $attachment['model_id'].DS. $attachment['field_name'] .DS. $attachment['file_name'];
        return 'https://'.Configure::read('Filebinder.S3.bucket') . '.s3.amazonaws.com' . DS . $path;
    }

    public function getDividendInfo(){
        $setting_model = ClassRegistry::init('Setting');
        $setting_data = $setting_model->find('first');

        $sc_url = $setting_data['Setting']['sc_url'];

        $ch = curl_init($sc_url. '/admin/get-dividend-info');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($json, true);
            if($data['state'] == 'success'){
                return $data['data'];
            }
        }
        return '';
    }

    public function getDividendHistory($address, $sc_url){
        $ch = curl_init($sc_url. '/get-dividend-history');

        $data = array('address' => $address);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if(isset($info['http_code']) && $info['http_code'] == 200) {
            //convert json to array
            $data = json_decode($json, true);
            if($data['state'] == 'success'){
                return $data['data'];
            }
        }
        return array();
    }

    public function inBlackListMail($email = null) {
        if(empty($email)) return false;
        $blm_model = ClassRegistry::init('BlackListMail');

        $email_com = explode('@', $email);
        if(isset($email_com[1])) {
            return $blm_model->findByEmailDomain($email_com[1]);
        }
        return false;
    }
}