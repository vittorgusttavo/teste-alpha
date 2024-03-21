<?php

//  monta o arquivo .env
$dotEnv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 1).'/models/database');
$dotEnv->load();

routerExecute();
