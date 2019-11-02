<?php
include '../layout\layout.php';
include '../helpers\utilities.php';
require_once 'estudiante.php';

$layout = new Layout(true);
$utilities = new Utilities();


session_start();

$estudiantes = $_SESSION['estudiantes'];

$containId = isset($_GET['id']); 
$element = [];

if ($containId) {
    $element = $utilities->searchProperty($estudiantes, 'id', $_GET['id'])[0]; 
    $elementIndex = $utilities->getIndexElement($estudiantes, 'id', $_GET['id']);
    $selectedActivo=($element->status == "Activo") ? "checked" : ""; 
    $selectedInactivo=($element->status == "Inactivo") ? "checked" : ""; 
}

if (isset($_POST['name']) && isset($_POST['carreraId']) && isset($_POST['materiaFavorita'])) {
    
    $materiaFavorita = explode(",", $_POST['materiaFavorita']);    

    $updateEstudiante = new Estudiante($_GET['id'], $_POST['name'],$_POST['apellido'], $_POST['carreraId'],$_POST['status'],$materiaFavorita);

    if ($_FILES['profilePhoto']) {

        if ($_FILES['profilePhoto']['error'] == 4) {
            $updateEstudiante->profilePhoto = $element->profilePhoto;
        } else {
            $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
            $type =  $_FILES["profilePhoto"]["type"];
            $size =  $_FILES["profilePhoto"]["size"];
            $tmpname = $_FILES["profilePhoto"]["tmp_name"];
            $directory = "../Heroes";
            $name = 'img/' . $estudianteId . '.' . $typeReplace;

            $isSuccess = $utilities->uploadImage($directory, $name, $tmpname, $type, $size);



            if ($isSuccess) {
                $updateEstudiante->profilePhoto = $name;
            }
        }
    }
    $estudiantes[$elementIndex] =  $updateEstudiante; 

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
    <title>Editar</title>
</head>

<body>

    <?php $layout->printHeader(); ?>

    <main role="main">

        <?php if ($containId && !empty($element)) : ?>

            <div class="card">
                <div class="card-header">
                    <a href="../index.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Volver atras </a> Editando al Estudiante <strong><?php echo $element->name." ". $element->apellido ?></strong>
                </div>
                <div class="card-body">

                    <form method="POST"  enctype="multipart/form-data" action="edit.php?id=<?php echo $element->id ?>">

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputName">Nombre</label>
                                <input type="text" value="<?php echo $element->name ?>" name="name" class="form-control" id="InputName" placeholder="Introduzca el nombre ">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputApellido">Apellido</label>
                                <input type="text" value="<?php echo $element->apellido ?>" name="apellido" class="form-control" id="InputApellido" placeholder="Introduzca el apellido ">

                            </div>
                        </div>

                        <div class="col-md-4">
                        <div class="form-group">

                        <label for="estado"> Estado </label><br>
                            <input class="estado" type="radio" name="status" id="estado" value="Activo" <?php echo $selectedActivo; ?>>Activo<br>
                            <input class="estado" type="radio" name="status" id="estado" value="Inactivo" <?php echo $selectedInactivo; ?>>Inactivo<br>
                        </div>
                    </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company"> Carrera </label>
                                <select name="carreraId" class="form-control" id="company">

                                    <?php foreach ($utilities->carrera as $id => $text) : ?>
                                        <?php if ($id == $element->carrera) : ?>
                                            <option selected value="<?php echo $id; ?>"><?php echo $text; ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $id; ?>"><?php echo $text; ?></option>
                                        <?php endif; ?>

                                    <?php endforeach; ?>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputPower">Materias Favoritas</label>
                                <textarea name="materiaFavorita" class="form-control" id="InputPower" placeholder="Introduzca los poderes "> <?php echo $element->getTextMateriaFavorita()?> </textarea>
                                <small id="TechniquesHelp" class="form-text text-muted">Colocar las materias separados por comas</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="profilePhoto">Foto de perfil</label>
                                <input name="profilePhoto" type="file" class="form-control" id="InputPower" />

                                <div style="margin-top: 1%" class="card bg-dark" style="width: 18rem;">
                                <img class="bd-placeholder-img card-img-top" src="<?php echo $element->profilePhoto; ?>" width="225" height="225" alt="">

                            </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </form>

                </div>
            </div>

        <?php else : ?>

            <h2>No existe</h2>

        <?php endif; ?>

    </main>

    <?php $layout->printFooter(); ?>

</body>

</html>