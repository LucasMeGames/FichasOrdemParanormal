<div class="col-12" id="card_dados">
    <div class="card h-100 bg-black border-light">
        <div class="card-body p-0">
            <?php if ($edit) { ?>
                <div class="clearfix">
                    <div class="float-end">
                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editdetalhes"
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
            <div class="card-title">
                <h1 class="font6 text-center">Detalhes Pessoais</h1>
            </div>
            <div>
                <div class="p-1 mx-3 my-1">
                    <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Nome:</div>
                    <div class="p-2 my-3 border border-light"><?= $nome ?></div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="p-1 ms-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Jogador:</div>
                            <div class="p-2 my-3 border border-light"><?= $usuario ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-1 me-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Origem:</div>
                            <div class="p-2 my-3 border border-light"><?=$origem?:'Desconhecida.';?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="p-1 ms-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Classe:</div>
                            <div class="p-2 my-3 border border-light"><?= $classe?:'Desconhecido.' ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-1 me-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Trilha:</div>
                            <div class="p-2 my-3 border border-light"><?=$trilha?:'Desconhecida.';?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="p-1 ms-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Patente:</div>
                            <div class="p-2 my-3 border border-light"><?= $patente?:'Desconhecido.' ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-1 me-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">P.P.:</div>
                            <div class="p-2 my-3 border border-light"><?=$pp?:0;?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="p-1 ms-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Idade:</div>
                            <div class="p-2 my-3 border border-light"><?= $idade?:'Desconhecido'?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-1 me-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">NEX:</div>
                            <div class="p-2 my-3 border border-light"><?=$nex?:0;?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="p-1 my-1 mx-3">
                            <div class="bg-black position-absolute mx-3 pt-1 px-1 text-center">Nacionalidade:</div>
                            <div class="p-2 my-3 border border-light"><span><?=$local?:"Desconhecido.";?></span></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-1 me-3 my-1">
                            <div class="bg-black position-absolute mx-2 pt-1 px-1 text-center">Deslocamento:</div>
                            <div class="p-2 my-3 border border-light"><?=$deslocamento?:0;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>