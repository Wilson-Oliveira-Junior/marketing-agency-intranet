<div class="card card-profile shadow" style="border: none;">

        <div class="card-header bg-white border-0" style="padding: 0px;">
            <div class="row align-items-center">
                <div class="col-12">

                    <ul class="nav-tarefa">

                        <li>
                            <a href="#" class="active">
                                GUT
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="tabs-sub">

            <div class="ml-2 mb-2 d-flex justify-content-between">
                <select name="idequipe" id="idequipe" style="width:25%">
                    <option value="0">Qual equipe deseja ver o GUT?</option>
                    @foreach ($setores as $setor)
                        <option value="{{ $setor->id }}" @if($equipe->id == $setor->id) selected="selected" @endif>{{ $setor->nome }}</option>
                    @endforeach
                </select>

                <div class="nome-setor-clicado" style="font-size: 17px;">
                    Você está visualizando a área de: <strong id="nomeEquipe">{{ $equipe->nome }}</strong>
                </div>

                <p><button class="btn btn-primary btn-atualiza-lista mr-2">Atualizar Listagem</button></p>
            </div>

        </div>

        <div class="table-responsive listagem-gut" style="padding: 0px 15px;">

        </div>





    </div>
