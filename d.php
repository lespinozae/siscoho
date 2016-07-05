<?php
require_once './core/zona_privada.php';
require_once './core/carga.php';
require_once './core/user.php';
require_once 'menu.php';
$BAND = false;
if(isset($_POST) and isset($_POST['agregar_import']))
{
    $objCarga = new carga();
    $array_t = array();
    $array_f = array();
    
    for($z=0; $z<count($_POST["agregar_import"]); $z++)
    {
        $BAND_C = $objCarga->setCargaAsigImport($_POST["agregar_import"][$z], $_POST["p"], $_POST["id"], $_POST["th"]);
        
        if($BAND_C)
        {
            $array_t[] = $_POST["agregar_import"][$z];
        }
        else
        {
            $array_f[] = $_POST["agregar_import"][$z];
        }
    }
    //print_r($array_f);
    //exit();
    $idDocente=$_POST["id"];
    
    if(count($array_f)>0)
    {
        $array_para_enviar_via_url = serialize($array_f);
        $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
        print_r($array_para_enviar_via_url);
        echo '<script>window.location = "c.php?id='.$idDocente.'&array='.$array_para_enviar_via_url.'";</script>';
    }else
    {
        echo '<script>window.location = "c.php?id='.$idDocente.'&import=yes";</script>';
    }
    
    //header("Location: );
    //print_r($array_t);
    //print_r($_POST["id"]);
    //exit();
}

