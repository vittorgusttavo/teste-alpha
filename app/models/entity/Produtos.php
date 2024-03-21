<?php 

namespace app\models\entity;

use Exception;
use app\models\database\Connection;

class Produtos{
    protected $table = 'produtos';

    private $_rowid;
    private $_codigo;
    private $_descricao;
    private $_preco_unitario;
    private $_categoriaid;

    public function __construct($params = []){
        $this->_rowid = (isset($params['rowid'])) ? $params['rowid'] : "";
        $this->_codigo = (isset($params['codigo'])) ? $params['codigo'] : "";
        $this->_descricao = (isset($params['descricao'])) ? $params['descricao'] : "";
        $this->_preco_unitario = (isset($params['preco_unitario'])) ? $params['preco_unitario']: "";
        $this->_categoriaid = (isset($params['preco_unitario'])) ? $params['categoriaid'] : "";
    }

    private function validField(){
        if(!$this->_codigo)
            throw new Exception('Favor informar o Codigo');

        if(!$this->_descricao)
            throw new Exception('Descrição não informada !');
        
        if(!$this->_preco_unitario)
            throw new Exception('Preço não informado !');

        if(!$this->_categoriaid)
            throw new Exception('Categoria não informado !');
    }

    /*public function validDescricao($rowid){

        $con = new Connection();
        $con->execQueryOne($this->table, $data);
        $con=null;
    }*/

    public function insert(){
        $data = [
            "codigo" => $this->_codigo,
            "descricao" => $this->_descricao,
            "preco_unitario" => $this->_preco_unitario,
            "categoriaid" => $this->_categoriaid,
        ];

        $this->validField();

        $con = new Connection();
        $con->insertQuery($this->table, $data);
        $con=null;

        return true;
    }

    public function delete($rowid){
        $data = [
            "rowid" => $rowid
        ];

        $con = new Connection();
        $con->deleteQuery($this->table, $data);
        $con=null;

        return true;
    }

    public function update($data, $rowid){
        #var_dump($data);
        $binds = [
            "rowid" => $rowid,
        ];
        $this->validField();

        $con = new Connection();
        $con->editQuery($this->table, $data, $binds);
        $con=null;

        return true;
    }

    public function search(){
        redirect('/');
    }

}

?>