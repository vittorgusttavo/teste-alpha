<?php

namespace app\controllers;

use app\models\database\Connection;
use app\models\entity\Produtos;
use Exception;

class ProdutosController{

    public function index(){
        $params = $_GET;
        $search=0;
        $con = new Connection();
        //  Feito em Query pura para fazer o JOIN com categoria
        $sql = "SELECT  p.rowid rowid, 
                        p.codigo codigo, 
                        p.descricao descricao, 
                        p.preco_unitario preco_unitario, 
                        p.categoriaid categoriaid,
                        c.descricao descricao_cat
                FROM produtos p 
                JOIN categorias c ON (p.categoriaid = c.rowid)";
        if(count($params)>0){
            $search=1;
            $sql.=" WHERE ";
            $i=0;
            foreach($params as $column=>$value){
                $i++;
                $sql.= " p.{$column} = :{$column} ";
                if(count($params)!=$i){
                    $sql.=" AND ";
                }
            }
        }
        #echo $sql;die;
        $con = $con->getConnection($sql);
        $stmt = $con->prepare($sql);
        foreach($params as $column=>$value){
            $stmt->bindValue($column, $value);
        }
        $stmt->execute();
        $produtos = $stmt->fetchAll();
        //$produtos = $con->execQueryAll('produtos');
        
        view('produto', [
            'search' => $search,
            'produtos'=> $produtos,
            'title' => 'Produtos',
            'subtitle' => 'Listagem de Produtos',
        ]);
    }

    public function include(){
        $erro=null;
        $params = $_POST;

        try{
            if(isset($params["request"])){
                $produto = new Produtos($params);
                $produto->insert();
                $result = "Produto Cadastrado";
                
            }
            $msg = 'Produto cadastrado';
        }catch(Exception $ex){
            $erro = 'true';
            $msg = $ex->getMessage();
        }
        
        echo json_encode([
            'msg' => $msg,
            'erro' => $erro,
        ], JSON_UNESCAPED_UNICODE);
    }

    public function delete(){
        $params = $_POST;
        $erro=null;

        try{
            if(isset($params["request"])){
                $produto = new Produtos();
                $produto->delete($params["rowid"]);
            }
            $msg = 'Produto excluido !';
        }catch(Exception $ex){
            $erro = 'true';
            $msg = $ex->getMessage();
        }
        
        echo json_encode([
            'msg' => $msg,
            'erro' => $erro,
        ], JSON_UNESCAPED_UNICODE);
    }

    public function update(){
        $params = $_POST;
        $erro=null;

        try{
            if(isset($params["request"])){
                $rowid = $params["rowid"];
                unset($params["request"]);
                unset($params["rowid"]);
                $produto = new Produtos($params);
                $produto->update($params, $rowid);
            }
            $msg = 'Produto atualizado !';
        }catch(Exception $ex){
            $erro = 'true';
            $msg = $ex->getMessage();
        }
        
        echo json_encode([
            'msg' => $msg,
            'erro' => $erro,
        ], JSON_UNESCAPED_UNICODE);
    }

    public function search(){
        $params = $_POST;
        
        try{
            if(isset($params["request"])){
                unset($params["request"]);
                $produto = new Produtos();
                $produto->search($params);
            }
        }catch(Exception $ex){
            $erro = 'true';
            $msg = $ex->getMessage();
        }
        
        echo json_encode([
            'msg' => $msg,
            'erro' => 'true',
        ], JSON_UNESCAPED_UNICODE);

        
    }

}

?>