<?php
header("X-Robots-Tag: none");
header('Content-Type: application/json');

require_once './../../config/mysql.php';


$dado = $_POST["dado"]?:'';
$dano = $_POST["dano"]?:'';



error_reporting(E_ERROR | E_PARSE);
if (!empty($_GET) || !empty($_POST))
    echo json_encode(

        Rolar($dado,$dano)

    );