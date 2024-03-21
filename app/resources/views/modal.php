<?php  
    $button = "salvar";
    switch($action){
        case 'add':
            $actionDescribe = 'Adicionar';
            break;
        case 'edit':
            $actionDescribe = 'Editar';
            break;
        case 'del':
            $actionDescribe = 'Excluir';
            break;
        case 'search':
            $button = "Pesquisar";
            $actionDescribe = 'Pesquisar';
            break;
    }
    
?>

<div>
    <h2><?=$actionDescribe?></h2>
</div>

<form id="form" method="post">
    <?php if($action=='edit'||$action=='del') :?>
        <input type="hidden" id="rowid" value="<?=$register->rowid?>" />
    <?php endif; ?>

<?php if($action!="del"):?>
    <div>
        <label for="nome">Código: </label>
        <input type="text" id="codigo" value="<?php echo isset($register->codigo) ? $register->codigo : ""; ?>"/>
    </div>
    
    <div>
        <label for="nome">Descrição: </label>
        <input type="text" id="descricao" value="<?php echo isset($register->descricao) ? $register->descricao : ""; ?>"/>
    </div>
    <div>
        <label for="nome">Preço: </label>
        <input type="text" id="preco_unitario" value="<?php echo isset($register->preco_unitario) ? $register->preco_unitario : "";?>"/>
    </div>
    <div>
        <label for="nome">Categoria: </label>
        <select id="categorias">
            <?php if($action=="search"):?>
                <option value=""></option>
            <?php endif;?>
            <?php foreach($categorias as $categoria): ?>
                <?php if($register->categoriaid==$categoria->rowid):?>
                    <option value="<?=$categoria->rowid?>" selected><?=$categoria->descricao?></option>
                <?php else:?>
                    <option value="<?=$categoria->rowid?>"><?=$categoria->descricao?></option>
                <?php endif;?>
                
            <?php endforeach; ?>     
        </select>
    </div>
<?php else:?>
    <div>
        Registro: <b><?php echo isset($register->codigo) ? $register->codigo : ""; ?> - <?php echo isset($register->descricao) ? $register->descricao : ""; ?></b><br>
        Você tem certeza que deseja excluir ? 
    </div>
<?php endif;?>

    <?php if($action!="search"):?>
        <div class="button">
            <button class="bt-submit" onclick="envAjax('<?=$action?>')"> <?=$button?> </button>
        </div>
    <?php else:?>
        <div class="button">
            <button class="bt-submit" onclick="env('<?=$action?>')"> <?=$button?> </button>
        </div>
    <?php endif;?>
</form>    

<script type="text/javascript" src="./app/public/js/modal.js"></script>






