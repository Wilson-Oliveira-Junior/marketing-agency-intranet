<div class="modal fade" id="modal-default{{ $registro->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-default{{ $registro->id }}" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 style="font-size: 15px;margin-bottom: -20px;">Adiamento do Gatilho "{{ $registro->gatilho }}"</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('backend.gatilhos.projeto.adiamento') }}" method="post" enctype="multipart/form-data" class="form-adiamento">
                {{ csrf_field() }}

                <input name="id_gatilho" type="text" value="{{ $registro->id }}" style="display:none">
                <input name="id_projeto" type="text" value="{{ $id_projeto_oficial }}" style="display:none">
                <input name="id_usuario" type="text" value="{{ Auth::user()->id }}" style="display:none">

                <div class="modal-body" style="padding-top: 0px;">
                    <label>Nova data:</label>
                    <input class="form-control" name="data_adiamento" type="date">
                    <label>Motivo do Adiamento:</label>
                    <textarea class="form-control" placeholder="Motivo do Adiamento" name="motivo" style="height: 200px;" required></textarea>
                    <label for="ck_adiar_proximos">Adiar Próximos?</label>
                    <input type="checkbox" name="ck_adiar_proximos" id="ck_adiar_proximos" value="S"> <span>Sim</span>
                </div>

                <div class="modal-footer" style="margin-left: 25px;margin-top: -10px;float: left;margin-bottom: 20px;">
                    <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
            </form>

        </div>
    </div>
</div>
