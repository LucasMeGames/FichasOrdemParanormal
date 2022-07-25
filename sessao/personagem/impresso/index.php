<?php
require_once("./../../../config/mysql.php");
require_once "./../ficha/aconfig_ficha.php";
?>
<html lang="br">
<!DOCTYPE html>
<head>
    <?php require_once './../../../includes/head.html'; ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title><?php echo $nome ?: "Desconhecido"; ?> - Ficha</title>
    <style>
        @font-face {
            font-family: 'daisywheelregular';
            src: url('../../../assets/css/daisywhl-webfont.woff2') format('woff2'),
            url('../../../assets/css/daisywhl-webfont.woff') format('woff');

        }

        .daisy {
            font-family: 'daisywheelregular';
        }

        .image-container {
            width: 695px;
            height: 982px;
            overflow: hidden;
            position: sticky;
        }

        .image-container img {
            width: 695px;
            height: 982px;
        }

        .nome {
            position: absolute;
            text-align: left;
            width: auto;
            margin: 7% 0 0 26%;
            font-size: 20px;
        }

        .principal {
            position: absolute;
            text-align: left;
            width: 115px;
            font-size: 10px;
            font-weight: bold;
        }

        .origem {
            margin-top: 20%;
            margin-left: 21%;
        }

        .nex {
            margin-top: 23%;
            margin-left: 21%;
        }

        .classe {
            margin-top: 20%;
            margin-left: 45.5%;
        }

        .patente {
            margin-top: 23%;
            margin-left: 45.5%;
        }

        /*ATRIBUTOS*/
        .atributos {
            width: 70px;
            height: 70px;
            position: absolute;
            text-align: center;
            font-weight: bolder;
            font-size: 35px;
        }

        .agi {
            margin: 34.5% 0 0 33.15%;
        }

        .for {
            margin: 43.6% 0 0 20.6%;
        }

        .int {
            margin: 43.6% 0 0 46%;
        }

        .pre {
            margin: 58.75% 0 0 24.7%;
        }

        .vig {
            margin: 58.75% 0 0 41.5%;
        }

        /*Saúde*/
        .saude {
            position: absolute;
            text-align: center;
            width: 5%;
            font-weight: bold;
            font-size: 18px;
        }

        .PV {
            margin: 82% 0 0 25.7%;
        }

        .SAN {
            margin: 87% 0 0 25.7%;
        }

        .PE {
            margin: 92% 0 0 25.7%;
        }

        /*Defesas*/
        .defesas {
            position: absolute;
            text-align: center;
            font-weight: bold;
            width: 5%;
            font-size: 18px;
        }

        .passiva {
            margin: 82% 0 0 56.5%;
        }

        .bloqueio {
            margin: 86.9% 0 0 56.5%;
        }

        .esquiva {
            margin: 92% 0 0 56.5%;
        }

        /*Resistencias a Dano*/
        .resistencias {
            position: absolute;
            text-align: center;
            font-weight: bold;
            width: 5%;
            font-size: 17px;

        }

        .fisica {
            margin: 100.7% 0 0 46%;
        }

        .balistica {
            margin: 100.7% 0 0 52.59%;
        }

        .sangue {
            margin: 107.6% 0 0 33.21%;
        }

        .morte {
            margin: 107.6% 0 0 39.75%;
        }

        .energia {
            margin: 107.6% 0 0 46.25%;
        }

        .conhecimento {
            margin: 107.6% 0 0 52.75%;
        }

        .mental {
            margin: 107.6% 0 0 25.6%;
        }

        /*Pericias*/
        .pericia {
            margin-left: 81%;
            font-size: 12px;
            font-weight: bold;
            width: 3.5%;
        }

        .treinado {
            position: absolute;
            text-align: center;
            margin-left: 85%;
        }

        .atletismo {
            position: absolute;
            text-align: center;
            margin-top: 40%;
        }

        .atualidade {
            position: absolute;
            text-align: center;
            margin-top: 43.13%;
        }

        .ciencia {
            position: absolute;
            text-align: center;
            margin-top: 46.26%;
        }

        .diplomacia {
            position: absolute;
            text-align: center;
            margin-top: 49.39%;
        }

        .enganacao {
            position: absolute;
            text-align: center;
            margin-top: 52.52%;
        }

        .fortitude {
            position: absolute;
            text-align: center;
            margin-top: 55.65%;
        }

        .furtividade {
            position: absolute;
            text-align: center;
            margin-top: 58.78%;
        }

        .intimidacao {
            position: absolute;
            text-align: center;
            margin-top: 61.91%;
        }

        .intuicao {
            position: absolute;
            text-align: center;
            margin-top: 65.04%;
        }

        .investigacao {
            position: absolute;
            text-align: center;
            margin-top: 68.17%;
        }

        .luta {
            position: absolute;
            text-align: center;
            margin-top: 71.3%;
        }

        .medicina {
            position: absolute;
            text-align: center;
            margin-top: 74.43%;
        }

        .ocultismo {
            position: absolute;
            text-align: center;
            margin-top: 77.56%;
        }

        .percepcao {
            position: absolute;
            text-align: center;
            margin-top: 80.69%;
        }

        .pilotagem {
            position: absolute;
            text-align: center;
            margin-top: 83.82%;
        }

        .pontaria {
            position: absolute;
            text-align: center;
            margin-top: 86.95%;
        }

        .prestidigitacao {
            position: absolute;
            text-align: center;
            margin-top: 90.08%;
        }

        .profissao {
            position: absolute;
            text-align: center;
            margin-top: 93.21%;
        }

        .reflexos {
            position: absolute;
            text-align: center;
            margin-top: 96.34%;
        }

        .religiao {
            position: absolute;
            text-align: center;
            margin-top: 99.47%;
        }

        .tatica {
            position: absolute;
            text-align: center;
            margin-top: 102.6%;
        }

        .tecnologia {
            position: absolute;
            text-align: center;
            margin-top: 105.73%;
        }

        .vontade {
            position: absolute;
            text-align: center;
            margin-top: 108.86%;
        }

        /*Armas*/
        .Slot1 {
            position: absolute;
            margin-top: 121.2%;
        }

        .Slot2 {
            position: absolute;
            margin-top: 123.9%;
        }

        .Slot3 {
            position: absolute;
            margin-top: 126.8%;
        }

        .Slot4 {
            position: absolute;
            margin-top: 129.5%;
        }

        .Arma {
            text-align: center;
            font-size: 12px;
            margin-left: 14.2%;
            width: 11.75%;
        }

        .Tipo {
            margin-left: 26.9%;
            font-size: 12px;
            width: 14.5%;
        }

        .Ataque {
            margin-left: 42.36%;
            font-size: 12px;
            width: 6.2%;
        }

        .Alcance {
            margin-left: 49.8%;
            font-size: 12px;
            width: 8.5%;
        }

        .Dano {
            margin-left: 59.3%;
            font-size: 12px;
            width: 6.1%;
        }

        .Critico {
            margin-left: 67%;
            font-size: 12px;
        }

        .Recarga {
            margin-left: 74.6%;
            font-size: 12px;
            width: 6.25%;
        }

        .Especial {
            margin-left: 82.1%;
            font-size: 12px;
            width: 8.5%;
        }

        .Proeficiencias {
            position: absolute;
            text-align: center;
            width: 40%;
            margin: 14% 0 0 7.5%;
            font-size: 14px;
        }

        .Habilidades {
            position: absolute;
            text-align: center;
            width: 35%;
            margin: 14% 0 0 50%;
            font-size: 14px;
        }

        .Inventario {
            letter-spacing: -0.4rem;
            word-spacing: -1rem;
            font-size: 100px;
            font-weight: lighter;
        }

        .Inv1 {
            position: absolute;
            margin-top: 47.5%;
        }

        .Inv2 {
            position: absolute;
            margin-top: 50.25%;
        }

        .Inv3 {
            position: absolute;
            margin-top: 53%;
        }

        .Inv4 {
            position: absolute;
            margin-top: 55.75%;
        }

        .Inv5 {
            position: absolute;
            margin-top: 58.5%;
        }

        .Inv6 {
            position: absolute;
            margin-top: 61.25%;
        }

        .Inv7 {
            position: absolute;
            margin-top: 64%;
        }

        .Inv8 {
            position: absolute;
            margin-top: 66.75%;
        }

        .Inv9 {
            position: absolute;
            margin-top: 69.5%;
        }

        .Inv10 {
            position: absolute;
            margin-top: 72.25%;
        }

        .Inv11 {
            position: absolute;
            margin-top: 75%;
        }

        .Item {
            margin-left: 8.75%;
            text-align: center;
            width: 22.5%;
        }

        .Detalhes {
            margin-left: 31.25%;
            width: 35%;
            text-align: left;
            letter-spacing: +5px;
            word-spacing: +5px;
        }

        .Espacos {
            margin-left: 67.5%;
            text-align: center;
            width: 9%;
        }

        .Prestigio {
            margin-left: 77.25%;
            text-align: center;
            width: 9%;
        }

        .Espaco {
            position: absolute;
            text-align: right;
            width: 25%;
            margin: 39.9% 0 0 58%;
            font-size: 85px;
        }
    </style>
