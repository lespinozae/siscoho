function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();
var miPeticion2 = obtiene_http_request();

function from(id,ide,url){    
        var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
        var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
        
        //alert(vinculo);
        miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
        miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                   //alert(miPeticion.readyState);
                       if (miPeticion.status==200)

                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               var http=miPeticion.responseText;
                               //alert(ide);
                                //alert(http);
                               document.getElementById(ide).innerHTML= http;
                       }
               }/*else
               {
            document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
                }*/
       }
       miPeticion.send(null);
} 

function _import(c,p,p_actual,ide,url){    
        var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
        var vinculo=url+"?c="+c+"&p="+p+"&p_actual="+p_actual+"&rand="+mi_aleatorio;
        
        //alert(vinculo);
        miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
        miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                   //alert(miPeticion.readyState);
                       if (miPeticion.status==200)

                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               var http=miPeticion.responseText;
                               //alert(ide);
                                //alert(http);
                               document.getElementById(ide).innerHTML= http;
                       }
               }/*else
               {
            document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
                }*/
       }
       miPeticion.send(null);
} 

function docenteExistente(id,ide,url){    
        var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
        var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
        
        //alert(vinculo);
        miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
        miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                   //alert(miPeticion.readyState);
                       if (miPeticion.status==200)

                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               var http=miPeticion.responseText;
                               //alert(ide);
                                //alert(http);
                                //alert(http);
                                if(http > 0)
                                {
                                    document.getElementById(ide).innerHTML= "El docente ya existe";
                                    document.getElementById('SET').disabled = true;
                                    document.getElementById(ide).style
                                }
                                else
                                {
                                    document.getElementById(ide).innerHTML = 'El docente esta disponible';
                                    document.getElementById('SET').disabled = false;
                                }
                               
                       }
               }/*else
               {
            document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
                }*/
       }
       miPeticion.send(null);
}
function periodoActivoP(url, url1, fechaInicial, fechaFinal){
    var dato = periodoActivo(url, url1, fechaInicial, fechaFinal);
    return dato;
}

function periodoActivo(url, url1, fechaInicial, fechaFinal){
    
    var lista =document.getElementById('estado_v');
        var indiceSeleccionado=lista.selectedIndex;
        var opcionSeleccionada = lista.options[indiceSeleccionado];
        var valorSeleccionado = opcionSeleccionada.value;

        var Retorno = false;
        Retorno = validate_fechaMayorQue(fechaInicial,fechaFinal);
        
        if (!Retorno)
        {
            return Retorno;
        }
        Retorno = true;
        
        if (typeof document.getElementById('select') === 'object' && document.getElementById('select').value == 0)
        {
                //alert(document.getElementById('select').value);
                return true;
        }
        else
        {
        if(valorSeleccionado == 1){
        var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
        var vinculo=url+"?rand="+mi_aleatorio;
        miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
        miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
            
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;

                                if(http > 0)
                                {
                                           
                                    $.prompt("Existe un periodo activo. Desea cerrar el periodo para activar el nuevo?", {
                                        title: "Advertencia",
                                        buttons: { "Si": true, "No": false },
                                        submit: function(e,v,m,f){
                                                // use e.preventDefault() to prevent closing when needed or return false. 
                                                // e.preventDefault();
                                            if(v)
                                            {
                                                Retorno=desactivarActivo(url1);
                                            }else
                                            {
                                                $.prompt("Tiene que cerrar los periodos abiertos para poder crear el nuevo periodo.", {
                                            title: "Error",
                                            buttons: { "Ok": true}
                                    });
                                                
                                                Retorno= false;
                                            }
                                        }
                                    });
                                }
                                else
                                {
                                   //alert('Hola');
                                   if(document.getElementById('form2').checkValidity())
                                    {
                                         document.getElementById('form2').submit();
                                    }
                                }
                       }
               }
       }
       miPeticion.send(null);
       //alert(Retorno);
       
       if(document.getElementById('form2').checkValidity())
       {
            return false;
       }
       else
       {
           return Retorno;
       }
   }
}
}

function desactivarActivo(url){ 
        var Retorno = false;
        
        var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
        var vinculo=url+"?rand="+mi_aleatorio;
        miPeticion2.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
        miPeticion2.onreadystatechange=miPeticion2.onreadystatechange=function(){
           
               if (miPeticion2.readyState==4)
               {
                       if (miPeticion2.status==200)
                       {
                               var http=miPeticion2.responseText;
                              
                                //alert(http);
                                if(http>0)
                                {
                                    $.prompt("Los periodos abiertos fueron cerrados.", {
                                        title: "Información",
                                        buttons: { "Ok": true},
                                        submit: function(e,v,m,f){
                                                // use e.preventDefault() to prevent closing when needed or return false. 
                                                // e.preventDefault();
                                            if(v)
                                            {
                                                if(document.getElementById('form2').checkValidity())
                                                {
                                                    document.getElementById('form2').submit();
                                                }
                                            }
                                        }
                                    });
                                    
                                    
                                    
                                    Retorno =  true;
                                }
                                else
                                {
                                    $.prompt("Hubo un error en la consulta.", {
                                            title: "Error",
                                            buttons: { "Ok": true}
                                    });

                                    Retorno =  false;
                                }
                                
                       }
               }
       }
       //alert(Retorno);
       miPeticion2.send(null);
       return Retorno;
}

function validate_fechaMayorQue(fechaInicial,fechaFinal)
        {
            valuesStart=fechaInicial.split("-");
            valuesEnd=fechaFinal.split("-");
            // Verificamos que la fecha no sea posterior a la actual
            var dateStart=new Date(valuesStart[0], (valuesStart[1]-1), valuesStart[2]);
            var dateEnd=new Date(valuesEnd[0], (valuesEnd[1]-1), valuesEnd[2]);
            if (dateStart > dateEnd){
                $.prompt("La fecha de inicio debe de ser menor a la fecha de fin del periodo.", {
	title: "Error",
	buttons: { "Ok": true}
});
                return false;
            }
            else
            {
                return true;
            }
        }
        
        function cambiarValor(valor){
            document.getElementById('select').value = valor;
        }