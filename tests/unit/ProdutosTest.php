<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use app\models\entity\Produtos;
use app\models\database\Connection;

use Exception;

class ProdutosTest extends TestCase{
    public function testInsert(){
        try{
            $_ENV['DATABASE_HOST'] = 'localhost';
            $_ENV['DATABASE_USER'] = 'root';
            $_ENV['DATABASE_PASSWORD'] = '';
            $_ENV['DATABASE_NAME'] = 'teste_pratico_alpha';

            $params = [
                "codigo" => 555,
                "descricao" => 'Teste3',
                "preco_unitario" => 5.00,
                "categoriaid" => 1,
            ];

            $produto = new Produtos($params);
            $resultado = $produto->insert();
            
        }catch(Exception $ex){
            echo $ex->getMessage();
            throw new Exception($ex->getMessage());
        }

        $this->assertTrue($resultado);
        
    }
}

?>