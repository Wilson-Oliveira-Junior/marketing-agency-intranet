<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <a href="#">
                        <img src="{{ $usuarios->image ? config('app.url').'/'.ltrim($usuarios->image, '/') : asset('img/user.svg') }}" class="">
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">.</a>
                <a href="#" class="btn btn-sm btn-default float-right">.</a>
            </div>
        </div>
        
        <div class="card-body pt-0 pt-md-4">
            <div class="row">
                <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                        
                        <div>
                            <span class="heading">{{ $contagem_usuario }}</span>
                            <span class="description">Amigos</span>
                        </div>
                        
                        <div>
                            <span class="heading">#</span>
                            <span class="description">Conteúdo</span>
                        </div>
                        
                        <div>
                            <span class="heading">#</span>
                            <span class="description">Conteúdo</span>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <h3>
                  {{ $usuarios->name }} <span class="font-weight-light">, {{ $ano_nascimento }}</span>
                </h3>
                
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{ $usuarios->cidade }}, {{ $usuarios->estado }}
                </div>
                
                <div class="h3 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Setor: @foreach($area_atuacao as $registro)	{{ $registro->nome  }} @endforeach
                </div>
                
                <hr class="my-4" />

                    <div class="col-md-4" style="float:left">                        
                        <a href="{{ $usuarios->facebook  }}" target="_blank">
                            <img src="{{ asset('img/icone-face.png') }}" style="width:50px;">
                        </a>                    
                    </div>

                    <div class="col-md-4" style="float:left">
                        <a href="{{ $usuarios->instagram  }}" target="_blank">
                            <img src="{{ asset('img/icone-insta.png') }}" style="width:50px;">
                        </a>   
                    </div>

                    <div class="col-md-4" style="float:left">
                        <a href="{{ $usuarios->linkedin  }}" target="_blank">
                            <img src="{{ asset('img/icone-linkedin.png') }}" style="width:50px;">
                        </a>   
                    </div>

            </div>
        </div>
    </div>
</div>