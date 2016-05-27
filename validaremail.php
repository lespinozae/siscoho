<?php
require_once './core/DBConnector.php';
ini_set('display_errors', 1);
        error_reporting(E_ALL);
	function generarLinkTemporal($idusuario, $username){

		$cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);
                
		$sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES(?,?,?,NOW());";
                
                $data = array("iss", "{$idusuario}", "{$username}", "{$token}");
                $resultado = DBConnector::ejecutar($sql, $data);
                
		if($resultado){
			$enlace = $_SERVER["SERVER_NAME"].'/siscoho/restablecer.php?idusuario='.sha1($idusuario).'&token='.$token;
			return $enlace;
		}
		else
			return FALSE;
	}

	function enviarEmail( $email, $link ){

		$mensaje = '<html>
		<head>
 			<title>Restablece tu contraseña</title>
		</head>
		<body>
 			<p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
 			<p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
 			<p>
 				<strong>Enlace para restablecer tu contraseña</strong><br>
 				<a href="'.$link.'"> Restablecer contraseña </a>
 			</p>
		</body>
		</html>';

		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
		
		mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
	}
	
	///$email = $_POST['email'];
	$email = $_GET['email'];
        $respuesta = new stdClass();

if ($email != "") {
    $sql = "SELECT docentes.pnombre, docentes.snombre, docentes.papellido, docentes.sapellido, docentes.id, docentes.cedula, usuario.pass, docentes.direccion from usuario INNER join docentes ON usuario.docentes_id = docentes.id where docentes.direccion = ?";

    $data = array("s", "{$email}");
    $fields = array("pnombre" => "", "snombre" => "", "papellido" => "", "sapellido" => "", "id" => "", "cedula" => "", "pass" => "", "direccion" => "");

    $resultado = DBConnector::ejecutar($sql, $data, $fields);
    echo $email;
    //print_r($resultado);
    var_dump($resultado);
    if (count($resultado) > 0) {
        $linkTemporal = generarLinkTemporal($resultado[0]['id'], $resultado[0]['cedula']);
        if ($linkTemporal) {
            enviarEmail($email, $linkTemporal);
            $respuesta->mensaje = '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña <br /> <a class="btn btn-info">Atras</a></div>';
        }
    } else
        $respuesta->mensaje = '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
} else
    $respuesta->mensaje = "Debes introducir el email de la cuenta";
echo json_encode($respuesta);