if(isset($_GET) and isset($_GET['id']))
{
    $dato_periodo = carga::getStatic_activo();
    $p_actual = $dato_periodo[0]['id'];
    $dato_facutad = carga::getStatic_facultad($_SESSION['user']);
    if(!(carga::getStatic_existente_carga($_GET["id"], $dato_periodo[0]['id'])[0]['cantidad'] > 0))
    {
        $obj = new carga();
        $obj->setCarga($_GET['id'], $dato_periodo[0]['id']);
    }
    $carga_asignatura = carga::getStatic_carga_asignatura($_GET['id'], $dato_periodo[0]['id']);
    $permitir = carga::getStatic_permitir($_GET['id'], $dato_periodo[0]['id']);
    $BAND = true;
    
            $limite = carga::getStatic_limite($_GET['id']);
            //$total = carga::getStatic_horas($_GET['id'], $dato_periodo[0]['id']);
}
else
{
    header("Location: user.php");
}


  
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sistema de carga horaria docente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include './inc/head_common.php';
        ?>
        <link rel="stylesheet" href="css/cuerpo.css"/>
        <style>
            .editable span{display:block;}
            .editable span:hover {cursor:pointer;}
            .ocultar{display: none;}
            td:hover .ocultar{display: block; cursor:pointer; float: right;}
            .editable span li:hover{display: block;}
            a.enlace{display:inline-block;margin:0 0 0 5px;vertical-align:middle}
            
            
            .editable_p span{display:block;}
            .editable_p span:hover {cursor:pointer;}
            .ocultar_p{display: none;}
            td:hover .ocultar_p{display: block; cursor:pointer; float: right;}
            .editable_p span li:hover{display: block;}
            a.enlace_p{display:inline-block;margin:0 0 0 5px;vertical-align:middle}
            
            table tr td:nth-child(1), table tr th:nth-child(1){
  border:1px dashed darkgreen;
  /*Quita esta linea y mira que pasa :)*/display:none;
  
}
.input_tamano {
      width: 60px;
  }

	</style>
    </head>
    <body>
        <?php include './inc/header.php'; ?>
        <div class="container" id="principal">
            <div class="row">
                
                <div class="alert alert-success paleta" role="alert">
                    <h3>
                        Carga: <?php if ($BAND) { echo 'Semestre: '. $dato_periodo[0]['nombre'] . ' - A&ntilde;o lectivo: '. $dato_periodo[0]['anio_lectivo']; } ?>
                    </h3>
                </div><div class="col-xs-4">
                    
                    <fieldset>
                        <legend><h3>Buscar asignatura</h3></legend>
                        <div class="mensaje" ></div>
 <form name="form2" id="form2" class="form-horizontal" style="text-align: left;">
     <br /><br/> 
     <div class="form-group">
         <label for="fac" class="control-label col-xs-4">Facultad:</label>
                                            <div class="col-xs-8">
                                                <?php $fac = carga::getStatic_Facultad2(); ?>
                                                <select name="fac" class="form-control" id="fac" required onchange="from(this.value, 'dep', 'cajax/departamento.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    for ($i = 0; $i < count($fac); $i++) {
                                                        
                                                        if ($fac[$i]["idfacultad"] == $dato_facutad[0]['id'])
                                                        {
                                                            ?>
                                                    
                                                    <option selected value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                            <?php
                                                        }
 else {
     ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                            <?php
 }
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
         <label for="dep" class="control-label col-xs-4">Departamento: <br/>(Coordinaci&oacute;n)</label>
                                            <div class="col-xs-8">
                                                <?php $dep = carga::getStatic_DepartamentoC($dato_facutad[0]['id']); ?>
                                                <select name="dep" class="form-control" id="dep" required onchange="from(this.value, 'c', 'cajax/carrera.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    for ($i = 0; $i < count($dep); $i++) {
                                                        ?>
                                                            <option value="<?php echo $dep[$i]["id"]; ?>"><?php echo $dep[$i]["departamento"]; ?></option>
                                                            <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="c" class="control-label col-xs-4">Carrera</label>
                                            <div class="col-xs-8">
                                                <select name="c" class="form-control" id="c" required onchange="from(this.value, 't', 'cajax/turno.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                </select>
                                            </div>
                                        </div>
     
     <div class="form-group">
                                            <label for="t" class="control-label col-xs-4">Modalidad</label>
                                            <div class="col-xs-8">
                                                
                                                <select name="t" class="form-control" id="t" required onchange="from(this.value, 'tabla_r', 'cajax/tabla.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
     </form>
                        
                        
                        
                        <div id="tabla_r">
                        
                            </div>
                                        
                             </fieldset>          
                        </div>
                
                        <div class="col-xs-8">
                            <fieldset>
                        <legend><h3>Carga docente: <?php 
                        $docente = $objUser->getNombreUsuario($_GET["id"]);
                        
                        echo "<i>".$docente[0]["pnombre"]." ".$docente[0]["papellido"]."</i>";
                        ?>
                                | <input type="checkbox" name="permitir" id="permitir" onclick="ignorarLimite(this)" <?php echo $permitir[0]["permitir"] == 1 ? "checked" : ""; ?>/> <label for="permitir" style="font-size: 12px;">Ignorar limite de asignatura </label>
                                | <input type="button" name="import" onclick="" value="Importar" class="btn btn-primary" data-toggle="modal" data-target="#myModal"/>
                                <!-- Modal --></h3>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Importar carga</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal">
          <div class="form-group">
              <div class="row">
              <div class="col-xs-4">
                  <label style="font-size:14px; margin-left: 10px;" for="import_s" class="control-label" >A&ntilde;o Lectivo y Semestre: <?php
             
                                      $anio = carga::getStatic_import();
                                                                            //print_r($anio);
                                                                            ?></label></div>
                  <div class="col-xs-8">
                   
                      
                      <select name="import_s" id="import_s" class="form-control"  style="width: 60%;" onchange="_import(<?php echo $_GET["id"]; ?>, this.value, <?php echo $p_actual; ?>,'tabla_import', 'cajax/import.php');">
                                                <option class="priElement" value="">Seleccione una opci&oacute;n</option>
              <?php
              for($z=0; $z<count($anio); $z++)
              {
                  ?>
              <option value="<?php echo $anio[$z]["id"]; ?>"><?php echo $anio[$z]["anio_lectivo"]. " - ". $anio[$z]["nombre"]; ?></option>
              <?php
              }
              ?>
          </select>
                  </div>
                  </div>
             
                                        </div>
           </form>
          <div id="tabla_import">
              
          </div>
