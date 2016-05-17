<?php
require_once './core/zona_privada.php';
require_once './core/p.php';
require_once './core/paginator.class.php';

require_once 'menu.php';
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
	</style>
    </head>
    <body>
        <?php include './inc/header.php'; ?>
        <div class="container" id="principal">
            <div class="row">
               <div class="alert alert-success" style="width: 50%; background-color: #F8F8F8; border-color: #000000; color: #000000;" role="alert"><h3>Configurar:</h3>
                </div>
                <div class="col-xs-5">
                    
                    <fieldset>
                        <legend><h3>Limite horaria</h3></legend>
 <div class="mensaje"></div>
                                        <table class="table table-hover editinplace">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Tipo de contrato</th>
                                                    <th>Limite</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        
                             </fieldset>          
                        </div>
                <div class="col-xs-2"></div>
                        <div class="col-xs-5">
                            <fieldset>
                        <legend><h3>Pago por hora</h3></legend>
                            
 <div class="mensaje_p"></div>
                                        <table class="table table-hover editinplace_p">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Nivel</th>
                                                    <th>Pago por hora</th>
                                                </tr>
                                            </thead>
                                        </table>
                                       </fieldset>  
                                       
                        </div>
                    </div>
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
	$(document).ready(function() 
	{
		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "cajax/editinplace.php?tabla=1"
		})
		.done(function(json) {
                    
			json = $.parseJSON(json);
                console.log(json);
                //console.log(json);
                $('.editinplace').append(
					"<tbody>");
			for(var i=0;i<json.length;i++)
			{
				$('.editinplace').append(
					"<tr><td class='id'>"+json[i].id+"</td><td><span>"+json[i].contratacion+"</span></td><td class='editable add1' data-campo='limiteshoras'><span data-toggle='tooltip' title='Modificar limite'>"+json[i].limiteshoras+"<i class='fa fa-pencil ocultar'></i></span></td></tr>");
			}
		});
                $('.editinplace').append(
					"</tbody>");
		
		var td,campo,valor,id;
		$(document).on("click","td.editable span",function(e)
		{
			e.preventDefault();
			$("td.add1").removeClass("editable");
                        $("td.add1").removeClass("ocultar");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
                        
			id=$(this).closest("tr").find(".id").text();
			td.text("").html("<input type='number' name='"+campo+"' value='"+valor+"'> <a class='enlace guardar' href='#'><i class='fa fa-floppy-o fa-lg'></i></a> <a class='enlace cancelar' href='#'><i class='fa fa-ban fa-lg'></i> </a>");
		});
		
		$(document).on("click",".cancelar",function(e)
		{
			e.preventDefault();
			td.html("<span>"+valor+"<i class='fa fa-pencil ocultar'></i></span>");
			$("td.add1").addClass("editable");
                       
		});
		
		$(document).on("click",".guardar",function(e)
		{
			
			e.preventDefault();
			nuevovalor=$(this).closest("td").find("input").val();
                        
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "cajax/editinplace.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"<i class='fa fa-pencil ocultar'></i></span>");
					$("td.add1").addClass("editable");
                                        
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
				});
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
                //################################################################################################################
                //PARTE 2 
                $.ajax({
			type: "GET",
			url: "cajax/editinplace_p.php?tabla=1"
		})
		.done(function(json) {
			json = $.parseJSON(json);
                //console.log(json);
                $('.editinplace_p').append(
					"<tbody>");
			for(var i=0;i<json.length;i++)
			{
				$('.editinplace_p').append(
					"<tr><td class='id'>"+json[i].id+"</td><td><span>"+json[i].nivel+"</span></td><td class='editable_p add2' data-campo='pagoxhora'><span data-toggle='tooltip' title='Modificar limite'>"+json[i].pagoxhora+"<i class='fa fa-pencil ocultar'></i></span></td></tr>");
			}
		});
                $('.editinplace_p').append(
					"</tbody>");
		
		var td_p,campo_p,valor_p,id_p;
		$(document).on("click","td.editable_p span",function(e)
		{
			e.preventDefault();
			$("td.add2").removeClass("editable_p");
                        $("td.add2").removeClass("ocultar_p");
			td_p=$(this).closest("td");
			campo_p=$(this).closest("td").data("campo");
			valor_p=$(this).text();
                        
			id_p=$(this).closest("tr").find(".id").text();
			td_p.text("").html("<input type='number' name='"+campo_p+"' value='"+valor_p+"'> <a class='enlace_p guardar_p' href='#'><i class='fa fa-floppy-o fa-lg'></i></a> <a class='enlace_p cancelar_p' href='#'><i class='fa fa-ban fa-lg'></i> </a>");
		});
		
		$(document).on("click",".cancelar_p",function(e)
		{
			e.preventDefault();
			td_p.html("<span>"+valor_p+"<i class='fa fa-pencil ocultar'></i></span>");
			$("td.add2").addClass("editable_p");
                       
		});
		
		$(document).on("click",".guardar_p",function(e)
		{
			e.preventDefault();
			nuevovalor_p=$(this).closest("td").find("input").val();
			if(nuevovalor_p.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "cajax/editinplace_p.php",
					data: { campo: campo_p, valor: nuevovalor_p, id:id_p }
				})
				.done(function( msg ) {
					$(".mensaje_p").html(msg);
					td_p.html("<span>"+nuevovalor_p+"<i class='fa fa-pencil ocultar'></i></span>");
					$("td.add2").addClass("editable_p");
                                        
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
				});
                                
			}
			else $(".mensaje_p").html("<p class='ko'>Debes ingresar un valor</p>");
		});
	});
	
	</script>
</body>
</html>