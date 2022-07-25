<div class="col-12" id="card_habilidades">
    <div class="card h-100 bg-black border-light">
        <div class="card-body p-0 font1">
            <div class="clearfix">
                <?php if ($edit) { ?>
                    <div class="float-end">
                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#edithab" title="Editar Habilidades">
                            <i class="fa-regular fa-pencil"></i>
                        </button>
                        <button class="btn btn-sm text-success" data-bs-toggle="modal" data-bs-target="#addhab"
                                title="Adicionar Habilidade">
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



            <nav>
                <div class="d-flex justify-content-center m-2" role="tablist">
                    <button class="btn btn-outline text-light active mx-2" id="aba-habilidades" data-bs-toggle="tab" data-bs-target="#habilidades" type="button" role="tab" aria-controls="habilidades" aria-selected="true">Habilidades</button>
                    <button class="btn btn-outline text-light mx-2" id="aba-poderes" data-bs-toggle="tab" data-bs-target="#poderes" type="button" role="tab" aria-controls="poderes" aria-selected="false">Poderes</button>
                </div>
            </nav>
            <div class="tab-content m-2">
                <div class="tab-pane fade show active" id="habilidades" role="tabpanel" aria-labelledby="aba-habilidades" tabindex="0">
                    <h1 class="font6 text-center">Habilidades</h1>
                    <?php
                    foreach ($s[2] as $r):
                        ?>
                        <div class="m-3 clearfix">
                            <label for="h<?= $r["id"]; ?>" class="fs-4"><?= $r["nome"]; ?></label>
                            <?php
                            if ($edit) {
                                ?>
                                <button class="btn btn-sm fa fa-trash text-danger float-end"
                                        aria-label="Apagar Habilidade '<?= $r["nome"]; ?>'"
                                        onclick="deletar(<?=$r["id"]?>,'<?= $r["nome"]; ?>','delethab')"></button>
                            <?php }
                            ?>
                            <div class="font7">
                                <span>
                                    <?= $r["descricao"]; ?>
                                </span>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="tab-pane fade" id="poderes" role="tabpanel" aria-labelledby="aba-poderes" tabindex="0">
                    <h1 class="font6 text-center">Poderes</h1>
                    <?php
                    foreach ($s[7] as $r):
                        ?>
                        <div class="m-3 clearfix">
                            <label for="p<?= $r["id"]; ?>" class="fs-4"><?= $r["nome"]; ?></label>
                            <?php
                            if ($edit) {
                                ?>
                                <button class="btn btn-sm fa fa-trash text-danger float-end" aria-label="Apagar poder '<?= $r["nome"]; ?>'" onclick="deletar(<?= $r["id"]; ?>,'<?= $r["nome"]?>','deletpod')"></button>
                            <?php }
                            ?>

                            <div class="font7">
                                <span><?= $r["descricao"]; ?></span>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>