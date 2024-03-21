<?php

namespace app\util\classes;

use Exception;

class Engine{

    private $_layout;
    private $_data;
    private $_content;

    private function load(){
        return !empty($this->_content) ? $this->_content : '';
    }

    private function extends($layout, $data = []){
        $this->_layout = $layout;
        $this->_data = $data;
    }

    public function render($view, $data){
        $view = dirname(__FILE__, 3)."/resources/views/{$view}.php";
       
        if(!file_exists($view))
            throw new Exception("Template {$view} não encontrado");

        ob_start();
        extract($data);
        require $view;
        $content = ob_get_contents();
        ob_end_clean();

        if(!empty($this->_layout)){
            $this->_content = $content;
            $data = array_merge($this->_data, $data);
            $layout = $this->_layout;
            $this->_layout = null;
            
            return $this->render($layout, $this->_data);
        }
            

        return $content;
    }
}

?>