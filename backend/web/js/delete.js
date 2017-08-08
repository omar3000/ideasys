yii.allowAction = function ($e) {
        var message = $e.data('confirm');
        return message === undefined || yii.confirm(message, $e);
    };
   

yii.confirm = function (message, $e) {
        bootbox.confirm({
            title: 'Eliminar',
            message: 'Deseas eliminar este item?',  
            buttons: {
            	confirm: {
            		label : "OK"
            	},
            	cancel : {
            		label:"Cancelar"
            	}

            },          
           callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
               
            }}); 
return false;
}
     