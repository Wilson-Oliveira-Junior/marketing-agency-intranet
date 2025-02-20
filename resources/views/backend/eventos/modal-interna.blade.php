<!-- Modal -->
<div class="modal fade" id="visualizarEventoModal" tabindex="-1" role="dialog" aria-labelledby="visualizarEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.evento.atualizar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    
                    <!--<h5 id="visualizarEventoModalLabel" style="font-size: 25px;">
                        <i class="ni ni-calendar-grid-58 text-red"></i> 
                        Detalhes do Evento
                    </h5>-->

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div id="visualizarDetalhesEvento" class="row"></div>
                </div>

            </form>
        </div>
    </div>
</div>