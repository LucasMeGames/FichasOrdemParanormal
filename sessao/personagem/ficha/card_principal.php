<div class="col-12">
    <div class="card h-100 bg-black border-light" id="card_principal">
        <div class="card-body p-0">
            <?php if ($edit) { ?>
                <div class="clearfix">
                    <div class="float-end">
                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editprincipal"
                                title="Editar">
                            <i class="fa-regular fa-pencil"></i>
                        </button>
                        <?php if (!isset($_GET["popout"])) { ?>
                            <button class="btn btn-sm text-white popout" title="PopOut">
                                <i class="fa-regular fa-rectangle-vertical-history"></i>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row m-0">
                <div class="col text-center">
                    <img data-bs-toggle="modal" data-bs-target="#trocarficha" alt="Foto perfil" src="<?php
                    if($pva <= 0){
                        echo $urlphotomor;
                    } else {
                        if($sana <= 0){
                            echo$urlphotoenl;
                        } else {
                            if (TirarPorcento($pva,$pva) < 50){
                                echo $urlphotofer;
                            } else {
                                echo $urlphoto;
                            }
                        }
                    }
                    ?>" id="fotopersonagem" width="150" height="150" class="<?php if (intval($rqs["foto"]) > 0 && intval($rqs["foto"]) < 3) echo "bg-secondary"; ?> rounded-circle mx-3 border border-1 border-white"/>
                </div>
                <div class="col d-flex align-self-center flex-column" id="butmor">
                    <div class="m-2">
                        <input type="checkbox" class="btn-check" id="morrendo" <?php if ($morrendo) echo "checked ";
                        if (!$edit) {
                            echo "disabled";
                        } ?> autocomplete="off">
                        <label class="d-grid btn btn-outline-danger fw-bolder" for="morrendo">Morto</label>
                    </div>
                </div>
            </div>
            <div class="m-2">
                <div id="saude">
                    <h4 class="font6 pt-4 fs-4 fw-bold text-center">Vida</h4>
                        <div class="d-flex justify-content-between">
	                        <?php if ($edit) { ?>
                                <div class="col-auto">
                                    <button class="btn btn-sm text-white" onclick="updtsaude(-5,'pv');">
                                        <i class="fa-solid fa-chevrons-left"></i> -5
                                    </button>
                                    <button class="btn btn-sm text-white" onclick="updtsaude(-1,'pv');">
                                        <i class="fa-solid fa-chevron-left"></i> -1
                                    </button>
                                </div>
	                        <?php } ?>
                            <div class="fs-4 justify-content-center align-items-center font4 row g-0 dblclick">
                                <div class="col-md-3 col-5 me-0">
                                    <input type="number" title="Vida Atual" name="pva" value="<?=$pva?>" class="pva border-0 vidaatual form-control form-control-sm bg-black text-light text-end" readonly>
                                </div>
                                <div class="col-auto">/</div>
                                <div class="col-md-3 col-5 ms-0">
                                    <input type="number" title="Vida Máxima" name="pv" value="<?=$pv?>" class=" pv border-0 vidamaxima form-control form-control-sm bg-black text-light" readonly>
                                </div>
                            </div>
                            <?php if ($edit) { ?>
                                <div class="col-auto">
                                    <button class="btn btn-sm text-white" onclick="updtsaude(1,'pv');">
                                        +1 <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                    <button class="btn btn-sm text-white" onclick="updtsaude(5,'pv');">
                                        +5 <i class="fa-solid fa-chevrons-right"></i>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div id="pv" class="float-none">
                            <div class="progress h-auto bg-dark fw-bolder">
                                <div class="progress-bar bg-danger text-end" id="barrapva" role="progressbar" title="Vida" style="width:<?= $ppv; ?>%;height: 30px" aria-valuenow="<?= $pva ?>" aria-valuemin="0" aria-valuemax="<?= $pv ?>"></div>
                            </div>
                        </div>


                        <h4 class="font6 pt-4 fs-4 fw-bold text-center">Sanidade</h4>
                    <?php if ($edit) { ?>
                        <div class="d-flex justify-content-between">
                            <div class="col-auto">
                                <button class="btn btn-sm text-white" onclick="updtsaude(-5,'san');">
                                    <i class="fa-solid fa-chevrons-left"></i> -5
                                </button>
                                <button class="btn btn-sm text-white" onclick="updtsaude(-1,'san');">
                                    <i class="fa-solid fa-chevron-left"></i> -1
                                </button>
                            </div>
                            <div class="fs-4 justify-content-center align-items-center font4 row g-0 dblclick">
                                <div class="col-md-3 col-5 me-0">
                                    <input type="number" title="Vida Atual" name="sana" value="<?=$sana?>" class="sana border-0 sanatual form-control form-control-sm bg-black text-light text-end" readonly>
                                </div>
                                <div class="col-auto">/</div>
                                <div class="col-md-3 col-5 ms-0">
                                    <input type="number" title="Vida Máxima" name="san" value="<?=$san?>" class="san border-0 sanmaxima form-control form-control-sm bg-black text-light" readonly>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm text-white" onclick="updtsaude(1,'san');">
                                    +1 <i class="fa-solid fa-chevron-right"></i>
                                </button>
                                <button class="btn btn-sm text-white" onclick="updtsaude(5,'san');">
                                    +5 <i class="fa-solid fa-chevrons-right"></i>
                                </button>
                            </div>
                        </div>
                    <?php }?>
                        <div id="san" class="float-none">
                            <div class="progress h-auto bg-dark fw-bolder">
                                <div class="progress-bar bg-primary text-end" id="barrasana" role="progressbar" title="Vida" style="width:<?= $psan; ?>%;height: 30px" aria-valuenow="<?= $sana ?>" aria-valuemin="0" aria-valuemax="<?= $san ?>"></div>
                            </div>
                        </div>


                        <h4 class="font6 pt-4 fw-bold text-center">Esforço</h4>
                    <?php if ($edit) { ?>
                        <div class="d-flex justify-content-between">
                            <div class="col-auto">
                                <button class="btn btn-sm text-white" onclick="updtsaude(-5,'pe');">
                                    <i class="fa-solid fa-chevrons-left"></i> -5
                                </button>
                                <button class="btn btn-sm text-white" onclick="updtsaude(-1,'pe');">
                                    <i class="fa-solid fa-chevron-left"></i> -1
                                </button>
                            </div>
                            <div class="fs-4 justify-content-center align-items-center font4 row g-0 dblclick">
                                <div class="col-md-3 col-5 me-0">
                                    <input type="number" title="Vida Atual" name="pea" value="<?=$pea?>" class="pea border-0 peatual form-control form-control-sm bg-black text-light text-end" readonly>
                                </div>
                                <div class="col-auto">/</div>
                                <div class="col-md-3 col-5 ms-0">
                                    <input type="number" title="Vida Máxima" name="pe" value="<?=$pe?>" class="pe border-0 pemaxima form-control form-control-sm bg-black text-light" readonly>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm text-white" onclick="updtsaude(1,'pe');">
                                    +1 <i class="fa-solid fa-chevron-right"></i>
                                </button>
                                <button class="btn btn-sm text-white" onclick="updtsaude(5,'pe');">
                                    +5 <i class="fa-solid fa-chevrons-right"></i>
                                </button>
                            </div>
                        </div>
                    <?php }?>
                        <div id="pe" class="float-none">
                            <div class="progress h-auto bg-dark fw-bolder">
                                <div class="progress-bar bg-warning text-end" id="barrapea" role="progressbar" title="Esforço" style="width:<?= $ppe; ?>%;height: 30px" aria-valuenow="<?= $pea ?>" aria-valuemin="0" aria-valuemax="<?= $pe ?>"></div>
                            </div>
                        </div>
                </div>

                <?php
                if ($passiva > 0 or $esquiva > 0) {
                    ?>
                    <h4 class="font6 pt-4 text-center">Defesas</h4>
                    <div class="row justify-content-center">
                        <?php if ($passiva > 0) { ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Passiva: <?= $passiva; ?></span>
                            </div>
                        <?php }
                        if ($esquiva > 0) {
                            ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Esquiva: <?= $esquiva; ?></span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                if ($balistica > 0 or $fisica > 0 or $conhecimento > 0 or $morte > 0 or $sangue > 0 or $energia > 0 or $insanidade > 0) {
                    ?>
                    <h4 class="font6 pt-4 text-center">Resistencias</h4>
                    <div class="row justify-content-center g-2">
                        <?php
                        if ($fisica > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Físico: <?= $fisica; ?></span>
                            </div>
	                        <?php
                        }
                        if ($balistica > 0) {
                            ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Balistica: <?= $balistica; ?></span>
                            </div>
                            <?php
                        }
                        if ($insanidade) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Mental: <?= $insanidade; ?></span>
                            </div>
	                        <?php
                        }
                        if ($morte) {
                            ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Morte: <?= $morte; ?></span>
                            </div>
                            <?php
                        }
                        if ($conhecimento) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Conhecimento: <?= $conhecimento; ?></span>
                            </div>
	                        <?php
                        }
                        if ($sangue) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Sangue: <?= $sangue; ?></span>
                            </div>
	                        <?php
                        }
                        if ($energia) {
                            ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Energia: <?= $energia; ?></span>
                            </div>
                            <?php
                        }
                        if ($corte > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Corte: <?= $corte; ?></span>
                            </div>
	                        <?php
                        }
                        if ($perfuracao > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Perfuração: <?=$perfuracao?></span>
                            </div>
	                        <?php
                        }
                        if ($eletricidade > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Eletricidade: <?=$eletricidade?></span>
                            </div>
	                        <?php
                        }
                        if ($fogo > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Fogo: <?= $fogo; ?></span>
                            </div>
	                        <?php
                        }
                        if ($frio > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Frio: <?= $frio?></span>
                            </div>
	                        <?php
                        }
                        if ($quimica > 0) {
	                        ?>
                            <div class="col-auto">
                                <span class="input-group-text bg-black text-light fw-bolder">Quimica: <?=$quimica?></span>
                            </div>
	                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                /*
                ?>
                <h4 class="font6 pt-4">Esforço</h4>
                <span id="peatual" class="fs-4"><?= $pe - ($pe - $pea) ?></span><span>/<?= $pe ?> Livres</span>
                <div id="pe" style="Zoom: 150%;">
                    <?php
                    if ($edit) {
                        $unchecked = max($pe - $pea, 0);
                        $a = 0;
                        while ($a != $unchecked) {
                            $a += 1;
                            echo '<input type="checkbox" class="form-check-input m-1" checked aria-label="" autocomplete="off">';
                        }
                        while ($a != $pe) {
                            $a += 1;
                            echo '<input type="checkbox" class="form-check-input m-1" aria-label="" autocomplete="off">';
                        }
                    } else {
                        $unchecked = max($pe - $pea, 0);
                        $a = 0;
                        while ($a != $unchecked) {
                            $a += 1;
                            echo '<input type="checkbox" class="form-check-input m-1" checked disabled aria-label="" autocomplete="off">';
                        }
                        while ($a != $pe) {
                            $a += 1;
                            echo '<input type="checkbox" class="form-check-input m-1" disabled aria-label="" autocomplete="off">';
                        }
                    } ?>
                </div>
                */?>
            </div>
        </div>
    </div>
</div>