<!--        <p>Some text in the modal.</p>-->
      </div>
      <div class="modal-footer">
          <div id="respuesta" style="float: left; font-size: 12px;"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
                                <?php
                        ?></legend>
                            <p id="resultado"><?php 
                            if(isset($_GET['array']))
                            {
                                $miarray = $_GET['array'];

                                $array_para_recibir_via_url = stripslashes($miarray);
                                $array_para_recibir_via_url = urldecode($array_para_recibir_via_url);
                                $matriz_completa = unserialize($array_para_recibir_via_url);
                                if(count($matriz_completa)>0)
                                {
                                    echo "Asignaturas que no fueron agregadas: <br />";
                                    //Recorrer la listas de asignaturas que no fueron agregadas
                                    echo "<ul class='list-group'>";
                                    for ($index = 0; $index < count($matriz_completa); $index++) {
                                        echo "<li class='list-group-item'>".carga::getStatic_asignaturas2($matriz_completa[$index])[0]["asignaturas"]."</li>";
                                    }
                                    echo "</ul>";
                                }
                                
                                ?>
                                <meta http-equiv="Refresh" content="10;url=c.php?id=<?php echo $_GET["id"];?>">
                                <?php
                            }
                            else if(isset($_GET['import']))
                            {
                                echo "La importacion se realizo con exito";
                                ?>
                                <meta http-equiv="Refresh" content="5;url=c.php?id=<?php echo $_GET["id"];?>">
                                <?php
                            }
                             ?></p>
                            <div class="mensaje_p"></div>
 <div class="mensaje"></div>
 <table class="table table-hover editinplace_p" id="ad" >
                                           <thead>
                                                <tr>
                                                    <TH>ID</TH>
                                                    <th>Asignatura</th>
                                                    <th>Plan</th>
                                                    <th>Horas</th>
                                                    <th>Turno</th>
                                                    <th>Horas excedentes</th>
                                                    <th>Horas reducidas</th>
                                                    <th>Horas adicionales</th>
                                                    <th></th>
                                                </tr>
                                           </thead>
                                            <tbody>
                                                    <?php
                                                    if(count($carga_asignatura)>0)
                                                    {
                                                    for($z = 0; $z<count($carga_asignatura); $z++)
                                                    {
                                                        
                                                 ?>
                                                    <tr id="r<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>">
                                        <td><?php echo $carga_asignatura[$z]["idasiganturas"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["asignaturas"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["plan"]; ?></td>
                                        <td class="edit" id="h" ondblclick="addInput(this, '<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>')"><?php echo $carga_asignatura[$z]["thoras"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["turno"]; ?></td>
                                        <td class="edit" id="he" ondblclick="addInput(this, '<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>')"><?php echo $carga_asignatura[$z]["hexcedentes"]; ?></td>
                                        <td class="edit" id="hr" ondblclick="addInput(this, '<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>')"><?php echo $carga_asignatura[$z]["hreducidas"]; ?></td>
                                        <td class="edit" id="ha" ondblclick="addInput(this, '<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>')"><?php echo $carga_asignatura[$z]["hadicionales"]; ?></td>
                                        <td><a href="#" class="return" onclick="anadi_quitar(event, '<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>', this)"><i class="fa fa-minus"></i></a></td>         
                                    </tr>
                                    <?php
                                                    }}
                                                    ?>
                                            </tbody>
                                        </table>
 
 
                             </fieldset>  
                                       
                        </div>
                    </div>
                </div>

        <input id="BAND" value="<?php echo $BANDM; ?>" type="hidden"></span>
<?php
include './inc/footer.php';
?>

<?php
include './inc/footer_common.php';
?>
<script>
            function anadi_quitar(event, id, a)
            {
                if(a.className === 'add')
                {
                    //Clonando Valores
                    var tr = document.getElementById(id);
                    var trNuevo = tr.cloneNode(true);
                    
                    var table = document.getElementById("ad");
                    var BAND = true;
                    var totalH = 0;
                        if(table.rows.length > 1)
                        {
                            for (var i = 1; i < table.rows.length; i++) {
                                    //iterate through rows
                                 //rows would be accessed using the "row" variable assigned in the for loop
                                 var row = table.rows[i];
                                 var fila = 'r'+tr.id;
                                 
                                 if(row.id === fila)
                                 {
                                     BAND = false;
                                     break;
                                 }
                                 totalH += parseInt(row.cells[3].innerHTML);
                                 
                        }
                    }
                    else
                    {
                        BAND = true;
                    }
                    
                    //console.log(totalH+parseInt(tr.cells[3].innerHTML));
                    var chek = document.getElementById('permitir');
                    
                    if(BAND)
                    {
                        if(chek.checked == true || (totalH+parseInt(tr.cells[3].innerHTML))<= <?php echo $limite[0]["limite"]; ?>)
                        {
                         
                        var valor_id = trNuevo.id;
                        
                        var lista = document.getElementById("t");
                        var indiceSeleccionado=lista.selectedIndex;
                        var opcionSeleccionada = lista.options[indiceSeleccionado];
                        //var valorSeleccionado = opcionSeleccionada.value;
                        var valorTexto = opcionSeleccionada.text;
                        
                        var node = document.createTextNode(valorTexto);
                        var he = document.createTextNode('0');
                        var hr = document.createTextNode('0');
                        var ha = document.createTextNode('0');

                        
                        var idAsig = trNuevo.cells[0].innerHTML;
                        var thoras = trNuevo.cells[3].innerHTML;
                        
                        //trNuevo.cells[4].appendChild();
                        trNuevo.insertCell();
                        trNuevo.cells[5].appendChild(node);
                        
                        
                        trNuevo.insertCell();
                        trNuevo.cells[6].appendChild(he);
                        trNuevo.cells[6].id = 'he';
                        trNuevo.cells[6].className="tLine";
                        trNuevo.cells[6].setAttribute('ondblclick', 'addInput(this, '+idAsig+')');
                        
                        trNuevo.insertCell();
                        trNuevo.cells[7].appendChild(hr);
                        trNuevo.cells[7].id = 'hr';
                        trNuevo.cells[7].className="tLine";
                        trNuevo.cells[7].setAttribute('ondblclick', 'addInput(this, '+idAsig+')');
                        
                        trNuevo.insertCell();
                        trNuevo.cells[8].appendChild(ha);
                        trNuevo.cells[8].id = 'ha';
                        trNuevo.cells[8].className="tLine";
                        trNuevo.cells[8].setAttribute('ondblclick', 'addInput(this, '+idAsig+')');
                        
                        trNuevo.cells[3].setAttribute('id', 'h');
                        trNuevo.cells[3].setAttribute('className', 'tLine');
                        trNuevo.cells[3].setAttribute('ondblclick', 'addInput(this, '+idAsig+')');
                        
                        //console.log(trNuevo.cells[3]);
                        var colum_menos = trNuevo.cells[4].cloneNode(true);
                        //console.log(colum_menos);
                        trNuevo.cells[4].parentNode.removeChild(trNuevo.cells[4]);
                        
                        trNuevo.appendChild(colum_menos);
                        trNuevo.id = 'r'+valor_id;
                        //console.log(primeraCelda);
                        
                        //console.log(table.childNodes[3]);
                        table.childNodes[3].appendChild(trNuevo);
                        var i = table.querySelector(".fa-plus");
                        i.className = "fa fa-minus";
                        var cadena = 'tr#'+trNuevo.id+" > td > a";
                        var enlace = document.querySelector(cadena);
                        //console.log(enlace);
                        enlace.className = "return";
                        
                        
                        var parametros = {
                                "_idasiganturas" : valor_id,
                                "carga_periodo_id" : <?php echo $dato_periodo[0]['id']; ?>,
                                "carga_docentes_id" : <?php echo $_GET['id']; ?>,
                                "thoras" : thoras
                        };
                        
                        $.ajax({
                                data:  parametros,
                                url:   'cajax/carga_g.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#resultado").html("Procesando, espere por favor...");
                                },
                                success:  function (response) {
                                        $("#resultado").html(response);
                                        setTimeout("document.getElementById('resultado').style.display = 'none'", 3000);
                                        setTimeout(function(){document.getElementById('resultado').innerHTML = '';document.getElementById('resultado').style.display = 'block'}, 6000);
                                }
                        });
                        }
                        else
                        {
                            $.prompt("Error! No puede agregar mas asignaturas (Sobrepasa el limite de horas)", {
                                            title: "Error",
                                            buttons: { "Ok": true} });
                        }
                      
                    }
                    else
                    {
                        $.prompt("Esta asignatura ya fue agregada", {
                                            title: "Error",
                                            buttons: { "Ok": true} });
                    }
                }else if(a.className === 'return')
                {
                    var tr = document.getElementById('r'+id);
                    //console.log(tr);
                    tr.parentNode.removeChild(tr);
                    
                    var parametros = {
                                "_idasiganturas" : id,
                                "carga_periodo_id" : <?php echo $dato_periodo[0]['id']; ?>,
                                "carga_docentes_id" : <?php echo $_GET['id']; ?>
                        };
                        
                        $.ajax({
                                data:  parametros,
                                url:   'cajax/carga_d.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#resultado").html("Procesando, espere por favor...");
                                },
                                success:  function (response) {
                                        $("#resultado").html(response);
                                        
                                        setTimeout(function(){document.getElementById('resultado').innerHTML = '';}, 3000);
                                }
                        });
                }
            }
            
           

function closeInput(elm, id, tipo) {
    var td = elm.parentNode;
    var value = elm.value;
    td.removeChild(elm);
    td.innerHTML = value;
    
    var parametros2 = {
        "value" : value,
        "_idasiganturas" : id,
        "carga_periodo_id" : <?php echo $dato_periodo[0]['id']; ?>,
        "carga_docentes_id" : <?php echo $_GET['id']; ?>,
        "tipo" : tipo
    };
    
    $.ajax({
        data:  parametros2,
        url:   'cajax/hera.php',
        type:  'post',
        beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
        },
        success:  function (response) {
                $("#resultado").html(response);
                
                setTimeout(function(){document.getElementById('resultado').innerHTML = '';}, 3000);
        }
    });
}

