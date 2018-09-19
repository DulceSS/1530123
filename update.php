<?php
include_once('db/database2.php');

$id = isset( $_GET['id'] ) ? $_GET['id'] : '';  //Se revisa que el id del usuario se encuentre mediante el metodo get.
$r = search($id); //Se realiza una busqueda en la base de datos donde se obtienen los atributos del registro con el id ingresado.

$t = $_GET['t']; //Se obtiene un valor mediante metodo GET, que se pasa por la URL

//Se revisa que todos las variables de los campos , se encuentren definidas, para posteriormente realizar la actualizacion y al final se
//realiza un redireccionado a la pagina principal.
if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['posicion']) && 
    isset($_POST['carrera']) && isset($_POST['email'])){
  update($_POST['id'],$_POST['nombre'],$_POST['posicion'],$_POST['carrera'],$_POST['email'],$t,$id);//Llamada al metodo para la acción en base de datos
  header("location: sistema_equipos.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h3>Modificar Usuario</h3>
        <br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
                <form method="POST" action="update.php?id=<?php echo($id)?>&t=<?php echo($t) ?>">
                  <!-- Se usa el registro buscando anteriormente para rellenar los campos con los valores
                      existentes, así el usuario no tiene que recordarlos y volverlos a llenar-->
                  <label for="id">ID:</label>
                  <input type="text" name="id" value="<?php echo($r['id'])?>"><br>
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre" value="<?php echo($r['nombre'])?>"><br>
                  <label for="posicion">Posición:</label>
                  <input type="text" name="posicion" value="<?php echo($r['posicion'])?>"><br>
                  <label for="carrera">Carrera:</label>
                  <input type="text" name="carrera" value="<?php echo($r['carrera'])?>"><br>
                  <label for="email">Email:</label>
                  <input type="email" name="email" value="<?php echo($r['email'])?>"><br>
                  <button type="submit" class="success">Actualizar</button>
                </form>
            </div>
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>