

function envAjax(action){
  const codigo = $('#codigo').val();
  const descricao = $('#descricao').val();
  const preco_unitario = $('#preco_unitario').val();
  const categoriaid = $("#categorias option:selected").val();
  const rowid = $('#rowid').val();
  const url='/' + action;
  var erro = false;

  $.ajax({
    method: "POST",
    url: url,
    data: { request: true, codigo: codigo, descricao: descricao, preco_unitario: preco_unitario, categoriaid: categoriaid, rowid: rowid},
    success: function (response) {
      
      response = JSON.parse(response);
      erro = response.erro;
      if(response.erro=="true"){
        alert(response.msg);
        return false;
      }
      alert(response.msg);
      window.location.href = "/";
    }
  });
}

function env(){
  const codigo = $('#codigo').val();
  const descricao = $('#descricao').val();
  const preco_unitario = $('#preco_unitario').val();
  const categoriaid = $("#categorias option:selected").val();
  const rowid = $('#rowid').val();

  var erro = false;
var uri = '?';

  if(codigo!="") 
    uri = uri + 'codigo=' +codigo + '&';
  if(descricao!="") 
    uri = uri + 'descricao='+descricao+ '&';;
  if(preco_unitario!="") 
    uri = uri + 'preco_unitario='+preco_unitario+ '&';;
  if(categoriaid!="") 
    uri = uri + 'categoriaid='+categoriaid+ '&';;
  //console.log(uri);return false;
  window.location.href = "/"+uri;
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
});