function addInput(elm, id) {
    if (elm.getElementsByTagName('input').length > 0) return;
    var value = elm.innerHTML;
    var tipo = elm.id;
    //console.log(tipo);
    elm.innerHTML = '';

    var input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('min', '0');
    input.setAttribute('max', '100');
    input.setAttribute('value', value);
    input.setAttribute('onBlur', 'closeInput(this, \''+id+'\', \''+tipo+'\')');
    input.setAttribute('class', 'input_tamano');
    elm.appendChild(input);
    input.focus();
    //console.log(input);
}

function ignorarLimite(objeto)
{
    var valor = 0;
 if(objeto.checked == true)
 {
     valor = 1;
 }
 else
 {
     valor = 0;
 }
 
 var parametros = {
                                "valor" : valor,
                                "carga_periodo_id" : <?php echo $dato_periodo[0]['id']; ?>,
                                "carga_docentes_id" : <?php echo $_GET['id']; ?>
                        };
                        
                        $.ajax({
                                data:  parametros,
                                url:   'cajax/igli.php',
                                type:  'post',
                                beforeSend: function () {
                                       // $("#resultado").html("Procesando, espere por favor...");
                                },
                                success:  function (response) {
                                        $("#resultado").html(response);
                                        
                                        //setTimeout(function(){document.getElementById('resultado').innerHTML = '';}, 3000);
                                }
                        });
}

