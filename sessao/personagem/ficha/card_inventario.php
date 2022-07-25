<div class="col-12" id="card_inventario">
        <div class="card bg-black text-white border-light">
            <div class="card-body p-0">
                <div class="card-title">
                    <div class="position-absolute end-0">
                        <div class="float-end">
                            <button class="btn btn-sm text-info fa-regular fa-eye" id="vera" title="Ver informações inventario"></button>
                            <?php if ($edit) { ?>
                                <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editinv" title="Editar Inventario">
                                    <i class="fa-regular fa-pencil"></i>
                                </button>
                                <?php if (!isset($_GET["popout"])) { ?>
                                    <button class="btn btn-sm text-white popout" title="PopOut">
                                        <i class="fa-regular fa-rectangle-vertical-history"></i>
                                    </button>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <h1 class="text-center">Inventario</h1>
                    <?php
                    $invmax = (5 * (minmax($forca,0,5) + (($rqs["classe"]==2)?(($rqs["trilha"] == 5)?$intelecto:0):0))?: 2);
                    ?>
                    <h4 class="text-center">Peso carregado: <?= $espacosusados ?>/<?= $invmax ?></h4>
                </div>
                <div class="py-2" id="inv">
                    <?php
                    if ($s[1]->num_rows > 0) {
                        ?>
                        <h3 class="mx-2">Armas</h3>
                        <table class="table table-sm table-bordered border-dark bg-black text-white table-borderless font2"
                               id="armas">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="trocavision" scope="col" style="display: none;">Tipo</th>
                                <th class="trocavision" scope="col">Ataque</th>
                                <th class="trocavision" scope="col" style="display: none;">Alcance</th>
                                <th class="trocavision" scope="col">Dano</th>
                                <th class="trocavision" scope="col">Crítico</th>
                                <th class="trocavision" scope="col" style="display: none;">Recarga</th>
                                <th class="trocavision" scope="col" style="display: none;">Especial</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($s[1] as $row): ?>
                                <tr>
                                    <td><?php echo $row['arma']; ?></td>
                                    <td class="trocavision" style="display: none;"><?php echo $row['tipo']; ?></td>
                                    <td class="trocavision">
                                        <button class="btn btn-sm fw-bolder text-info" title="Rolar Ataque"
                                            <?=$edit?'onclick=rolar("'.DadoDinamico($row['ataque'],$forca,$agilidade,$intelecto,$presenca,$vigor).'")':"disabled";?>>
                                            <i class="fa-regular fa-dice"></i><?=$row["ataque"]?>
                                        </button>
                                    </td>
                                    <td class="trocavision" style="display: none;"><?= $row['alcance']; ?></td>
                                    <td class="trocavision">
                                        <button
                                                class="btn btn-sm fw-bolder text-danger"
                                                title="Rolar Dano"
                                            <?php if ($edit) { ?>
                                                onclick="rolar('<?=DadoDinamico($row['dano'],$forca,$agilidade,$intelecto,$presenca,$vigor)?>',1)"
                                            <?php } else { ?>
                                                disabled
                                            <?php } ?>>
                                            <i class="fa-regular fa-dice"></i>
                                            <?=DadoDinamico($row['dano'],$forca,$agilidade,$intelecto,$presenca,$vigor)?>
                                        </button>
                                    </td>
                                    <td class="trocavision">
                                        <button
                                                class="btn btn-sm fw-bolder text-danger"
                                                title="Rolar Dano critico"
                                            <?php if ($edit) { ?>
                                                onclick="rolar('<?=DadoDinamico($row['critico'],$forca,$agilidade,$intelecto,$presenca,$vigor)?>',1)"
                                            <?php } else { ?>
                                                disabled
                                            <?php } ?>>
                                            <i class="fa-regular fa-dice"></i>
                                            <?= $row['margem']?$row["margem"].' / ':''?><?= DadoDinamico($row['critico'],$forca,$agilidade,$intelecto,$presenca,$vigor)?>
                                        </button>
                                    </td>
                                    <td class="trocavision" style="display: none;"><?= $row['recarga']; ?></td>
                                    <td class="trocavision" style="display: none;"><?= $row['especial']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php
                    }


                    if ($s[4]->num_rows > 0) {
                        ?>
                        <h3 class="mx-2">Itens</h3>
                        <table class="table table-bordered border-dark table-sm bg-black text-white table-borderless font2"
                               id="itens">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="trocavision" scope="col">Descrição</th>
                                <th class="trocavision" scope="col" style="display: none;">Espaços</th>
                                <th class="trocavision" scope="col" style="display: none;">Categoria</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($s[4] as $row): ?>
                                <tr>
                                    <td><?= $row['nome']; ?></td>
                                    <td class="trocavision"><?= $row['descricao']; ?></td>
                                    <td class="trocavision" style="display: none;"><?= $row['espaco']; ?></td>
                                    <td class="trocavision" style="display: none;"><?= $row['prestigio']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>