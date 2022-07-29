<div class="col h-auto" id="card_dadosjogados" >
	<div class="card bg-black border-light h-100 p-1">
		<div class="overflow-auto position-relative h-100">
            <div class="card-header text-center border-0 p-2">
                <label class="card-title font6 fs-2 " for="rolardadosinput">Ultimos resultados de testes.</label>
            </div>
            <div class="position-absolute w-100 d-flex flex-column p-2" id="dados_recentes">
                <div class="row align-self-start">
                    <div class="col-auto text-center">
                        <img alt="Foto perfil" src="HTTPS://fichasop.com/assets/img/Mauro%20-%20up%20.png" id="fotopersonagem" height="50" class="rounded-circle border border-1 border-white">
                    </div>
                    <div class="col">
                        <span>15+9 = 21</span><br>
                        <span class="text-secondary">d20: 15, 6 | d8: 5, 9 </span>
                    </div>
                </div>
                <hr>
                <?php
                $r = mysqli_fetch_array($con->query("Select * FROM `missoes` WHERE id = '" . $id . "';"));
                var_dump($r);
                ?>
            </div>
        </div>
	</div>
</div>
