<?php
require_once "./../../config/mysql.php";
$con = con();
$uid = $_SESSION["UserID"];
$id = intval($_GET["id"] ?: $_POST["id"]);
if (!$_SESSION["UserAdmin"]) {
    if ($id === 0 || !VerificarMestre($id)) {
        header("Location: ./..");
    }
}
$q = $con->query("Select * FROM `ligacoes` WHERE id_missao = '" . $id . "';");


require_once './includes/atualizar.php';
$m = $con->query("SELECT * FROM `dados_mestre` WHERE `id_missao` = '".$id."';");
$fichanpcs = $con->query("SELECT * FROM `fichas_npc` WHERE `missao` = '$id' AND `categoria` = 0;");
$fichasmonstro = $con->query("SELECT * FROM `fichas_npc` WHERE `missao` = '$id' AND `categoria` = 1;");
?>
<!DOCTYPE html>
<html lang="br">
    <head>
        <?php require_once "./../../includes/head.html"; ?>
        <title>Mestre - FichasOP</title>
    </head>
    <body class="bg-black text-white">
    <main class="container-fluid mt-5">
        <div class="row g-2">
            <?php
            require_once "./includes/card_jogadores.php";
            if($_SESSION["UserAdmin"]){
	            require_once "./includes/card_dadosjogadores.php";
            }
            require_once "./includes/card_iniciativas.php";
            require_once "./includes/card_notas.php";
            require_once "./../include_geral/card_dice.php";
            require_once "./includes/card_npc.php";
            ?>
        </div>
    </main>
    <div>
    <?php
    require_once "./../include_geral/modal_dice.php";
    require_once "./includes/modal_jogadores.php";
    require_once "./includes/modal_npc.php";
    ?>
    </div>



    <?php require_once "./../../includes/scripts.php"; ?>
    <?php require_once "./../../includes/top.php";?>
    <?php require_once "./../include_geral/scripts.php";?>
    <?php require_once "./includes/scripts.php"; ?>
    </body>
</html>