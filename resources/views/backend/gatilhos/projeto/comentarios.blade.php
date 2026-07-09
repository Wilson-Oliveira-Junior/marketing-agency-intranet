<div class="card">
        
    <div class="card-header">
        <h5 class="h3 mb-0">
            <i class="ni ni-chat-round"></i>
            Comentários sobre o Projeto ({{ $numeros_comentario }})
        </h5>
        <button class="collapse-table-comentario-projeto">
            <i class="ni ni-fat-add"></i>
        </button>
    </div>

    <div class="card-body collapse-hidden-comentario-projeto">

        @forelse($comentarios as $comentario)
            
            @if($comentario->tipo_comentario == 'S')
                <div class="mb-1">
                    <div class="media media-comment" style="margin-top: 10px;">
                        
                        <div class="media-body">
                            <div class="media-comentario-sistema">

                                <h6 class="h5 mt-0">
                                    Comentário Sistema 
                                    <span>
                                        <i class="ni ni-calendar-grid-58"></i> {{ date( 'd/m/Y' , strtotime($comentario->data_postagem)) }}
                                    </span>
                                </h6>
                                
                                <p class="text-sm lh-160" style="font-size: 13px !important;font-weight: 100;margin-bottom: 5px;">
                                    {{ $comentario->comentario }}
                                </p>

                            </div>
                        </div>
                        
                    </div>
                </div>
            @else
                <div class="mb-1">
                    <div class="media media-comment">
                        <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="{{ $comentario->image ? config('app.url').'/'.ltrim($comentario->image, '/') : asset('img/user.svg') }}">
                        
                        <div class="media-body">
                            <div class="media-comment-text">

                                <h6 class="h5 mt-0" style="color:#444;font-size: 17px;">
                                    {{ $comentario->name }} {{ $comentario->sobrenome }}
                                </h6>
                                
                                <p class="text-sm lh-160" style="font-size: 13px !important;font-weight: 400;">
                                    {{ $comentario->comentario }}
                                </p>
                                
                                <div class="icon-actions" style="font-size: 11px;">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span class="text-muted">
                                        {{ date( 'd/m/Y' , strtotime($comentario->data_postagem)) }}
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            @endif

          @empty

          @endforelse

          

        </div>

        <div class="card-footer py-4 collapse-hidden-comentario-projeto">
            
            <form action="{{ route('backend.gatilhos.tipoprojeto.comentario.adicionar', $id_projeto_oficial) }}" method="post" enctype="multipart/form-data" style="float: left;width: 100%;">            
              
              {{ csrf_field() }}
              
              <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
              
              <textarea class="form-control" name="comentario" style="width: 93%;float: left;"></textarea>

              <button style="cursor: pointer;background: transparent;border: none;color: #5c6ce8;margin-top: 20px;float: left;margin-left: 2%;width: 5%;">
                <i class="fas fa-paper-plane enviar"></i>
              </button>

            </form>

        </div>

      </div>