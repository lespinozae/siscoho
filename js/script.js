$(document).on('ready', function () {
            $('.cancel').on('click', function ()
            {
                window.location = 'home.php';
                return false;
            });
            
            $('[data-toggle="tooltip"]').tooltip(); 
            
        });
        
        
        function alertDelete(ruta)
        {
                $.prompt('Esta seguro que desea eliminar este registro?', {
                                        title: "Advertencia",
                                        buttons: { "Si": true, "No": false },
                                        submit: function(e,v,m,f){
                    if(v){
                        window.location = ruta;
                    }
                }
            });
        }