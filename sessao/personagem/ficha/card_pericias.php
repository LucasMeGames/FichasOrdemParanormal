<div class="col-12" id="card_pericias">
    <div class="card h-100 bg-black border-light">
        <div class="card-body p-0 font10">
            <?php if ($edit) { ?>
                <div class="clearfix">
                    <div class="float-start text-center p-1">
                        <span class="text-secondary">Não treinadas</span>
                        <span class="text-success"  >Treinadas</span>
                        <span class="text-primary"  >Veterano</span>
                        <span class="text-warning"  >Especialista</span>
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm text-info fa-regular fa-eye" title="Visualisar todos"
                                id="verp"></button>
                        <button class="btn btn-sm text-warning fa-regular fa-pencil" data-bs-toggle="modal"
                                data-bs-target="#editper" title="Editar Pericias"></button>
                        <?php if (!isset($_GET["popout"])) { ?>
                            <button class="btn btn-sm text-white popout" title="PopOut">
                                <i class="fa-regular fa-rectangle-vertical-history"></i>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <h1 class="font6 text-center">Pericias</h1>
            <div class="mt-2 container-fluid" id="pericias" disabled>
                <div class="row ">
                    <?php

                    $dadode["adestramento"] = 4;
                    $dadode["atletismo"] = 1;
                    $dadode["artes"] = 4;
                    $dadode["atualidades"] = 3;
                    $dadode["ciencia"] = 3;
                    $dadode["crime"] = 2;
                    $dadode["diplomacia"] = 4;
                    $dadode["enganacao"] = 4;
                    $dadode["fortitude"] = 5;
                    $dadode["furtividade"] = 2;
                    $dadode["iniciativa"] = 2;
                    $dadode["intimidacao"] = 4;
                    $dadode["intuicao"] = 4;
                    $dadode["investigacao"] = 3;
                    $dadode["luta"] = 1;
                    $dadode["medicina"] = 3;
                    $dadode["ocultismo"] = 4;
                    $dadode["percepcao"] = 4;
                    $dadode["pilotagem"] = 2;
                    $dadode["pontaria"] = 2;
                    $dadode["profissao"] = 3;
                    $dadode["reflexos"] = 2;
                    $dadode["religiao"] = 4;
                    //$dadode["prestidigitacao"] = 2;
                    $dadode["sobrevivencia"] = 3;
                    $dadode["tatica"] = 3;
                    $dadode["tecnologia"] = 3;
                    $dadode["vontade"] = 4;

                    $dadode["acrobacias"] = 2;
                    foreach ($dadode as $r => $a) {
                        switch ($a) {
                            case 1:
                                $rd[$r] = $forca?:-2;
                                break;
                            case 2:
                                $rd[$r] = $agilidade?:-2;
                                break;
                            case 3:
                                $rd[$r] = $intelecto?:-2;
                                break;
                            case 4:
                                $rd[$r] = $presenca?:-2;
                                break;
                            case 5:
                                $rd[$r] = $vigor?:-2;
                                break;
                        }
                    }

                    function Trenado($bonus){
                        if ($bonus <= 4){
	                        return "secondary";
                        }
                        if($bonus >= 5 AND $bonus <= 9){
                            return "success";
                        }
                        if($bonus >= 10 AND $bonus <= 14){
                            return "primary";
                        }
                        if($bonus >= 15){
                            return "warning";
                        }
                    }
                    ?>



                    <div style="display: <?=$acrobacias?"unset":"none"?>;" class="<?=$acrobacias?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["acrobacias"]?>d20+<?=$acrobacias?>');" class="btn btn-lg text-light">
                            <i class="fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$acrobacias?></span>
                        </button>
                        <h3 class="text-<?=Trenado($acrobacias)?>">Acrobacias</h3>
                    </div>


















                    <div style="display: <?=$adestramento?"unset":"none"?>;" class="<?=$adestramento?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["adestramento"]?>d20+<?=$adestramento?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$adestramento?></span>
                        </button>
                        <h3 class="text-<?=Trenado($adestramento)?>">Adestramento</h3>
                    </div>
                    <div style="display: <?=$artes?"unset":"none"?>;" class="<?=$artes?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["artes"]?>d20+<?=$artes?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$artes?></span>
                        </button>
                        <h3 class="text-<?=Trenado($artes)?>">Artes</h3>
                    </div>
                    <div style="display: <?=$atletismo?"unset":"none"?>;" class="<?=$atletismo?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["atletismo"]?>d20+<?=$atletismo?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$atletismo?></span>
                        </button>
                        <h3 class="text-<?=Trenado($atletismo)?>">Atletismo</h3>
                    </div>
                    <div style="display: <?=$atualidades?"unset":"none"?>;" class="<?=$atualidades?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["atualidades"]?>d20+<?=$atualidades?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$atualidades?></span>
                        </button>
                        <h3 class="text-<?=Trenado($atualidades)?>">Atualidades</h3>
                    </div>
                    <div style="display: <?=$ciencia?"unset":"none"?>;" class="<?=$ciencia?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["ciencia"]?>d20+<?=$ciencia?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$ciencia?></span>
                        </button>
                        <h3 class="text-<?=Trenado($ciencia)?>">Ciência</h3>
                    </div>
                    <div style="display: <?=$crime?"unset":"none"?>;" class="<?=$crime?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["crime"]?>d20+<?=$crime?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$crime?></span>
                        </button>
                        <h3 class="text-<?=Trenado($crime)?>">Crime</h3>
                    </div>
                    <div style="display: <?=$diplomacia?"unset":"none"?>;" class="<?=$diplomacia?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["diplomacia"]?>d20+<?=$diplomacia?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$diplomacia?></span>
                        </button>
                        <h3 class="text-<?=Trenado($diplomacia)?>">Diplomacia</h3>
                    </div>
                    <div style="display: <?=$enganacao?"unset":"none"?>;" class="<?=$enganacao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["enganacao"]?>d20+<?=$enganacao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$enganacao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($enganacao)?>">Enganação</h3>
                    </div>
                    <div style="display: <?=$fortitude?"unset":"none"?>;" class="<?=$fortitude?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["fortitude"]?>d20+<?=$fortitude?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$fortitude?></span>
                        </button>
                        <h3 class="text-<?=Trenado($fortitude)?>">Fortitude</h3>
                    </div>
                    <div style="display: <?=$furtividade?"unset":"none"?>;" class="<?=$furtividade?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["furtividade"]?>d20+<?=$furtividade?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$furtividade?></span>
                        </button>
                        <h3 class="text-<?=Trenado($furtividade)?>">Furtividade</h3>
                    </div>
                    <div class="<?=$iniciativa?"treinado":"treinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["iniciativa"]?>d20+<?=$iniciativa?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$iniciativa?></span>
                        </button>
                        <h3 class="text-<?=Trenado($iniciativa)?>">Iniciativa</h3>
                    </div>
                    <div style="display: <?=$intimidacao?"unset":"none"?>;" class="<?=$intimidacao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["intimidacao"]?>d20+<?=$intimidacao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$intimidacao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($intimidacao)?>">Intimidação</h3>
                    </div>
                    <div style="display: <?=$intuicao?"unset":"none"?>;" class="<?=$intuicao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["intuicao"]?>d20+<?=$intuicao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$intuicao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($intuicao)?>">Intuição</h3>
                    </div>
                    <div style="display: <?=$investigacao?"unset":"none"?>;" class="<?=$investigacao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["investigacao"]?>d20+<?=$investigacao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$investigacao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($investigacao)?>">Investigação</h3>
                    </div>
                    <div style="display: <?=$luta?"unset":"none"?>;" class="<?=$luta?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["luta"]?>d20+<?=$luta?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$luta?></span>
                        </button>
                        <h3 class="text-<?=Trenado($luta)?>">Luta</h3>
                    </div>
                    <div style="display: <?=$medicina?"unset":"none"?>;" class="<?=$medicina?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["medicina"]?>d20+<?=$medicina?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$medicina?></span>
                        </button>
                        <h3 class="text-<?=Trenado($medicina)?>">Medicina</h3>
                    </div>
                    <div style="display: <?=$ocultismo?"unset":"none"?>;" class="<?=$ocultismo?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["ocultismo"]?>d20+<?=$ocultismo?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$ocultismo?></span>
                        </button>
                        <h3 class="text-<?=Trenado($ocultismo)?>">Ocultismo</h3>
                    </div>
                    <div style="display: <?=$percepcao?"unset":"none"?>;" class="<?=$percepcao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["percepcao"]?>d20+<?=$percepcao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$percepcao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($percepcao)?>">Percepção</h3>
                    </div>
                    <div style="display: <?=$pilotagem?"unset":"none"?>;" class="<?=$pilotagem?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["pilotagem"]?>d20+<?=$pilotagem?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$pilotagem?></span>
                        </button>
                        <h3 class="text-<?=Trenado($pilotagem)?>">Pilotagem</h3>
                    </div>
                    <div style="display: <?=$pontaria?"unset":"none"?>;" class="<?=$pontaria?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["pontaria"]?>d20+<?=$pontaria?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$pontaria?></span>
                        </button>
                        <h3 class="text-<?=Trenado($pontaria)?>">Pontaria</h3>
                    </div>
                    <div style="display: <?=$profissao?"unset":"none"?>;" class="<?=$profissao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["profissao"]?>d20+<?=$profissao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$profissao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($profissao)?>">Profissão</h3>
                    </div>
                    <div style="display: <?=$reflexos?"unset":"none"?>;" class="<?=$reflexos?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["reflexos"]?>d20+<?=$reflexos?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$reflexos?></span>
                        </button>
                        <h3 class="text-<?=Trenado($reflexos)?>">Reflexos</h3>
                    </div>
                    <div style="display: <?=$religiao?"unset":"none"?>;" class="<?=$religiao?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["religiao"]?>d20+<?=$religiao?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$religiao?></span>
                        </button>
                        <h3 class="text-<?=Trenado($religiao)?>">Religião</h3>
                    </div>
                    <div style="display: <?=$sobrevivencia?"unset":"none"?>;" class="<?=$sobrevivencia?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["sobrevivencia"]?>d20+<?=$sobrevivencia?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$sobrevivencia?></span>
                        </button>
                        <h3 class="text-<?=Trenado($sobrevivencia)?>">Sobrevivência</h3>
                    </div>
                    <div style="display: <?=$tatica?"unset":"none"?>;" class="<?=$tatica?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["tatica"]?>d20+<?=$tatica?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$tatica?></span>
                        </button>
                        <h3 class="text-<?=Trenado($tatica)?>">Tática</h3>
                    </div>
                    <div style="display: <?=$tecnologia?"unset":"none"?>;" class="<?=$tecnologia?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["tecnologia"]?>d20+<?=$tecnologia?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$tecnologia?></span>
                        </button>
                        <h3 class="text-<?=Trenado($tecnologia)?>">Tecnologias</h3>
                    </div>
                    <div style="display: <?=$vontade?"unset":"none"?>;" class="<?=$vontade?"treinado":"destreinado"?> col-auto text-center">
                        <button <?=$edit?"":"disabled"?> onclick="rolar('<?=$rd["vontade"]?>d20+<?=$vontade?>');" class="btn btn-lg text-light">
                            <i class=" fa-thin fa-dice-d20 fa-2x"></i><span> +<?=$vontade?></span>
                        </button>
                        <h3 class="text-<?=Trenado($vontade)?>">Vontade</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>