<div class="modal fade" id="mdlComentario" tabindex="-1" role="dialog" aria-labelledby="mdlComentario" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 style="font-size: 15px;margin-bottom: -20px;">Comentar projeto</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <form method="post" id="formComentario" name="formComentario" class="form-adiamento">
                @csrf
                <input type="hidden" name="idprojeto" id="idprojeto" value="">

                <div class="modal-body" style="padding-top: 0px;">
                    <label>Último comentário</label>
                    <p style="background-color: #fff;color: #8898aa;border: 1px solid #cad1d7;border-radius: .375rem;padding: .625rem .75rem;" id="ultimoComentario"></p>

                    <label>Observação:</label>
                    <textarea class="form-control" placeholder="Detalhe sobre o andamento do projeto." name="comentario" id="comentario" style="height: 200px;" required></textarea>
                    <p class="errorObservacao text-center alert alert-danger hidden"></p>

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
