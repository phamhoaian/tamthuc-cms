<?php

App::uses('HtmlHelper', 'View/Helper');
App::import("Model", "ClsCode");
App::import("Model", "Area");
class CommonHelper extends HtmlHelper {
    public $uses = array('ClsCode');
    public function format_money($number) {
        if(empty($number) || !$number) return '0';
        return number_format($number);
    }

    public function printMediaImage($image) {
    	return $this->image('/'.UPLOAD_DIR . 'media/' . $image);
    }

    public function baseURL($endSlash = true){
    	if( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ){
    		$baseURL = $endSlash ? Router::url('/', true) : rtrim(Router::url('/', true), '/');
    		return str_replace('http://', 'https://', $baseURL);
    	}
    	else{
    		return $endSlash ? Router::url('/', true) : rtrim(Router::url('/', true), '/');
    	}
    }

    public function buttonDownload($sponsor_id, $contribution_content_id, $history = false) {
        if(empty($contribution_content_id) || empty($sponsor_id)) return;
        $ip = $_SERVER['REMOTE_ADDR'];
        $salt = $sponsor_id;
        $file = $contribution_content_id;
        $timestamp = time() + 3600*24; // one hour valid
        $hash = md5($salt . $ip . $timestamp); // order isn't important at all... just do the same when verifying
        $params = array(
                    's' => $hash, 't' => $timestamp, 'f' => $file
                );
        $img = $this->image('common/download-content.svg',array('class' => 'btn-exchange-icon'));
        $link = $this->url(array('controller' => 'download', '?' => $params));

        if ($history) {
            return '<button class="btn btn-primary-o" onclick="location.href='."'".$link. "'" .'"><i class="fa fa-download"></i>'. __('ダウンロード') .'</button>';
        }
        return '<button class="btn-download-item btn-exchange" onclick="location.href='."'".$link. "'" .'">'.$img.'<span>'. __('ダウンロード') .'</span></button>'; 
    }


    public function buyButton($contribution_id, $contribution_content_id, $disabled = false, $package = false) {
        if(empty($contribution_id)) return;
        $img = $this->image('common/dark-rb-coin.svg',array('class' => 'btn-exchange-icon'));

        if($disabled){
            return '<button id="buy_contents" class="btn_buy_item btn-exchange buy-now" disabled="'.$disabled.'" contribution-id="'.$contribution_id.'" product-id="'.$contribution_content_id.'">'
                    .$img.'<span>'.__('コインで購入').'</span>     
                </button>';
        }
        return '<button id="buy_contents" class="btn_buy_item btn-exchange buy-now" ' . ($package ? "data-type='1'" : "" ). ' contribution-id="'.$contribution_id.'" product-id="'.$contribution_content_id.'">'
                    .$img.'<span>'.__('コインで購入').'</span>       
                </button>';
    }

    public function getSponseeInfo($sponsee, $separator = '#', $genre, $sex, $areas){
        // $clsCode_model = new ClsCode();
        // $area_model = new Area();
        // $genre = $clsCode_model->getCodeAndNameByClsAdminID(GENRE_CD);
        // $sex = $clsCode_model->getCodeAndNameByClsAdminID(SEX_CD);
        // $areas = $area_model->get_by_lang();

        $sinfo = array();
        
        $sinfo[] = isset($areas[$sponsee['active_area']])?$areas[$sponsee['active_area']]:'';
        //male, female, group, company
        $sinfo[] = isset($sex[$sponsee['genre_cd']])?$sex[$sponsee['genre_cd']]:'';
        
        // $sinfo[] = __($sponsee['sex_name']);
        $sinfo = array_filter($sinfo); 
        return implode($separator, $sinfo);
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => __('年'),
            'm' => __('ヶ月'),
            'w' => __('週間'),
            'd' => __('日'),
            'h' => __('時間'),
            'i' => __('分'),
            's' => __('秒'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . $v;
                if ($diff->$k > 1 && Configure::read('Config.language_key') == 'en') {
                    $v .= 's';
                }
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . __('前') : __('ちょうど今');
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
      // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
      // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format . $suffix;
    }

    public function package_icon(){
        return $this->image('common/package-icon.svg', array('style' => 'width: 16px; height: 16px; padding: 0px;vertical-align: middle;margin-right: 5px;'));
    }

    public function option($key, $value, $selected, $opts = array()){
        $str = "<option value='{$key}' ".($selected == $key ? 'selected' : '') . ' ';

        foreach ($opts as $key => $opt) {
            $str = $str . $key . "='$opt' "; 
        }
        $str = $str . " >".__($value)."</option>";
        return $str;
    }

    public function date_format($date, $lang = 'en') {
        $pattern = "Y年m月";
        $date = substr($date, 0, 4) .'-' . substr($date, 4);
        if($lang == 'en'){
            $pattern = 'Y-m';
        }
        return date($pattern, strtotime($date));
    }

    function add_lazyload($content) {

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument();
        @$dom->loadHTML($content);

        foreach ($dom->getElementsByTagName('img') as $node) {  
            $oldsrc = $node->getAttribute('src');
            $node->setAttribute("data-src", $oldsrc );
            $class = $node->getAttribute('class');
            $node->setAttribute("class", 'lazy' );
            $newsrc = '/img/common/loader.svg';
            $node->setAttribute("src", $newsrc);
        }
        $newHtml = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
        return $newHtml;
    }
}