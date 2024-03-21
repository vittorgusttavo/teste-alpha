<?php $this->extends('master', ['title' => $title]); ?>

 <div>
     <h3><?=$subtitle?></h3>
 </div>
 <div class="container">
        <div class="table-menu-left">
            <a id="manual-ajax" href="/add" rel="modal:open"><button class="bt-include"><img class="img-search" src="./app/public/images/add.png"></button></a>
            <a id="manual-ajax" href="/search" rel="modal:open"><button class="bt-img"><img class="img-search" src="./app/public/images/search.png"></button></a>
        </div>  
    <table class="table">
        <thead>
            <tr class="top-tr">
                <th style="width:125px; text-align: center;">Código</th>
                <th style="width:750px; text-align: center;">Descrição</th>
                <th style="width:100px; text-align: center;">Preço</th>
                <th style="width:350px; text-align: center;">Categoria</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach($produtos as $produto):?>
            <tr class="tr-register">
                <th class="th-register" style="text-align: center;"><?=$produto->codigo?></th>
                <th class="th-register" style="text-align: left;"><?=$produto->descricao?></th>
                <th class="th-register" style="text-align: right;"><?=$produto->preco_unitario?></th>
                <th class="th-register" style="text-align: center;"><?=$produto->descricao_cat?></th>
                <th class="th-register"><a href="/edit?id=<?=$produto->rowid?>&categoriaid=<?=$produto->categoriaid?>" rel="modal:open"><button class="bt-img"><img class="img-search" src="./app/public/images/menu.png"></button></a></th>
                <th class="th-register"><a href="/del?id=<?=$produto->rowid?>" rel="modal:open"><button class="bt-img"><img class="img-search" src="./app/public/images/trash-bin.png"></button></a></th>
            </tr>
        <?php endforeach?>
    </table>
 </div>
 
 <script type="text/javascript" src="./app/public/js/script.js"></script>