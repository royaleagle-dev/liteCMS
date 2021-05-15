<?php

class Template{
    private static $blocks = array();
    private static $cache_path = "cache/";
    
    
    public static function load($file, $data = array()){
        $file = self::cache($file);
        if(!empty($data)){
            extract($data, EXTR_SKIP);
        }
        require $file;
    }
    
    public static function cache($template){
        if(!file_exists(self::$cache_path)){
            mkdir( 'cache/', 0777, true);
        }
        $cached_file_name = str_replace(array('/', 'html'), array('_', 'php'), $template);
        $new_cache_path = "cache/$cached_file_name";
        
        $code = self::includes($template);
        $code = self::render($code);
        
        file_put_contents($new_cache_path, $code);
        //require_once "$new_cache_path";
        return $new_cache_path;
    }
    
    
    public static function includes($template){
        $code = '';
        if(!file_exists($template)){
            exit("Template Error: Template Does Not Exists");
        }else{
            $code = file_get_contents($template);
        }
        $pattern = "/{% (extends) \'(.+)\' %}/";
        //$pattern = "/{% (extends) \'(.+)\' %}/";
        preg_match_all($pattern, $code, $matches, PREG_SET_ORDER);
        //print_r($matches);
        foreach($matches as $value){
            $code = str_replace($value[0], self::includes($value[2]), $code);
        }
        $code = preg_replace($pattern, '', $code);
        return $code;
        
    }
    
    public static function renderBlocks($code){
        //print "hr";
        //print $code;
        //print "hr";
        $pattern = "/{% block (.*?) %}(.*?){% endblock %}/is";
        preg_match_all($pattern, $code, $matches, PREG_SET_ORDER);
        //print_r($matches);
        foreach($matches as $value){
            self::$blocks[$value[1]] = $value[2];
        }
        
        $code = preg_replace($pattern, '', $code);
        return $code;
        
    }
    
    public static function renderYields($code){
        //print $code;
        foreach(self::$blocks as $block => $value){
            $pattern = "/{% yield ($block) %}/";
            $code = preg_replace($pattern, self::$blocks[$block], $code);
        }
        $pattern = "/{% yield ($block) %}/";
        //$code = preg_replace($pattern, '', $code);
        return $code;
    }
    
    public static function renderVariables($code){
        $pattern = "/\{{ ?(.+) \}}/";
        $code = preg_replace($pattern, "<?php echo $1 ?>", $code);
        return $code;
    }
    
    public static function renderPHP($code){
        $pattern = "/\{% (.*?) \%}/is";
        $code = preg_replace($pattern, "<?php $1 ?>", $code);
        return $code;
    }

    public static function renderMultiLinePHP($code){
        $pattern = "/(@php@)(.*?)(@endphp@)/is";
        $code = preg_replace($pattern, "<?php $2 ?>", $code);
        return $code;
    }
    
    public static function render($code){
        $code = self::renderBlocks($code);
        $code = self::renderYields($code);
        $code = self::renderVariables($code);
        $code = self::renderPHP($code);
        $code = self::renderMultiLinePHP($code);
        return $code;
    }
}

?>