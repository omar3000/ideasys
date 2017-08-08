$("#razon0").hide('slow');
    $('#servicio-stcosto0').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state);
    if(state){
        $("#razon0").show('slow');
    }else{
        $("#razon0").hide('slow');
    }
});


