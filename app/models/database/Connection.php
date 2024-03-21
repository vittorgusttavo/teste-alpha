<?php

namespace app\models\database;

use PDO;

    class Connection {

    private $_host;
    private $_user;
    private $_password;
    private $_database;
    
    private $_link = null;
    private $_result;

    public function __construct(){
        $this->_host = $_ENV['DATABASE_HOST'];
        $this->_user = $_ENV['DATABASE_USER'];
        $this->_password = $_ENV['DATABASE_PASSWORD'];
        $this->_database = $_ENV['DATABASE_NAME'];
        
        if(!$this->_link){
            $this->_link = new PDO("mysql:host={$this->_host};dbname={$this->_database};charset=utf8mb4;", $this->_user, $this->_password,
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        }

    }

    public function getConnection(){
        return $this->_link;
    }
        
    public function execQueryAll($table, $binds = [], $columns = "*" ){
        $sql="SELECT {$columns}";
        $sql.=" FROM {$table}";
        if(count($binds)>0){
            $sql.=" WHERE ";
            foreach($binds as $colum=>$data){
                $sql.=" {$colum} = :{$colum} ";
            }
        }

        $stmt = $this->_link->prepare($sql);
        
        foreach($binds as $colum=>$data){
            $stmt->bindValue($colum, $data);
        }
        $stmt->execute();        
        return $stmt->fetchAll();
    }

    public function execQueryOne($table, $binds = [], $columns = "*"){
        $sql="SELECT {$columns}";
        $sql.=" FROM {$table}";
        if(count($binds)>0){
            $sql.=" WHERE ";
            foreach($binds as $colum=>$data){
                $sql.=" {$colum} = :{$colum} ";
            }
        }

        $stmt = $this->_link->prepare($sql);
        
        foreach($binds as $colum=>$data){
            $stmt->bindValue($colum, $data);
        }
        $stmt->execute();        

        return $stmt->fetch();
    }

    public function insertQuery($table, $datas){
        $columns = array();
        $values = array();

        $sql = "INSERT INTO {$table} ";

        foreach($datas as $column => $value){
            $columns[] = $column;
            $values[]  = ':'.$column;
            $bind[$column] = $value;
        }

        $columnsSql = implode(',', $columns);
        $valuesSql = implode(',', $values);
        $sql.= "({$columnsSql}) VALUES ({$valuesSql})";

        $stmt = $this->_link->prepare($sql);
        $stmt->execute($bind);
    }

    public function deleteQuery($table, $binds){
        $sql = "DELETE FROM {$table} WHERE ";

        foreach($binds as $colum=>$data){
            $sql.=" {$colum} = :{$colum} ";
        }
    
        $stmt = $this->_link->prepare($sql);
        
        foreach($binds as $colum=>$data){
            $stmt->bindValue($colum, $data);
        }
        $stmt->execute();        

    }

    public function editQuery($table, $data, $binds){
        $columns = array();
        $values = array();

        $sql = "UPDATE {$table} SET ";

        foreach($data as $column => $value){
            $values[]  = $column. ' = :'.$column;
            $bind[$column] = $value;
        }
        $valuesSql = implode(', ', $values);

        $sql.= " {$valuesSql} ";

        if(count($binds)>0){
            $sql.=" WHERE ";
            foreach($binds as $colum=>$data){
                $sql.=" {$colum} = :{$colum} ";
            }
        }
        
        $stmt = $this->_link->prepare($sql);

        $bind = array_merge($bind, $binds);
        
        $stmt->execute($bind);

    }

    public function __destruct(){
        $this->_host = null;
        $this->_user = null;
        $this->_password = null;
        $this->_database = null;
        $this->_link = null;
    }
}

?>