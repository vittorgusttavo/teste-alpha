<?php 

namespace app\controllers;

use app\models\database\Connection;

class ModalsController{

    private function getCategoria($id=null){
        $con = new Connection();
        $bind = [];
        if($id!=null){
            $bind = [
                "rowid" => $id,
            ];
        }

        $categorias = $con->execQueryAll('categorias', $bind);
        $con=null;
        return $categorias;
    }

    public function include(){
        
        $categorias = $this->getCategoria();
            
        view('modal', [
            'action' => 'add',
            'categorias' => $categorias
        ]);
    }

    public function delete(){
        $params = $_GET;
        if(isset($params['id'])){
            $bind = [
                "rowid" => $params['id'],
            ];
            $con = new Connection();
            $register = $con->execQueryOne('produtos', $bind);
            $con=null;
        }
        view('modal', [
            'action' => 'del',
            'register' => $register
        ]);
    }

    public function update(){
        $params = $_GET;
        if(isset($params['id'])){
            $bind = [
                "rowid" => $params['id'],
            ];
            $con = new Connection();
            $register = $con->execQueryOne('produtos', $bind);
            $con=null;
        }
        
        $categorias = $this->getCategoria();
       
        view('modal', [
            'action' => 'edit',
            'register' => $register,
            'categorias' => $categorias,
        ]);
    }

    public function search(){
        $categorias = $this->getCategoria();

        view('modal', [
            'action' => 'search',
            'categorias' => $categorias,
        ]);
    }

    
}

?>