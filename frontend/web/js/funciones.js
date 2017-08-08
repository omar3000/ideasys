$(".filtrar button").click(function(event) 
{
   var btn = $(this);
   var valor = btn.attr("data-value");
   var pagina = String(btn.parent().attr("data-page"));
   var page = location.protocol+ '//'+location.hostname+"/ideasys/"+ pagina;
   var columna = btn.parent().attr("data-column");
   var buscador = btn.parent().attr("data-search");


   
     if(valor==-1)
         location.href =page+"/index"
     else
         location.href = page+"/index?"+columna+"="+valor;
   
 
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
    $('#modal').modal('show')
    .find('#modalContent')
    .load($(this).attr('value'));
    console.log(a);
   })
 });

  $('#modal').on('hidden.bs.modal', function (e) {
    location.reload();})


/*

 $(document).ready(function () {

          $(".modalButton").click(function () {
               var url = $(this).attr('value');; // the url to the controller
               $.get(url, function (data) {
                   $('#modalContent').html(data);
                   $('#modal').modal('show');

               });
});
            }); */