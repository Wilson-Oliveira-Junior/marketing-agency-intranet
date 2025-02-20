<!-- Modal -->
<div class="modal fade" id="mdlResponsaveisInternos" tabindex="-1" role="dialog" aria-labelledby="mdlResponsaveisInternosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form method="post" id="frmAdicionaResponsavel" role="form">
                <input type="hidden" name="idcliente" value="{{$clientes->id}}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlResponsaveisInternosLabel">Adicionar Responsável</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <!-- Responsavel Interno -->
                        <div class="form-group col-sm-12">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="responsavel_interno" id="responsavel_interno">
                                    <option value="--">- Selecione -</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->sobrenome}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <span class="hidden errorResponsavel"></span>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>
