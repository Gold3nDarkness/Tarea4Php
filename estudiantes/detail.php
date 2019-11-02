<?php
include '../layout\layout.php';
include '../helpers\utilities.php';
require_once 'estudiante.php';

$layout = new Layout(true);
$utilities = new Utilities();


session_start();

$estudiantes = $_SESSION['estudiantes'];

$containId = isset($_GET['id']); 

$element;

if ($containId) {
    $element = $utilities->searchProperty($estudiantes, 'id', $_GET['id'])[0]; 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle</title>
</head>

<body>

    <?php $layout->printHeader(); ?>

    <main role="main">

        <div class="row ">

            <div class="col-md-1">

            </div>

            <div class="col-md-9">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                    <a href="../index.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Volver atras </a>
                        <h3 class="mb-0">Estudiante <strong><?php echo $element->name." ". $element->apellido ?></strong></h3>
                        <div class="mb-1 text-muted"><?php echo $element->getTextCarrera(); ?></div>

                        <?php if (!empty($element->materiaFavorita)) : ?>
                            <div class="card" style="width: 18rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-dark text-white">Materia Favoritas</li>
                                    <?php foreach ($element->materiaFavorita as $materiaFavorita) : ?>
                                        <li class="list-group-item"><?php echo $materiaFavorita?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>



                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img width="100%" height="225px" src="<?php echo $element->profilePhoto; ?>" alt="">
                    </div>
                </div>
            </div>

        </div>

    </main>

    <?php $layout->printFooter(); ?>



</body>

</html>