<!-- Modal PERICIAS-->
<div class="modal fade" id="editper" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-black border-light">
            <form class="modal-body font1" id="formaddper">
                <div class="card-header text-center">
                    <h2>Editar Pericias</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Acrobacias">Acrobacias</label>
                        <input id="Acrobacias" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$acrobacias?>" name="acrobacias"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Adestramento">Adestramento</label>
                        <input id="Adestramento" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$adestramento?>" name="adestramento"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Artes">Artes</label>
                        <input id="Artes" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$artes?>" name="artes"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Atletismo">Atletismo</label>
                        <input id="Atletismo" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $atletismo; ?>" name="atletismo"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Atualidades">Atualidades</label>
                        <input id="Atualidades" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $atualidades; ?>" name="atualidades"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Ci??ncia">Ci??ncia</label>
                        <input id="Ci??ncia" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $ciencia; ?>" name="ciencia"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="crime">Crime</label>
                        <input id="crime" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$crime?>" name="crime"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Diplomacia">Diplomacia</label>
                        <input id="Diplomacia" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $diplomacia; ?>" name="diplomacia"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Engana????o">Engana????o</label>
                        <input id="Engana????o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $enganacao; ?>" name="enganacao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Fortitude">Fortitude</label>
                        <input id="Fortitude" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $fortitude; ?>" name="fortitude"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Furtividade">Furtividade</label>
                        <input id="Furtividade" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $furtividade; ?>" name="furtividade"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Iniciativa">Iniciativa</label>
                        <input id="Iniciativa" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$iniciativa?>" name="iniciativa"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Intimida????o">Intimida????o</label>
                        <input id="Intimida????o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $intimidacao; ?>" name="intimidacao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Intui????o">Intui????o</label>
                        <input id="Intui????o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $intuicao; ?>" name="intuicao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Investiga????o">Investiga????o</label>
                        <input id="Investiga????o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $investigacao; ?>" name="investigacao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Luta">Luta</label>
                        <input id="Luta" class="form-control m-1 bg-black text-light border-light" type="number" min="0"
                               max="99" value="<?= $luta; ?>" name="luta"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Medicina">Medicina</label>
                        <input id="Medicina" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $medicina; ?>" name="medicina"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Ocultismo">Ocultismo</label>
                        <input id="Ocultismo" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $ocultismo; ?>" name="ocultismo"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Percep????o">Percep????o</label>
                        <input id="Percep????o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $percepcao; ?>" name="percepcao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Pilotagem">Pilotagem</label>
                        <input id="Pilotagem" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $pilotagem; ?>" name="pilotagem"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Pontaria">Pontaria</label>
                        <input id="Pontaria" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $pontaria; ?>" name="pontaria"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Profiss??o">Profiss??o</label>
                        <input id="Profiss??o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $profissao; ?>" name="profissao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Reflexo">Reflexos</label>
                        <input id="Reflexo" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $reflexos; ?>" name="reflexo"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Religi??o">Religi??o</label>
                        <input id="Religi??o" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $religiao; ?>" name="religiao"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Sobrevivencia">Sobreviv??ncia</label>
                        <input id="Sobrevivencia" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?=$sobrevivencia?>" name="sobrevivencia"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="T??tica">T??tica</label>
                        <input id="T??tica" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $tatica; ?>" name="tatica"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Tecnologia">Tecnologia</label>
                        <input id="Tecnologia" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $tecnologia; ?>" name="tecnologia"/>
                    </div>
                    <div class="col">
                        <label class="fs-4 fw-bold" for="Vontade">Vontade</label>
                        <input id="Vontade" class="form-control m-1 bg-black text-light border-light" type="number"
                               min="0" max="99" value="<?= $vontade; ?>" name="vontade"/>
                    </div>
                </div>
                <input type="hidden" name="status" value="editper"/>
                <div class="clearfix">
                    <button type="button" class="btn btn-danger float-start" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success float-end">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
