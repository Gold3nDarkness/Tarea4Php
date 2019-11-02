<?php
require_once '../helpers/utilities.php';
require_once 'estudiante.php';

$utilities = new Utilities();

session_start();

$estudiantes = $_SESSION['estudiantes'];

$containId = isset($_GET['id']); 
$estudianteId = 0;

$element = [];

if ($containId) {
    $estudianteId = $_GET['id']; 
    $elementIndex = $utilities->getIndexElement($estudiantes, 'id', $estudianteId); 

    unset($estudiantes[$elementIndex]); 
    $_SESSION['estudiantes'] = $estudiantes; 
}

 header("Location: ../index.php"); 
 exit(); 

?>