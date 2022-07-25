<script>
    const modaleditardado = new bootstrap.Modal('#editardado')
    var i = 0, timeOut = 0;

    function editdado(id,dado,nome,foto) {
        $('#edicone').val(foto);
        $('#eddado').val(dado);
        $('#ednome').val(nome);
        $('#edidd').val(id);
        modaleditardado.toggle();
    }
    function mostrarresultado(data){
        $("#valordados1,#valordados2,#valordados3").hide()
        var dados1 = data['d0'];
        var dados2 = data['d1'];
        var dados3 = data['d2'];
        if (dados1) {
            $("#valordados1").show()
            var dado1 = dados1['dado'];
            let d1r1 = dados1[dado1]["d1"] ? ' ' + dados1[dado1]["d1"] : '';
            let d1r2 = dados1[dado1]["d2"] ? ', ' + dados1[dado1]["d2"] : '';
            let d1r3 = dados1[dado1]["d3"] ? ', ' + dados1[dado1]["d3"] : '';
            let d1r4 = dados1[dado1]["d4"] ? ', ' + dados1[dado1]["d4"] : '';
            let d1r5 = dados1[dado1]["d5"] ? ', ' + dados1[dado1]["d5"] : '';
            let d1r6 = dados1[dado1]["d6"] ? ', ' + dados1[dado1]["d6"] : '';
            let d1r7 = dados1[dado1]["d7"] ? ', ' + dados1[dado1]["d7"] : '';
            let d1r8 = dados1[dado1]["d8"] ? ', ' + dados1[dado1]["d8"] : '';
            let d1r9 = dados1[dado1]["d9"] ? ', ' + dados1[dado1]["d9"] : '';
            let d1r0 = dados1[dado1]["d10"] ? ', ' + dados1[dado1]["d10"] : '';
            $("#dado1").html(dado1);
            $("#valores1").html(d1r1 + d1r2 + d1r3 + d1r4 + d1r5 + d1r6 + d1r7 + d1r8 + d1r9 + d1r0);
        }
        if (dados2) {
            $("#valordados2").show()
            const dado2 = dados2['dado'];
            let d2r1 = dados2[dado2]["d1"] ? ' ' + dados2[dado2]["d1"] : '';
            let d2r2 = dados2[dado2]["d2"] ? ', ' + dados2[dado2]["d2"] : '';
            let d2r3 = dados2[dado2]["d3"] ? ', ' + dados2[dado2]["d3"] : '';
            let d2r4 = dados2[dado2]["d4"] ? ', ' + dados2[dado2]["d4"] : '';
            let d2r5 = dados2[dado2]["d5"] ? ', ' + dados2[dado2]["d5"] : '';
            let d2r6 = dados2[dado2]["d6"] ? ', ' + dados2[dado2]["d6"] : '';
            let d2r7 = dados2[dado2]["d7"] ? ', ' + dados2[dado2]["d7"] : '';
            let d2r8 = dados2[dado2]["d8"] ? ', ' + dados2[dado2]["d8"] : '';
            let d2r9 = dados2[dado2]["d9"] ? ', ' + dados2[dado2]["d9"] : '';
            let d2r0 = dados2[dado2]["d10"] ? ', ' + dados2[dado2]["d10"] : '';
            $("#dado2").html(dado2);
            $("#valores2").html(d2r1 + d2r2 + d2r3 + d2r4 + d2r5 + d2r6 + d2r7 + d2r8 + d2r9 + d2r0);
        }
        if (dados3) {
            $("#valordados3").show()
            var dado3 = dados3['dado'];
            let d3r1 = dados3[dado3]["d1"] ? ' ' + dados3[dado3]["d1"] : '';
            let d3r2 = dados3[dado3]["d2"] ? ', ' + dados3[dado3]["d2"] : '';
            let d3r3 = dados3[dado3]["d3"] ? ', ' + dados3[dado3]["d3"] : '';
            let d3r4 = dados3[dado3]["d4"] ? ', ' + dados3[dado3]["d4"] : '';
            let d3r5 = dados3[dado3]["d5"] ? ', ' + dados3[dado3]["d5"] : '';
            let d3r6 = dados3[dado3]["d6"] ? ', ' + dados3[dado3]["d6"] : '';
            let d3r7 = dados3[dado3]["d7"] ? ', ' + dados3[dado3]["d7"] : '';
            let d3r8 = dados3[dado3]["d8"] ? ', ' + dados3[dado3]["d8"] : '';
            let d3r9 = dados3[dado3]["d9"] ? ', ' + dados3[dado3]["d9"] : '';
            let d3r0 = dados3[dado3]["d10"] ? ', ' + dados3[dado3]["d10"] : '';
            $("#dado3").html(dado1);
            $("#valores3").html(d3r1 + d3r2 + d3r3 + d3r4 + d3r5 + d3r6 + d3r7 + d3r8 + d3r9 + d3r0);
        }

        $("#resultado").html(data.print+"="+data.result);
        new bootstrap.Toast($('#Toastdados')).show();
        $("main button").attr("disabled", false)
    }
    function rolar(dado, dano = 0) {
        $("main button").attr("disabled", true)
        $.post({
            url: '/sessao/personagem/rolar.php',
            data: {status: 'roll', dado: dado, dano: dano},
            dataType: 'JSON'
        }).done(function (data) {
            mostrarresultado(data);
                if(socket) {
                    dado = {}
                    dado.dado = data;
                    socket.emit('<?=$fichat?>', dado);
                }
            return true;
        }).fail(function () {
            new bootstrap.Toast($('#Toastdados')).show();
            $('#resultado,#dado1,#dado2,#dado3,#valores1,#valores2,#valores3').html('');
            $('#valordados1,#valordados2,#valordados3').hide();
            $('#resultado').html('FALHA AO RODAR DADO, VERIFICAR SE ESTÀ CORRETO!');
            $('main button').attr('disabled', false);
            return false;
        })
    }// Mostrar resultado dados

    $(document).ready(function () {

        $("#ded").click(function(){
            $("#eds").val("deld");
            $("#formeditdado").submit();
        })
        $("#sed").click(function(){
            $("#eds").val("editd");
            $("#formeditdado").submit();
        })
        $('#dados .dado').on('mousedown touchstart', function(e) {
            $(this).addClass('active');
            let id = $(this).attr("aria-id");
            let dado = $(this).attr("aria-dado");
            let nome = $(this).attr("aria-nome");
            let foto = $(this).attr("aria-foto");
            timeOut = setInterval(function() {
                clearInterval(timeOut);
                editdado(id,dado,nome,foto);
            }, 500);
        }).bind('mouseup mouseleave touchend', function() {
            $(this).removeClass('active');
            clearInterval(timeOut);
        });
        $('#rolardadosbutton').on('click', function (){
            console.log("data");
            let dado = $("#rolardadosinput").val();
            $('#returncusdados').html("");
            let pattern = /^[d0-9+-]+\S$/g;
            let result = dado.match(pattern);
            if(result) {
                $.post({
                    url: '',
                    data: {status: 'roll', dado: dado},
                    dataType: 'JSON'
                }).done(function (data) {
                    if (data.success) {
                        mostrarresultado(data);
                    } else {
                        $('#returncusdados').html("<div class='alert alert-danger'>" + data.msg + "</div>");
                    }
                }).fail(function () {
                    $('#returncusdados').html("<div class='alert alert-danger'>Houve um erro, contate um administrador.</div>");
                })
            } else {
                $('#returncusdados').html("<div class='alert alert-danger'>Este dado não é válido.</div>");
            }
        })
    })
</script>