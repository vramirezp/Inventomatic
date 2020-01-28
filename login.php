<?php 
    include('include/config.php');
    include('include/scripts.php');

    if(isset($_SESSION["usuario"]))
    {
      header('Location: /Inventomatic');
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Inventomatic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="imagenes/icono.ico" type="image/x-icon">
  <link rel="icon" href="imagenes/icono.ico" type="image/x-icon">
</head>
<body>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script type="text/javascript" src="js/login.js"></script>

  <div class="login-page">
    <div class="form"> 
    <h1><strong>Inventomatic</strong></h1>
    <hr class="hr-abajo">    
      <form action="" method="POST" class="login-form" id="formLogin" enctype="multipart/form-data">
        <input type="hidden" name="funcion" value="1">
        <input type="text" name="correo" placeholder="Correo"/>
        <input type="password" name="pass" placeholder="Contraseña"/>
        <button id="iniciar">Iniciar sesión</button>        
    </div>
  </div>
<?php 
  include('include/footer.php');
?>