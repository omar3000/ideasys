$(".filtrar button").click(function(event) 
{
   var btn = $(this);
   var valor = btn.attr("data-value");
   var pagina = String(btn.parent().attr("data-page"));
   var page = location.protocol+ '//'+location.hostname+"/ideasys/backend/"+ pagina;
   var columna = btn.parent().attr("data-column");
   var buscador = btn.parent().attr("data-search");

   if(pagina == "empresa")
   {
      if(valor==-1)
        location.href =page+"/view?" + buscador;
      else
        location.href = page+"/view?"+buscador+"&"+columna+"="+valor;
   }
   else if(pagina == "pago")
   {
      if(valor==-1)
        location.href =page+"/index?" + buscador;
      else
        location.href = page+"/index?"+buscador+"&"+columna+"="+valor;
   }
   else
   {
     if(valor==-1)
         location.href =page+"/index"
     else
         location.href = page+"/index?"+columna+"="+valor;
   }
 
   //var valor = btn.attr("data-value");
});
 
$(document).ready(function () 
{
  $('#reset').click(function()
  {
    $('#search').val("");
    $( "#searchForm" ).submit();
  });

});


$(function(){
  $('.modalButton').click(function(){
    var a = $(this).attr('value');
    var obj = $('#modal').modal('show')
    .find('#modalContent').load(a);
    
   })

  $('#modal').on('hidden.bs.modal', function (e) {
    location.reload();})

 });