function checkPage(bx){                    
        for (var tbls = document.getElementsByTagName("table"),i=tbls.length; i--; )
        {
            //console.log(tbls);
            for (var bxs=tbls[i].getElementsByTagName("input"),j=bxs.length; j--; )
               if (bxs[j].type=="checkbox")
                   bxs[j].checked = bx.checked;
       }
    }
    
        function _import_carga()
        {
            var cadenaJSON = "";
            var retorno = false;
            var checkboxValues = new Array();
            //recorremos todos los checkbox seleccionados con .each
            $('input[name="agregar_import[]"]:checked').each(function() {
                    //$(this).val() es el valor del checkbox correspondiente
                    checkboxValues.push($(this).val());
                    cadenaJSON += $(this).val()+",";
            });
           
            if(checkboxValues.length > 0)
            {
                //console.log(cadenaJSON);
                
                var parametros = {
                                "arreglo" : cadenaJSON,
                                "carga_docentes_id" : <?php echo $_GET['id']; ?>,
                                "carga_periodo_id" : <?php echo $dato_periodo[0]['id']; ?>
                        };
                        
                            $.ajax({
                                    //data:  cadenaJSON,
                                    data: parametros,
                                    url:   'cajax/setImport.php',
                                    type:  'post',
                                    beforeSend: function () {
                                           // $("#resultado").html("Procesando, espere por favor...");
                                    },
                                    success:  function (response) {
                                            console.log(response);
                                            var respuesta = parseInt(response);
                                            
                                            if(respuesta == 0)
                                            {
                                                $("#respuesta").html("Tiene asignaturas que no cumplen con el limite - Limite = " + <?php echo $limite[0]["limite"]; ?>+" horas");
                                                //setTimeout(function(){document.getElementById('respuesta').innerHTML = '';}, 3000);
                                                //return false;
                                                retorno = false;
                                                console.log("Entra");
                                            } 
                                            else if(respuesta == 1)
                                            {
                                                retorno = true;
                                                console.log(retorno);
                                            //setTimeout(function(){document.getElementById('resultado').innerHTML = '';}, 3000);
                                            var form = document.getElementById('import_form');
                                            //console.log(form);
                                            form.submit();
                                    }
                                    //console.log(response);
                                    }
                            });
    
            }
            else
            {
            //console.log("Entro");
               $("#respuesta").html("Error! Debe de seleccionar al menos una asignatura");
               setTimeout(function(){document.getElementById('respuesta').innerHTML = '';}, 3000);
               retorno = false;
            }
            //console.log(retorno);
            return retorno;
        }
        </script>
</body>
</html>
