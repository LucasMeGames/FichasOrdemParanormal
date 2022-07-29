<?php
require_once "./../../../config/includes.php";
require_once "./../ficha/aconfig_ficha.php";
?>
<!DOCTYPE html>
<html lang="br">
    <head>
        <?php require_once './../../../includes/head.html';?>
        <title><?=$nome?> - Portrait FichasOP</title>
        <?php require_once "./../../../includes/scripts.php";?>
        <style>
            .portrait {
                position: relative;
                width: 1000px;
                height: 1000px;
            }

            .personagem {
                position: absolute;
                height: 92.5%;
                width:  92.5%;
                margin-top: 4%;
                margin-left: 3.85%;
                border-radius: 50%;
            }
            .fundo {
                position: absolute;
                width: 1000px;
                height: 1000px;
            }
            .marca {
                position: absolute;
                width: 140%;
                height: 140%;
                opacity: 50%;
            }
            .vida{
                position: absolute;
                margin-top: 58%;
                margin-left: 91%;
                border: 20px solid black;
            }
            .san{
                position: absolute;
                margin-top: 75%;
                margin-left: 73.5%;
                border: 20px solid black;
            }
            .pef{
                position: absolute;
                height: 50%;
                width:  50%;
                margin-top: 55%;
                margin-left: -7%;
            }
            .pea{
                position: absolute;
                font-size: 150px;
                text-align: center;
                margin-top: 66%;
                margin-left: 3.5%;
                width: 28%;
                height: 28%;
                font-weight: bolder;
                text-shadow: 0px 0px 20px;
            }
            .pva{
                position: absolute;
                margin-top: 60%;
                margin-left: 93%;
                width: 128%;
                height: 15%;
                font-weight: bolder;
                text-shadow: 0px 0px 20px;
            }
            .sana{
                position: absolute;
                margin-top: 77%;
                margin-left: 93.5%;
                width: 128%;
                height: 15%;
                font-weight: bolder;
                text-shadow: 0px 0px 20px;
            }
            .dado{
                position: absolute;
                margin-top: 62%;
                margin-left: 180%;
                font-weight: bolder;
            }
            .show {
                animation: show 3s linear forwards;
            }
            @keyframes show {
                0% { left: 0%; }
                25% { left: 50%; }
                75% { left: 50%; }
                100% { left: 0%; }
            }

            .fs-0 {
                font-size: 100px;
            }
            .bg-danger-a {
                background-color: #af0000;
            }
            .bg-danger-dark {
                background-color: #421317;
            }
            .bg-primary-a {
                background-color: #1138de;
            }
            .bg-primary-dark {
                background-color: #14225c;
            }
            .cor-dado {
                color: #691119;
            }
            .cor-resultado {
                color: #ffd600;
            }

            @keyframes morto {
                from { filter: brightness(100%); }
                to { filter: brightness(0%); }
            }

            @keyframes sec {
                from { filter: brightness(100%); }
                to { filter: brightness(30%); }
            }

            .pri.morto{
                animation: morto 2s linear forwards;
            }

            .sec.morto{
                animation: sec 2s linear forwards;
            }
            #portrait {
                margin: 5%;
            }

        </style>
    </head>
    <body class="bg-transparent">
    <main id="portrait"></main>
        <?php
        require_once "./../../../includes/scripts.php";
        ?>
    <script>
            $(document).ready(function () {
                /*
                $('#favicon').attr("href","<?=$_SESSION["UserMarca"]?:"/favicon.png?>"?>");
                $('.progress-bar').each(function(){
                    var $this = $(this);
                    var percent = $this.attr('percent');
                    $this.css("width",percent+'%');
                    $({animatedValue: 0}).animate({animatedValue: percent},{
                        duration: 2000,
                        step: function(){
                            $this.attr('percent', Math.floor(this.animatedValue) + '%');
                        },
                        complete: function(){
                            $this.attr('percent', Math.floor(this.animatedValue) + '%');
                        }
                    });
                });

            /*
                var interval = 5000;   //number of mili seconds between each call
                var refresh = function() {
                    $('#detalhes').load(' #detalhes>*');
                    setTimeout(function() {
                        refresh();
                    }, interval);
                }
                refresh();
            */
            socket = io('https://<?=$_SERVER["HTTP_HOST"]?>', {
                reconnectionDelay: 5000,
            });
            socket.on('connect', function () {
                console.log("Conectado.")
            });
            socket.emit('create', '<?=$fichat?>');
            socket.on('<?=$fichat?>', function(msg) {
                if(msg.dado) {
                    valordado = msg.dado.result;
                    subtimer();
                }
                if(msg.vida) {
                    pv = msg.vida.pv;
                    pva = msg.vida.pva;
                    san = msg.vida.san;
                    sana = msg.vida.sana;
                    pea = msg.vida.pea;
                    mor = msg.vida.mor
                    tick();
                }
                console.log(msg);
            });
            });
        </script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js" data-cfasync="false"></script>
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin data-cfasync="false"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin data-cfasync="false"></script>
    <script type="text/babel">
        const portrait = ReactDOM.createRoot(
            document.getElementById('portrait')
        );
        let pv = <?=$pv?>;
        let pva = <?=$pva?>;
        let san = <?=$san?>;
        let sana = <?=$sana?>;
        let pea = <?=$pea?>;
        let mor = <?=$morrendo?>;
        let foto = "<?=$morrendo?$urlphotomor:($enlouquecendo?$urlphotoenl:($ppv<50?($urlphotofer?:$urlphoto):$urlphoto));?>";
        let morto = '<?=$morrendo?' morto':''?>';
        let elemento = '<?=$elemento?>';
        let dado = '';
        let valordado = '';
        let marca = '<?=$marca?:'https://fichasop.com/assets/img/marca_mount.png'?>'
        const timer = 1000;
        let time;

        function subtimer (){
            clearTimeout(time);
            time = setTimeout(show, timer);
        }

        function hide() {
            dado = '';
            tick();
        }
        function show(){
            dado = 'show';
            setTimeout(hide,3000);
            tick();
        }
        function updtsaude(){
            if (mor === 1){
                morto = ' morto';
            } else {
                morto = '';
            }
            if (pva === 0) {
                foto = "<?=$urlphotomor?>"
            } else {
                if (sana <= 0) {
                    foto = "<?=$urlphotoenl?>";
                } else {
                    if (percent(pva, pv) < 50) {
                        foto = "<?=$urlphotofer?>";
                    } else {
                        foto = "<?=$urlphoto?>";
                    }
                }
            }
        }

        function percent(max,min = 0){
            if((max === 0 && min === 0) || max === 0){
                return 0;
            }
            var p = (max / min) * 100;
            if (p > 100){
                return 100;
            } else {
                return p;
            }
        }


        function tick() {
            updtsaude()
            const element =(
                <div className="portrait m-5">
                    <div className={"dado fa-10x " + dado}>
                        <i className="fa-regular fa-2x cor-dado fa-dice-d20"></i>
                        <span className="cor-resultado position-absolute top-50 start-50 translate-middle resultadodado">{valordado}</span>
                    </div>
                    <div>
                        <div style={{width: 275 + '%',position: 'absolute',height: 1 + 'px'}}></div>
                            <div className="vida progress h-auto bg-danger-dark border-dark" style={{width: 132.5 + '%'}}>
                                <div className="progress-bar bg-danger-a text-end" id="progresssan" role="progressbar" style={{height: 150 + 'px', width: percent(pva,pv) + '%'}}></div>
                                <img className={"position-absolute start-50 top-50 translate-middle sec" + morto} style={{width: "120%"}} src='/assets/img/vida.png' />
                            </div>
                        <span className="pva text-center text-white fs-0">{pva}/{pv}</span>
                            <div className="san progress h-auto bg-primary-dark border-dark" style={{width: 150 + '%'}}>
                                <div className="progress-bar bg-primary-a text-end" id="progresssan" role="progressbar" style={{height: 150 + 'px', width: percent(sana,san) + '%'}}></div>
                                <img className={"position-absolute start-50 top-50 translate-middle sec" + morto } style={{width: "120%"}} src='/assets/img/sanidade.png' />
                            </div>
                        <span className="sana text-center text-white fs-0">{sana}/{san}</span>
                        <img className="fundo" src='/assets/img/fundo1.png' />
                        <img className={"marca start-50 top-50 translate-middle pri" + morto} src={marca} />
                        <img className={"personagem pri" + morto} src={foto} />
                        <img className="pef " src='/assets/img/fundo2.png' />
                        <div className="pea">
                            <span className="text-warning font8">{pea}</span>
                        </div>
                    </div>
                </div>);
            portrait.render(element);
        }
        tick();
    </script>
    </body>
</html>