</head>
<body>
<!------------HTML----------------------->
<div class="container-fluid">
    <div class="row">
        <div class="col my-4">
            <div class="image-container">
                <div class="nome">Lucas Daniel</div>
                <div>
                    <span class="principal origem">Profissional da Saúde</span>
                    <span class="principal classe">Combatente</span>
                    <span class="principal nex">55%</span>
                    <span class="principal patente">Veterano</span>
                </div>
                <div>
                    <span class="atributos for rounded-circle">+99</span>
                    <span class="atributos agi rounded-circle">+99</span>
                    <span class="atributos int rounded-circle">+99</span>
                    <span class="atributos vig rounded-circle">+99</span>
                    <span class="atributos pre rounded-circle">+99</span>
                </div>
                <div>
                    <span class="saude PV">+99</span>
                    <span class="saude PE">+99</span>
                    <span class="saude SAN">+99</span>
                </div>
                <div>
                    <span class="defesas passiva">+99</span>
                    <span class="defesas bloqueio">+99</span>
                    <span class="defesas esquiva">+99</span>
                </div>
                <div>
                    <span class="resistencias mental">+99</span>
                    <span class="resistencias sangue">+99</span>
                    <span class="resistencias morte">+99</span>
                    <span class="resistencias energia">+99</span>
                    <span class="resistencias conhecimento">+99</span>
                    <span class="resistencias fisica">+99</span>
                    <span class="resistencias balistica">+99</span>
                </div>
                <div>
                    <span class="pericia atletismo">+5</span><span class="pericia treinado atletismo">Treinado</span>
                    <span class="pericia atualidade">+5</span><span class="pericia atualidade treinado">Treinado</span>
                    <span class="pericia ciencia">+5</span><span class="pericia treinado ciencia">Treinado</span>
                    <span class="pericia diplomacia">+5</span><span class="pericia treinado diplomacia">Treinado</span>
                    <span class="pericia enganacao">+5</span><span class="pericia treinado enganacao">Treinado</span>
                    <span class="pericia fortitude">+5</span><span class="pericia treinado fortitude">Treinado</span>
                    <span class="pericia furtividade">+5</span><span
                            class="pericia treinado furtividade">Treinado</span>
                    <span class="pericia intimidacao">+5</span><span
                            class="pericia treinado intimidacao">Treinado</span>
                    <span class="pericia intuicao">+5</span><span class="pericia treinado intuicao">Treinado</span>
                    <span class="pericia investigacao">+5</span><span
                            class="pericia treinado investigacao">Treinado</span>
                    <span class="pericia luta">+5</span><span class="pericia treinado luta">Treinado</span>
                    <span class="pericia medicina">+5</span><span class="pericia treinado medicina">Treinado</span>
                    <span class="pericia ocultismo">+5</span><span class="pericia treinado ocultismo">Treinado</span>
                    <span class="pericia percepcao">+5</span><span class="pericia treinado percepcao">Treinado</span>
                    <span class="pericia pilotagem">+5</span><span class="pericia treinado pilotagem">Treinado</span>
                    <span class="pericia pontaria">+5</span><span class="pericia treinado pontaria">Treinado</span>
                    <span class="pericia prestidigitacao">+5</span><span class="pericia treinado prestidigitacao">Treinado</span>
                    <span class="pericia profissao">+5</span><span class="pericia treinado profissao">Treinado</span>
                    <span class="pericia reflexos">+5</span><span class="pericia treinado reflexos">Treinado</span>
                    <span class="pericia religiao">+5</span><span class="pericia treinado religiao">Treinado</span>
                    <span class="pericia tatica">+5</span><span class="pericia treinado tatica">Treinado</span>
                    <span class="pericia tecnologia">+55</span><span class="pericia treinado tecnologia">Treinado</span>
                    <span class="pericia vontade">+55</span><span class="pericia treinado vontade">Treinado</span>
                </div>
                <div>
                    <span class="Slot1 Arma">Katana</span>
                    <span class="Slot1 Tipo">Duas mão</span>
                    <span class="Slot1 Ataque">+5</span>
                    <span class="Slot1 Alcance">Adjacente</span>
                    <span class="Slot1 Dano">4d20</span>
                    <span class="Slot1 Critico">20/2d</span>
                    <span class="Slot1 Recarga">5/Mov</span>
                    <span class="Slot1 Especial">Discreta</span>
                </div>
                <div>
                    <span class="Slot2 Arma">Katana</span>
                    <span class="Slot2 Tipo">Duas mão</span>
                    <span class="Slot2 Ataque">+5</span>
                    <span class="Slot2 Alcance">Adjacente</span>
                    <span class="Slot2 Dano">4d20</span>
                    <span class="Slot2 Critico">20/2d</span>
                    <span class="Slot2 Recarga">5/Mov</span>
                    <span class="Slot2 Especial">Discreta</span>
                </div>
                <div>
                    <span class="Slot3 Arma">Katana</span>
                    <span class="Slot3 Tipo">Duas mão</span>
                    <span class="Slot3 Ataque">+5</span>
                    <span class="Slot3 Alcance">Adjacente</span>
                    <span class="Slot3 Dano">4d20</span>
                    <span class="Slot3 Critico">20/2d</span>
                    <span class="Slot3 Recarga">5/Mov</span>
                    <span class="Slot3 Especial">Discreta</span>
                </div>
                <div>
                    <span class="Slot4 Arma">Katana</span>
                    <span class="Slot4 Tipo">Duas mão</span>
                    <span class="Slot4 Ataque">+5</span>
                    <span class="Slot4 Alcance">Adjacente</span>
                    <span class="Slot4 Dano">4d20</span>
                    <span class="Slot4 Critico">20/2d</span>
                    <span class="Slot4 Recarga">5/Mov</span>
                    <span class="Slot4 Especial">Discreta</span>
                </div>
                <img alt="Ficha frontal" src="../../../assets/img/Ficha%20frontal.png"/>
            </div>
        </div>
        <div class="col my-4">
            <div class="image-container">
                <div>
                    <span class="Proeficiencias">Armas de fogo(Curto e Médias)</span>
                </div>
                <div>
                    <span class="Habilidades"><span class="fw-bold">Ataque Poderoso:</span> Antes de atacar, Gaste 2 PE para ter +5 nos teste de AGILIDADE, FORÇA OU VIGOR, Ou +5 no DANO</span>
                </div>
                <div>
                    <span class="Habilidades"><span class="fw-bold">Ataque Poderoso:</span> Antes de atacar, Gaste 2 PE para ter +5 nos teste de AGILIDADE, FORÇA OU VIGOR, Ou +5 no DANO</span>
                </div>
                <img alt="Ficha frontal" src="../../../assets/img/Ficha%20traseira%201.png"/>
            </div>
        </div>
    </div>
</div>
</body>
</html>