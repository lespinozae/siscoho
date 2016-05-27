<?php 
session_start();

if (isset($_POST))
{
    include_once ("./core/logueo.php");
    function helper_user_data(){
        $user_data = array();
        if($_POST){
        if(array_key_exists('user',$_POST)){
            $user_data['user']= strtoupper(trim($_POST['user'], " "));
        }
        if(array_key_exists('password',$_POST)){
            $user_data['password']=md5($_POST['password']);
        }
        }
        return $user_data;
    }
    
    $usuario = new Usuario();
    $usuario->get(helper_user_data());
}
if(isset($_SESSION["user"]) and $_SESSION["user"]!=""):
        header('Location: home.php');
    endif;
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>..:: Sistema de control de carga horaria ::: Faculta de Educación e Idiomas ::..</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes"> 
<?php
        include './inc/head_common.php';
        ?>
<style>
    @import "bourbon";

body {
	background: #eee !important;	
}

.wrapper {	
	margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  

  
}

.username-field { background: url(img/user.png) no-repeat; }

        .password-field { background: url(./img/password.png) no-repeat; }
  
  .form-signin-heading {
	  margin-bottom: 30px;
	}

	.form-control {
	  position: relative;
	  font-size: 12px;
	  height: auto;
	  
          padding: 11px 15px 10px 50px;

		&:focus {
		  z-index: 2;
		}
	}
	input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-left-radius: 0;
	  border-bottom-right-radius: 0;
	}

	input[type="password"] {
	  margin-bottom: 20px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
</style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper">
                    <form class="form-signin" action="#" method="post">
                        <?php
                        if (isset($_GET["valid"]) and $_GET["valid"] != "") {
                            echo "<div style='text-align: center'>Contraseña erronea. Tiene " . mStatic::cantidad_logueo(base64_decode($_GET["valid"])) . " intentos disponible</div>";
                        } else {
                            if (isset($_GET["token"]) and $_GET["token"] == "8dbb8b19772f3174493b1437c231a9ec") {
                                echo "<div style='text-align: center'>Usuarios bloqueado. Contactese con su administrador o vuelva a intentarlo dentro de 2 horas</div>";
                            } else {
                                echo "<div style='text-align: center'>Tiene 3 intentos disponible</div>";
                            }
                        }
                        ?>
                        <h1 class="form-signin-heading">Acceso</h1>		  
                        <input type="text" id="username" name="user" placeholder="Usuario" size="16" class="form-control username-field" autocomplete="off" autofocus="autofocus" />
                        <input type="password" id="password" name="password" placeholder="Contrase&ntilde;a" class="form-control password-field"/>


                        <br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>


                        <?php
                        if (isset($_GET['token']) and $_GET['token'] == '84b0e6253cd626387b427d7741453bda') {
                            ?>

                            <hr/>
                            <center> <span style="text-align: center; color: #B40404;">El usuario no existe en la base de datos</span></center>

                        <?php } ?>
                            <br/><hr />
                            <a href="rp.html" style="padding-top: 10px;">Reiniciar contrase&ntilde;a</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div> <!-- /content -->

</div> <!-- /account-container -->





<?php
include './inc/footer_common.php';
?>
</body>

</html>
