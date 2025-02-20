<div class="modal fade" id="mdlObservacao" tabindex="-1" role="dialog" aria-labelledby="mdlObservacao" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 style="font-size: 15px;margin-bottom: -20px;">Detalhes sobre a pauta</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <form method="post" id="formObservacao" name="formObservacao" class="form-adiamento">
                @csrf
                <input type="hidden" name="idpauta" id="idpauta" value="">

                <div class="modal-body" style="padding-top: 0px;">
                    <label>Observação:</label>
                    <textarea class="form-control" placeholder="Detalhe o andamento da pauta e marque para registrar no painel do projeto se for o caso." name="observacao" id="observacao" style="height: 200px;" required></textarea>
                    <p class="errorObservacao text-center alert alert-danger hidden"></p>
                    <label for="ck_adiar_proximos">Anotar no painel do projeto?</label>
                    <input type="checkbox" name="ck_registrar_projeto" id="ck_registrar_projeto" value="S"> <span>Sim</span>
                </div>

                <div class="modal-footer" style="margin-left: 25px;margin-top: -10px;float: left;margin-bottom: 20px;">
                    <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
                <div id="loader" style="display:none !important">
                    <img src="{{asset('img/load-oficial.gif')}}">
                </div>
            </form>

        </div>
    </div>
</div>
