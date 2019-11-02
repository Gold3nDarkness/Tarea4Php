<?php
include 'layout\layout.php';
include 'helpers\utilities.php';
require_once 'estudiantes/estudiante.php';

$layout = new Layout(false);
$utilities = new Utilities();

session_start();

$_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array(); 

$listadoEstudiantes = $_SESSION['estudiantes'];

if (!empty($listadoEstudiantes)) {

    if (isset($_GET['carreraId'])) { 

        $listadoEstudiantes = $utilities->searchProperty($listadoEstudiantes, 'carrera', $_GET['carreraId']); 

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estudiante</title>
</head>

<body>

    <?php $layout->printHeader(); ?>


    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Estudiantes</h1>
                <p class="lead text-muted">Listado de estudiantes</p>
                <p>
                    <a href="estudiantes/add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nuevo estudiante</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                <div class="col-md-6"></div>

                <div class="col-md-6">
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="index.php?carreraId=1" class="btn btn-secondary">Redes</a>
                        <a href="index.php?carreraId=2" class="btn btn-secondary">Software</a>
                        <a href="index.php?carreraId=3" class="btn btn-secondary">Multimedia</a>
                        <a href="index.php" class="btn btn-secondary">TODOS</a>
                        <a href="index.php?carreraId=4" class="btn btn-secondary">Mecatronica</a>
                        <a href="index.php?carreraId=5" class="btn btn-secondary">Seguridad Informatica</a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php if (empty($listadoEstudiantes)) : ?>

                        <h2>No hay estudiantes registrado, <a href="estudiantes/add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nuevo estudiante</a> </h2>

                    <?php else : ?>

                        <?php foreach ($listadoEstudiantes as $estudiante) : ?>

                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                
                                <img width="100%" height="225px" src="<?php echo "estudiantes/".$estudiante->profilePhoto; ?>" alt="">

                                    <div class="card-body">
                                        <p class="card-text"><strong> <?php echo $estudiante->name . " ".$estudiante->apellido; ?> </strong><br><?php echo $utilities->carrera($estudiante).'<br>'. $estudiante->status;?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                            <a href="estudiantes/detail.php?id=<?php echo $estudiante->id ?>" class="btn text-white btn-sm bg-primary btn-outline-secondary">Ver</a>
                                                <a href="estudiantes/edit.php?id=<?php echo $estudiante->id ?>" class="btn text-white btn-sm bg-warning btn-outline-secondary">Editar</a>
                                                <a href="estudiantes/delete.php?id=<?php echo $estudiante->id ?>" class="btn text-white btn-sm bg-danger btn-outline-secondary">Eliminar</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
    </main>

    <?php $layout->printFooter(); ?>

</body>

</html>