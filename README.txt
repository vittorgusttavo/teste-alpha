Versão do PHP utilizada php-8.3.2;

Foi utilizado o composer como gerenciador de pacotes;

Para configuração do banco é necessario alterar os arquivos de comunicação no app\models\database\.env;
Ex: 
DATABASE_HOST={host}
DATABASE_USER={user}
DATABASE_PASSWORD={password}
DATABASE_NAME={database}

Para realizar os testes integrados é necessário chamar vendor/bin/phpunit tests/unit/ProdutosTest.php, será gerado um teste de inclusão de registro;

As criações das tabelas podem ser vista no arquivo db.txt

