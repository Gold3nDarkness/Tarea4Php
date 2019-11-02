<?php

include '../layout\layout.php';
include '../helpers\utilities.php';
require_once 'estudiante.php';

$layout = new Layout(true);
$utilities = new Utilities();

session_start();

if (isset($_POST['name']) && isset($_POST['carreraId']) && isset($_POST['materiaFavorita'])) {

    $estudiantes = $_SESSION['estudiantes'];

    $estudianteId = 1; 

    if (!empty($estudiantes)) { 
        $lastElement = $utilities->getLastElement($estudiantes);  
        $estudianteId =  $lastElement->id + 1;  
    }

    $materiaFavorita = explode(",", $_POST['materiaFavorita']);    
    $newestudiante = new Estudiante($estudianteId, $_POST['name'],$_POST['apellido'], $_POST['carreraId'],$_POST['status'],$materiaFavorita);
    if ($_FILES['profilePhoto']) {

        $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
        $type =  $_FILES["profilePhoto"]["type"];
        $size =  $_FILES["profilePhoto"]["size"];
        $tmpname = $_FILES["profilePhoto"]["tmp_name"];
        $directory = "../estudiantes";
        $name = 'img/' . $estudianteId . '.' . $typeReplace;

        $isSuccess = $utilities->uploadImage($directory, $name, $tmpname, $type, $size);



        if ($isSuccess) {
            $newestudiante->profilePhoto = $name;
        }
    }
    array_push($estudiantes, $newestudiante); 

   $_SESSION['estudiantes'] = $estudiantes; 

   header("Location: ../index.php"); 
   exit(); 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Estudiante</title>
</head>

<body>

    <?php $layout->printHeader(); ?>

    <main role="main">

        <div class="card">
            <div class="card-header">
                <a href="../index.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Volver atras </a> Registra un estudiante
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="add.php">

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputName">Nombre</label>
                            <input type="text" name="name" class="form-control" id="InputName" placeholder="Introduzca el nombre ">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputApellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="InputApellido" placeholder="Introduzca el apellido ">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" style="display:none">
                            <label for="status"> status </label>
                                <br>
                                <input class="status" type="radio" name="status" id="status" value="Activo" checked>Activo<br>
                                <input class="status" type="radio" name="status" id="status" value="Inactivo">Inactivo<br>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="carrera"> Carrera </label>
                            <select name="carreraId" class="form-control" id="carrera">

                                <?php foreach ($utilities->carrera as $id => $text) : ?>
                                    <option value="<?php echo $id; ?>"><?php echo $text; ?></option>
                                <?php endforeach; ?>


                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputmateriaFavorita">Materias Favoritas</label>
                            <textarea name="materiaFavorita" class="form-control" id="InputmateriaFavorita" placeholder="Introduzca sus materias favoritas "></textarea>
                            <small id="materiaFavoritaHelp" class="form-text text-muted">Colocar las materias separados por comas</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="profilePhoto">Foto de perfil</label>
                            <input name="profilePhoto" type="file" class="form-control" id="InputmateriaFavorita" />

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear</button>
                </form>

            </div>
        </div>

    </main>

    <?php $layout->printFooter(); ?>

</body>

</html>