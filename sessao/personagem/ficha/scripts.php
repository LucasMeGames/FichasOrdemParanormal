<script>
    <?php if ($edit){?>
    function deletar(id,nome,tipo) {
        $('#deletarid').val(id);
        $('#deletarnome').html(nome);
        $('#deletarstatus').val(tipo);
        $('#deletar').modal('show');
    }//Deletar Arma
    function editarma(id) {
        $('#editarmatitle, #enome').val($("#armaid" + id + " .arma").text());
        $('#etipo').val($("#armaid" + id + " .tipo").text());
        $('#eataque').val($("#armaid" + id + " .ataque").text());
        $('#ealcance').val($("#armaid" + id + " .alcance").text());
        $('#edano').val($("#armaid" + id + " .dano").text());
        $('#ecritico').val($("#armaid" + id + " .critico").text());
        $('#emargem').val($("#armaid" + id + " .margem").text());
        $('#erecarga').val($("#armaid" + id + " .recarga").text());
        $('#eespecial').val($("#armaid" + id + " .especial").text());
        $('#editarmaid').val(id);
    }// Editar Arma
    function edititem(id) {
        $('#edititemtitle, #enom').val($("#itemid" + id + " .nome").text());
        $('#edes').val($("#itemid" + id + " .desc").text());
        $('#epes').val($("#itemid" + id + " .espaco").text());
        $('#epre').val($("#itemid" + id + " .prestigio").text());
        $('#edititid').val(id);
    }// Editar Item
    function cleanedit() {
        $('#deletarid,#deletarnome,#deletarstatus, #enome,#etipo,#eataque,#ealcance,#edano,#ecritico,#erecarga,#eespecial,#editarmaid,#enom,#edes,#epes,#epre,#edititid,#anom,#ades,#apes,#apre,#additemid').val('');
    }// Limpar modal edições


    function percent(max,min = 0){
        if((max === 0 && min === 0) || max === 0){
            return 0;
        }
        const p = (max / min) * 100;
        if (p > 100){
            return 100;
        } else {
            return p;
        }
    }


    let changingtimer;                //timer identifier
    const donetimer = 1500;
    function subtimer (){
        clearTimeout(changingtimer);
        changingtimer = setTimeout(subsaude, donetimer);
    }

    function updtsaude(valor,type) {
        let atual = type + 'a';
        let maxim = type;
        let saude = parseInt($("#saude ."+atual).val()) + valor;
        $("#saude ."+atual).val(saude);
        let per = parseInt($("#saude ."+maxim).val());
        if($('#saude .pva').val() < <?=$minpva?>){
            $('#saude .pva').val(<?=$minpva?>);
        }
        if($('#saude .sana').val() < <?=$minsana?>){
            $('#saude .sana').val(<?=$minsana?>);
        }
        if($('#saude .pea').val() < <?=$minpea?>){
            $('#saude .pea').val(<?=$minpea?>);
        }

        $("#barra"+atual).css('width', percent(saude,per)+'%');
        subtimer();
    }
    function subsaude() {
        let data = $('#saude :input').serialize();
        if ($('#morrendo').is(":checked")) {
            x = 1;
        } else {
            x = 0;
        }
        data += '&status=usau&mor='+x;
        console.log(data);
        $.post({
            url: '?token=<?=$fichat?>',
            dataType: 'json',
            data: data,
        }).done(function (data){
            updatesaude(data)
        });
    }
    $('#morrendo').change(function () {
        subtimer();
    })
    function updatesaude(data){
        $("#pv").load(location.href + " #pv>*");
        $("#san").load(location.href + " #san>*");
        $("#pe").load(location.href + " #pe>*");
        $("#saude .vidaatual").val(data.pva)
        $("#saude .vidamaxima").val(data.pv)
        $("#saude .sanatual").val(data.sana)
        $("#saude .sanmaxima").val(data.san)
        $("#saude .peatual").val(data.pea)
        $("#saude .pemaxima").val(data.pe)
        updatefoto()
        var msg;
        if (socket) {
            msg = {};
            msg["vida"] = data;
            socket.emit('<?=$fichat?>', msg);
        }
    }

    function updatefoto() {
        let pv = parseInt($('#saude .pv').val());
        let pva = parseInt($('#saude .pva').val());
        let san = parseInt($('#saude .san').val());
        let sana = parseInt($('#saude .sana').val());

        if (pva <= 0) {
            $("#fotopersonagem").attr("src", "<?=$urlphotomor;?>");
        } else {
            if (sana <= 0) {
                $("#fotopersonagem").attr("src", "<?=$urlphotoenl;?>");
            } else {
                if (percent(pva,pv) < 50) {
                    $("#fotopersonagem").attr("src", "<?=$urlphotofer;?>");
                } else {
                    $("#fotopersonagem").attr("src", "<?=$urlphoto;?>");
                }
            }
        }
    }


    $(document).ready(function () {
        socket = io('https://<?=$_SERVER["HTTP_HOST"]?>',{reconnectionDelay: 2500,});
        socket.on('connect', function () {console.log("Conectado.")});
        socket.emit('create', '<?=$fichat?>');


        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });


        $("#enex").val(<?=$nex?>)
        $("#eorigem").val(<?=$rqs["origem"]?>);
        $("#epatente").val(<?= $rqs["patente"];?>);
        $("#eclasse").val(<?=$rqs["classe"]?>)

        if ($('#enex').val() > 9){
            if($('#eclasse').val() == 1) {
                $("#etrilha .trilha-combatente").show();
            }else if($('#eclasse').val() == 2) {
                $("#etrilha .trilha-especialista").show();
            }else if($('#eclasse').val() == 3) {
                $("#etrilha .trilha-ocultista").show();
            }
        }

        $("#eclasse").change(function (){
            $("#etrilha .trilha").hide();
            $("#etrilha").val(0);
            if($("#enex").val() > 9){
                if($(this).val() == 1) {
                    $("#etrilha .trilha-combatente").show();
                }else if($(this).val() == 2) {
                    $("#etrilha .trilha-especialista").show();
                }else if($(this).val() == 3) {
                    $("#etrilha .trilha-ocultista").show();
                }
            }
        });

        $.fn.isValid = function () {
            return this[0].checkValidity()
        } // Função para checar validade de formularios

        $("form").submit(function (event) {
            $(this).addClass('was-validated');
            if (!$(this).isValid()) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault();
                $.post({
                    url: '?token=<?=$fichat?>',
                    data: $(this).serialize(),
                }).done(function (data) {
                    location.reload();
                })
            }
        })// Enviar qualquer formulario via jquery

        $("#saude .dblclick input").dblclick(function () {
            $(this).attr('readonly', false).toggleClass('border-0');
        }).focusout(function () {
            let attr = $(this).attr('readonly');
            if (typeof attr !== 'undefined' && attr !== false) {
                $(this).attr('readonly', true)
            } else {
                $(this).attr('readonly', true).toggleClass('border-0')
            }
            subsaude();
        })

            $("button, input:checkbox").on("click", function (){
                $(this).blur();
        })

        $("#enex").on('input', function () {
            $("#etrilha .trilha").hide();
            if($("#enex").val() > 9){
                if($('#eclasse').val() == 1) {
                    $("#etrilha .trilha-combatente").show();
                }else if($('#eclasse').val() == 2) {
                    $("#etrilha .trilha-especialista").show();
                }else if($('#eclasse').val() == 3) {
                    $("#etrilha .trilha-ocultista").show();
                }
            } else {
                $("#etrilha").val(0);
            }
        })
        $('#rolardadosbutton').on('click', function (){
            let dado = $("#rolardadosinput").val();
            $('#returncusdados').html("");
            let pattern = /^[d\d-+|*/AEFGINOPRTV]+\S$/g;
            let result = dado.match(pattern);
            if(result) {

                rolar(dado);
            } else {
                $('#returncusdados').html("<div class='alert alert-danger'>Preencha o campo da forma correta</div>");
            }
        })
        $(".fa-dice-d20").hover(function () {
            $(this).toggleClass("fa-spin");
        });
        $('#prev').html('<img class="position-absolute rounded-circle border border-light" width="100" height="100" style="max-width:100px;" src="' + $('#fotourl').val() + '">');
        $('#fotos .foto-perfil').on('input', function () {
            var src = jQuery(this).val();
            if (!src.match("^https?://(?:[a-z\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpg|png|jpeg|webp)$") || src == "") {
                $("#warning").html("Precisa ser HTTPS, e Terminar com com extensão de imagem(.jpg, .png ...)!");
                $('#prev').html('');
                return false;
            } else {
                $("#warning").html("");
                $('#prev').html('<img class="position-absolute rounded-circle border border-light" style="max-width:100px;" height="100" width="100" src="' + src + '">');
            }

        })

        $('#foto').change(function () {
            let fotovalor = $('#foto').val()
            if (fotovalor == '9') {
                $('#divfotourl').show();
                $("#fotourl,#fotofemor,#fotourenl,#fotourfer").attr("disabled", false)
            } else {
                $('#divfotourl').hide();
                $("#fotourl,#fotomor,#fotoenl,#fotofer,").attr("disabled", true)
            }
        })

        $('#simbolourl').on('input', function () {
            var src = $(this).val();

            if (!src.match("^https?://(?:[a-z\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpg|png|jpeg|webp)$") || src == "") {
                $("#warningsimbolo").html("Precisa ser HTTPS, e Terminar com com extensão de imagem(jpg,png,...)!");
                $('#prevsimbolo').html(' <img src="/assets/img/desconhecido.png" width="200" height="200" alt="Ritual">');
                return false;
            } else {
                $("#warningsimbolo").html("");
                $('#prevsimbolo').html('<img src="' + src + '" width="200" height="200" alt="Ritual">');
            }

        })

        $('#fotosimbolo').change(function () {
            let fotovalor = $('#fotosimbolo').val()
            if (fotovalor == '2') {
                $('#divfotosimbolourl').show();
                $("#simbolourl").attr("disabled", false)
            } else {
                $('#divfotosimbolourl').hide();
                $("#simbolourl").attr("disabled", true)
            }
        })

        $('.teedfa').on('input', function () {
            thisid = $(this).attr("id");
            var src = $('#' + thisid + ' input.simbolourl').val();
            if (!src.match("^https?://(?:[a-z\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpg|png|jpeg|webp)$") || src == "") {
                $('#' + thisid + ' div.warningsimbolo').html("Precisa ser HTTPS, e Terminar com com extensão de imagem(jpg,png,...)!");
                $('#' + thisid + ' div.prevsimbolo').html(' <img src="/assets/img/desconhecido.png" width="200" height="200" alt="Ritual">');
                return false;
            } else {
                $('#' + thisid + ' div.warningsimbolo').html("");
                $('#' + thisid + ' div.prevsimbolo').html('<img src="' + src + '" width="200" height="200" alt="Ritual">');
            }

        }).change(function () {
            thisid = $(this).attr("id");
            let fotovalor = $('#' + thisid + ' select.fotosimbolo').val()
            if (fotovalor == '2') {
                $('#' + thisid + ' .divfotosimbolourl').show();
                $('#' + thisid + ' input').attr("disabled", false)
            } else {
                $('#' + thisid + ' .divfotosimbolourl').hide();
                $('#' + thisid + ' input').attr("disabled", true)
            }
        })

        $('#addarmainvswitch').on('click', function () {
            if ($(this).is(":checked")) {
                $('#addarmainv input[type=text], #addarmainv input[type=number]').attr('disabled', false);
            } else {
                $('#addarmainv input[type=text], #addarmainv input[type=number]').attr('disabled', true);
            }
        }) //Ativar/Desativar Inventario em adicionar arma

        $('#card_principal .popout').on('click', function () {
            window.open("/sessao/personagem?popout=principal&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_dados .popout').on('click', function () {
            window.open("/sessao/personagem?popout=dados&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_atributos .popout').on('click', function () {
            window.open("/sessao/personagem?popout=atributos&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_inventario .popout').on('click', function () {
            window.open("/sessao/personagem?popout=inventario&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_pericias .popout').on('click', function () {
            window.open("/sessao/personagem?popout=pericias&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_habilidades .popout').on('click', function () {
            window.open("/sessao/personagem?popout=habilidades&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_proeficiencias .popout').on('click', function () {
            window.open("/sessao/personagem?popout=proeficiencias&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_rituais .popout').on('click', function () {
            window.open("/sessao/personagem?popout=rituais&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#card_rolar .popout').on('click', function () {
            window.open("/sessao/personagem?popout=rolar&token=<?=$fichat?>", "yyyyy", "width=480,height=360,resizable=no,toolbar=no,menubar=no,location=no,status=no");
            return false;
        })
        $('#pe input[type=checkbox]').change(function () {
            var checkboxes = $('#pe input:checkbox:checked').length;
            $.post({
                url: '?token=<?=$fichat?>',
                data: {status: 'pe', value: checkboxes},
            }).done(function () {
                $("#peatual").load("index.php?token=<?=$fichat?> #peatual");
            })
        });
        $("#verp").click(function () {
            $("#pericias .destreinado").toggle();
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
        $("#vera").click(function () {
            $('#inv .trocavision').toggle();
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
    <?php } else {?>
    $(document).ready(function () {
        $("#verp").click(function () {
            $("#pericias .destreinado").toggle();
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
        $("#vera").click(function () {
            $('#inv .trocavision').toggle();
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
    <?php
    }?>
</script>