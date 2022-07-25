<div class="col-12" id="card_rituais">
    <div class="card h-100 bg-black border-light">
        <div class="card-body p-0 font1">
            <div class="clearfix">
                <?php if ($edit) { ?>
                    <div class="float-end">
                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editritual"
                                title="Editar Rituais">
                            <i class="fa-regular fa-pencil"></i>
                        </button>
                        <button class="btn btn-sm text-success" data-bs-toggle="modal" data-bs-target="#addritual"
                                title="Adicionar Ritual">
                            <i class="fa-regular fa-square-plus"></i>
                        </button>
                        <?php if (!isset($_GET["popout"])) { ?>
                            <button class="btn btn-sm text-white popout" title="PopOut">
                                <i class="fa-regular fa-rectangle-vertical-history"></i>
                            </button>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <h1 class="font6 text-center">Rituais</h1>
            <div class="row g-3 m-2 font4">
                <?php
                foreach ($s[6] as $r):?>
                    <div class="col text-center col-md-6">
                        <div class="container-fluid font2 text-start">
                            <div class="row g-1 justify-content-center">
                                <div class="col-auto text-start p-0">
                                    <img class="border border-light" src="<?=($r["foto"]==='1')?"/assets/img/desconhecido.png":$r["foto"]?>" width="200" height="200" alt="Ritual">
                                </div>
                                <div class="col-12 col-xl p-0 fs-6">
                                    <div class="row m-2 g-1">
                                        <div class="col-12">
                                            <div class="row m-0 border border-light rounded rounded-1">
                                                <span class="col border-0 form-control form-control-sm bg-black text-light">Nome: <?= $r["nome"] ?></span>
                                                <button class="col-auto border-0 float-end btn btn-sm btn-outline-light text-danger rounded-0" onclick="deletar(<?= $r["id"] ?>,'<?=$r["nome"]?>','deleteritual');">
                                                    <i class="fa-regular fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-2 g-1">
                                        <div class="col col-lg-auto">
                                            <span class="form-control form-control-sm bg-black text-light">Circulo: <?=$r["circulo"]?></span>
                                        </div>
                                        <div class="col">
                                            <span class="form-control form-control-sm bg-black text-light">Elemento: <?=$r["elemento"]?></span>
                                        </div>
                                    </div>
                                    <div class="row m-2 g-1">
                                        <div class="col col-lg-auto">
                                            <span class="bg-black form-control form-control-sm bg-black text-light">Execução: <?=$r["conjuracao"]?></span>
                                        </div>
                                        <div class="col">
                                            <span class="bg-black form-control form-control-sm bg-black text-light">Alcance: <?=$r["alcance"]?></span>
                                        </div>
                                    </div>
                                    <div class="row m-2 g-1">
                                        <div class="col col-lg-auto">
                                            <span class="bg-black form-control form-control-sm bg-black text-light">Alvo: <?=$r["alvo"]?></span>
                                        </div>
                                        <div class="col">
                                            <span class="bg-black form-control form-control-sm bg-black text-light">Duração: <?=$r["duracao"]?></span>
                                        </div>
                                    </div>
                                    <div class="row m-2 g-1">
                                        <div class="col-6 d-grid">
                                          <?php if(isset($r["dano"])){?>  <button class="btn btn-sm btn-outline-light" onclick="rolar('<?=$r["dano"]?>',1)"><?=$r["dano"]?></button>
                                            <?php }?>
                                        </div>
                                        <div class="col-6 d-grid">
                                            <?php if(isset($r["dano2"])){?>
                                            <button class="btn btn-sm btn-outline-light" onclick="rolar('<?=$r["dano2"]?>',2)"><?=$r["dano2"]?></button>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <textarea aria-label="Descrição" class="col-12 form-control form-control-sm bg-black text-white fs-5" rows="6" disabled>Descrição: <?= $r["efeito"] ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>