<?php
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend/tarefas/usuarioTarefa', ['uses'=>'Backend\TarefaController@usuarioTarefa', 'as'=>'backend.tarefa.json.usuarioTarefa'])->middleware('cors');
//Route::get('/backend/tarefas/usuarioTarefa', array('middleware' => 'cors', 'uses' => 'Backend\TarefaController@usuarioTarefa'));
Auth::routes();

Route::get('/backend', 'HomeController@index')->name('home');



Route::group(['middleware'=>'auth'],function(){

    /************************** Redirect **************************/
        Route::redirect('/', '/backend', 301);
        Route::redirect('/home', '/backend', 301);
    /************************** Fim do Redirect **************************/

	/* TESTANDO */
		Route::get('/backend/testando/usuarios',                 ['uses'=>'Backend\UsuarioController@testando',        'as'=>'backend.usuario.testando']);
	/* */

    /************************** Dashboard ***************************/
	    Route::get('/backend',              ['uses'=>'BackendController@index',         'as'=>'backend.principal']);
		Route::get('/backend/login/sair',   ['uses'=>'Backend\UsuarioController@Sair',  'as'=>'backend.login.sair']);
		Route::any('/backend/importarClientesAsaas',   ['uses'=>'BackendController@importarClientesAsaas',  'as'=>'backend.importarClientesAsaas']);
		Route::post('/backend/importarClientesAsaas/salvarClienteAsaas', ['uses'=>'BackendController@salvarClienteAsaas', 'as'=>'backend.importarClientesAsaas.salvarClienteAsaas']);
    /************************** Fim do Usuários ***************************/

    /************************** Usuários ***************************/
        Route::get('/backend/usuarios',                 ['uses'=>'Backend\UsuarioController@index',        'as'=>'backend.usuario']);
        Route::get('/backend/usuarios/adicionar',       ['uses'=>'Backend\UsuarioController@adicionar',    'as'=>'backend.usuario.adicionar']);
        Route::post('/backend/usuarios/salvar',         ['uses'=>'Backend\UsuarioController@salvar',       'as'=>'backend.usuario.salvar']);
        Route::get('/backend/usuarios/editar/{id}',     ['uses'=>'Backend\UsuarioController@editar',       'as'=>'backend.usuario.editar']);
        Route::put('/backend/usuarios/atualizar/{id}',  ['uses'=>'Backend\UsuarioController@atualizar',    'as'=>'backend.usuario.atualizar']);
        Route::get('/backend/usuarios/deletar/{id}',    ['uses'=>'Backend\UsuarioController@deletar',      'as'=>'backend.usuario.deletar']);
		Route::get('/backend/usuarios/status/', 		['uses'=>'Backend\UsuarioController@mudarStatus',  'as'=>'backend.usuario.status']);
	/************************** Fim do Usuários ***************************/

	/************************** Setor Usuário ***************************/
        Route::get('/backend/setores', 					['uses'=>'Backend\SetorController@index',       'as'=>'backend.setor']);
        Route::get('/backend/setores/adicionar', 		['uses'=>'Backend\SetorController@adicionar',   'as'=>'backend.setor.adicionar']);
        Route::post('/backend/setores/salvar', 			['uses'=>'Backend\SetorController@salvar',      'as'=>'backend.setor.salvar']);
        Route::get('/backend/setores/editar/{id}', 		['uses'=>'Backend\SetorController@editar',      'as'=>'backend.setor.editar']);
        Route::put('/backend/setores/atualizar/{id}', 	['uses'=>'Backend\SetorController@atualizar',   'as'=>'backend.setor.atualizar']);
        Route::get('/backend/setores/deletar/{id}', 	['uses'=>'Backend\SetorController@deletar',     'as'=>'backend.setor.deletar']);
    /************************** Fim do Setor Usuário  ***************************/

	/************************** Segmentos do Cliente ***************************/
		Route::get('/backend/segmentos', 					['uses'=>'Backend\SegmentoController@index',       'as'=>'backend.segmento']);
		Route::get('/backend/segmentos/adicionar', 			['uses'=>'Backend\SegmentoController@adicionar',   'as'=>'backend.segmento.adicionar']);
		Route::post('/backend/segmentos/salvar', 			['uses'=>'Backend\SegmentoController@salvar',      'as'=>'backend.segmento.salvar']);
		Route::get('/backend/segmentos/editar/{id}', 		['uses'=>'Backend\SegmentoController@editar',      'as'=>'backend.segmento.editar']);
		Route::put('/backend/segmentos/atualizar/{id}', 	['uses'=>'Backend\SegmentoController@atualizar',   'as'=>'backend.segmento.atualizar']);
		Route::get('/backend/segmentos/deletar/{id}', 		['uses'=>'Backend\SegmentoController@deletar',     'as'=>'backend.segmento.deletar']);
		// Json
		Route::get('/backend/segmentos/atuais',	 			['uses'=>'Backend\SegmentoController@segmentosAtuais',    	'as'=>'backend.segmento.json.segmentoTotal']);
	/************************** Fim Segmento  ***************************/

	/************************** Papel Usuário ***************************/
        Route::get('/backend/tipo-usuario', 					['uses'=>'Backend\RoleController@index',       'as'=>'backend.tipo-usuario']);
        Route::get('/backend/tipo-usuario/adicionar', 			['uses'=>'Backend\RoleController@adicionar',   'as'=>'backend.tipo-usuario.adicionar']);
        Route::post('/backend/tipo-usuario/salvar', 			['uses'=>'Backend\RoleController@salvar',      'as'=>'backend.tipo-usuario.salvar']);
        Route::get('/backend/tipo-usuario/editar/{id}', 		['uses'=>'Backend\RoleController@editar',      'as'=>'backend.tipo-usuario.editar']);
        Route::put('/backend/tipo-usuario/atualizar/{id}', 		['uses'=>'Backend\RoleController@atualizar',   'as'=>'backend.tipo-usuario.atualizar']);
        Route::get('/backend/tipo-usuario/deletar/{id}', 		['uses'=>'Backend\RoleController@deletar',     'as'=>'backend.tipo-usuario.deletar']);
	/************************** Fim do Papel Usuário  ***************************/

	/************************** Papel Permissão Usuário ***************************/
		Route::get('/backend/usuarios/{id}/papel/', 						['uses'=>'Backend\UsuarioController@papel',				'as'=>'backend.usuarios.papel']);
		Route::post('/backend/usuarios/papel/salvar/{id}', 					['uses'=>'Backend\UsuarioController@salvarPapel',		'as'=>'backend.usuarios.papel.salvar']);
		Route::get('/backend/usuarios/{id}/papel/{papel_id}/remover/', 		['uses'=>'Backend\UsuarioController@removerPapel',		'as'=>'backend.usuarios.papel.remover']);
	/************************** Papel Permissão Usuário ***************************/

	/************************** Papel Permissão Usuário ***************************/
		Route::get('/backend/tipo-usuario/{id}/permissao/', 						['uses'=>'Backend\RoleController@permissao',			'as'=>'backend.tipo-usuario.permissao']);
		Route::post('/backend/tipo-usuario/permissao/salvar/{id}', 					['uses'=>'Backend\RoleController@salvarPermissao',		'as'=>'backend.tipo-usuario.permissao.salvar']);
		Route::get('/backend/tipo-usuario/{id_role}/permissao/{id_permission}/remover/', 					['uses'=>'Backend\RoleController@removerPermissao',		'as'=>'backend.tipo-usuario.permissao.remover']);
	/************************** Papel Permissão Usuário ***************************/

	/************************** Papel Usuário ***************************/
        Route::get('/backend/permissao', 					['uses'=>'Backend\PermissionController@index',       'as'=>'backend.permissao']);
        Route::get('/backend/permissao/adicionar', 			['uses'=>'Backend\PermissionController@adicionar',   'as'=>'backend.permissao.adicionar']);
        Route::post('/backend/permissao/salvar', 			['uses'=>'Backend\PermissionController@salvar',      'as'=>'backend.permissao.salvar']);
        Route::get('/backend/permissao/editar/{id}', 		['uses'=>'Backend\PermissionController@editar',      'as'=>'backend.permissao.editar']);
        Route::put('/backend/permissao/atualizar/{id}', 	['uses'=>'Backend\PermissionController@atualizar',   'as'=>'backend.permissao.atualizar']);
        Route::get('/backend/permissao/deletar/{id}', 		['uses'=>'Backend\PermissionController@deletar',     'as'=>'backend.permissao.deletar']);
	/************************** Fim do Papel Usuário  ***************************/

	/************************** Sugestão pro Sistema ***************************/
        Route::get('/backend/sugestao', 					['uses'=>'Backend\SugestaoController@index',       'as'=>'backend.sugestao']);
        Route::get('/backend/sugestao/adicionar', 			['uses'=>'Backend\SugestaoController@adicionar',   'as'=>'backend.sugestao.adicionar']);
        Route::post('/backend/sugestao/salvar', 			['uses'=>'Backend\SugestaoController@salvar',      'as'=>'backend.sugestao.salvar']);
        Route::get('/backend/sugestao/editar/{id}', 		['uses'=>'Backend\SugestaoController@editar',      'as'=>'backend.sugestao.editar']);
        Route::put('/backend/sugestao/atualizar/{id}', 		['uses'=>'Backend\SugestaoController@atualizar',   'as'=>'backend.sugestao.atualizar']);
        Route::get('/backend/sugestao/deletar/{id}', 		['uses'=>'Backend\SugestaoController@deletar',     'as'=>'backend.sugestao.deletar']);
	/************************** Fim Sugestão  ***************************/

    /************************** Cliente ***************************/

		Route::get('/backend/clientes', 				['uses'=>'Backend\ClienteController@index',     	'as'=>'backend.cliente'				]);
		Route::get('/backend/relatorio/clientes', 		['uses'=>'Backend\ClienteController@listagem',     	'as'=>'backend.cliente.listagem'	]);
		Route::post('/backend/relatorio/clientes/filtro', 'Backend\ClienteController@filtrarListagem')->name('backend.cliente.listagem.filtro');
		Route::get('/backend/relatorio/clientes/registro-senhas', 		['uses'=>'Backend\RegistroDeSenhaController@listagemRegistroDeSenhas',     	'as'=>'backend.cliente.registro-senha.listagem'	]);
		Route::any('/backend/clientes/busca/', 			['uses'=>'Backend\ClienteController@busca',     	'as'=>'backend.cliente.busca'		]);

		/************************** CRUD ***************************/
			Route::get('/backend/clientes/adicionar', 		['uses'=>'Backend\ClienteController@adicionar', 'as'=>'backend.cliente.adicionar']);
			Route::post('/backend/clientes/salvar', 		['uses'=>'Backend\ClienteController@salvar',    'as'=>'backend.cliente.salvar']);
			Route::get('/backend/clientes/editar/{id}', 	['uses'=>'Backend\ClienteController@editar',    'as'=>'backend.cliente.editar']);
			Route::put('/backend/clientes/atualizar/{id}', 	['uses'=>'Backend\ClienteController@atualizar', 'as'=>'backend.cliente.atualizar']);
			Route::get('/backend/clientes/deletar/{id}', 	['uses'=>'Backend\ClienteController@deletar',   'as'=>'backend.cliente.deletar']);
			Route::get('/backend/clientes/status/', 		['uses'=>'Backend\ClienteController@mudarStatus',    'as'=>'backend.cliente.status']);
		/************************** FIM CRUD ***************************/

		/************************** Contato Cliente ***************************/
			Route::get('/backend/clientes/{id}/contato/adicionar', 				['uses'=>'Backend\ClienteController@adicionarContato',    	'as'=>'backend.cliente.adicionarContato']);
			Route::post('/backend/clientes/contato/salvar', 					['uses'=>'Backend\ClienteController@salvarContato',    		'as'=>'backend.cliente.salvarContato']);
			Route::get('/backend/clientes/{id}/contato/editar/{id_contato}', 	['uses'=>'Backend\ClienteController@editarContato',    		'as'=>'backend.cliente.editarContato']);
			Route::put('/backend/clientes/{id}/contato/atualizar/{id_contato}',	['uses'=>'Backend\ClienteController@atualizarContato',   	'as'=>'backend.cliente.atualizarContato']);
			Route::get('/backend/clientes/{id}/contato/deletar/{id_contato}', 	['uses'=>'Backend\ClienteController@deletarContato',    	'as'=>'backend.cliente.deletarContato']);
		/************************** FIM Contato Cliente ***************************/

		/************************** Dominios ***************************/
			Route::get('/backend/clientes/{id}/dominio/adicionar', 				['uses'=>'Backend\ClienteController@adicionarDominio',   'as'=>'backend.cliente.adicionarDominio']);
			Route::post('/backend/clientes/dominio/salvar', 					['uses'=>'Backend\ClienteController@salvarDominio',      'as'=>'backend.cliente.salvarDominio']);
			Route::get('/backend/clientes/{id}/dominio/editar/{id_dominio}', 	['uses'=>'Backend\ClienteController@editarDominio',      'as'=>'backend.cliente.editarDominio']);
			Route::put('/backend/clientes/{id}/dominio/atualizar/{id_dominio}',	['uses'=>'Backend\ClienteController@atualizarDominio',   'as'=>'backend.cliente.atualizarDominio']);
			Route::get('/backend/clientes/{id}/dominio/deletar/{id_dominio}', 	['uses'=>'Backend\ClienteController@deletarDominio',     'as'=>'backend.cliente.deletarDominio']);
		/************************** Fim do Dominios  ***************************/

		/************************** Adicionar Responsavel ********************************/
		            Route::post('/backend/clientes/responsavel/salvar', ['uses' => 'Backend\ClienteResponsavelController@store'])->name('backend.clientes.responsavel.salvar');
		            Route::delete('/backend/clientes/responsavel/apagar/{id}', 'Backend\ClienteResponsavelController@destroy')->name('backend.clientes.responsavel.apagar');
		/************************** Fim Adicioanar Responsavel ***************************/

		/************************** Registro de Senhas ***************************/
			Route::get('/backend/clientes/{id}/registro-senha/adicionar', ['uses'=>'Backend\ClienteController@adicionarRegistroSenha',   'as'=>'backend.cliente.adicionarRegistroSenha']);
			Route::post('/backend/clientes/registro-senha/salvar',['uses'=>'Backend\ClienteController@salvarRegistroSenha',      'as'=>'backend.cliente.salvarRegistroSenha']);
			Route::put('/backend/clientes/{id}/registro-senha/atualizar/{idRegistroSenha}',	['uses'=>'Backend\RegistroDeSenhaController@atualizarRegistroSenha',   'as'=>'backend.cliente.atualizarRegistroSenha']);
			Route::get('/backend/clientes/{id}/registro-senha/deletar/{idRegistroSenha}', 	['uses'=>'Backend\RegistroDeSenhaController@deletarRegistroSenha',     'as'=>'backend.cliente.deletarRegistroSenha']);
			Route::get('/backend/clientes/{id}/registro-senha/editar/{idRegistroSenha}', 	['uses'=>'Backend\RegistroDeSenhaController@editarRegistroSenha',      'as'=>'backend.cliente.editarRegistroSenha']);
			Route::post('/backend/clientes/registro-senha/editar-solicitacao/', 	['uses'=>'Backend\RegistroDeSenhaController@editarRegistroSenhaAprovacao',      'as'=>'backend.cliente.editarRegistroSenhaAprovacao']);
			Route::post('/backend/clientes/registro-senha/atualizar-solicitacao/',	['uses'=>'Backend\RegistroDeSenhaController@atualizarRegistroSenhaAprovacao',   'as'=>'backend.cliente.atualizarRegistroSenhaAprovacao']);
            Route::get('/backend/clientes/registro-senha/listagem-por-cliente/{idcliente}', ['uses' => 'Backend\RegistroDeSenhaController@listagemPorCliente'])->name('backend.clientes.registro-senha.listagem-por-cliente');
		/************************** Fim do Registro  ***************************/

		/************************** Projetos **************************/
			Route::get('/backend/clientes/{id}/projeto/adicionar', 				['uses'=>'Backend\ClienteController@adicionarProjeto',   'as'=>'backend.cliente.adicionarProjeto'	]);
			Route::post('/backend/clientes/projeto/salvar', 					['uses'=>'Backend\ClienteController@salvarProjeto',      'as'=>'backend.cliente.salvarProjeto'		]);
			Route::get('/backend/clientes/{id}/projeto/editar/{id_projeto}', 	['uses'=>'Backend\ClienteController@editarProjeto',      'as'=>'backend.cliente.editarProjeto'		]);
			Route::put('/backend/clientes/{id}/projeto/atualizar/{id_projeto}',	['uses'=>'Backend\ClienteController@atualizarProjeto',   'as'=>'backend.cliente.atualizarProjeto'	]);
			Route::get('/backend/clientes/{id}/projeto/deletar/{id_projeto}', 	['uses'=>'Backend\ClienteController@deletarProjeto',     'as'=>'backend.cliente.deletarProjeto'		]);
		/************************** Fim Projetos **************************/

		/************************** FTP Dominio FTP ***************************/
			Route::get('/backend/clientes/{id}/dominio/ftp', 				['uses'=>'Backend\ClienteFTPDominioController@adicionarFTP',		'as'=>'backend.cliente.dominio.ftp']);
			Route::post('/backend/clientes/{id}/dominio/ftp/salvar/', 		['uses'=>'Backend\ClienteFTPDominioController@salvarFTP',			'as'=>'backend.cliente.dominio.ftp.salvar']);
			Route::put('/backend/clientes/{id}/dominio/{id_dominio}/ftp/atualizar/', 	['uses'=>'Backend\ClienteFTPDominioController@atualizarFTP',		'as'=>'backend.cliente.dominio.ftp.atualizar']);
			Route::get('/backend/clientes/{id}/dominio/{id_dominio}/ftp/adicionar/', 	['uses'=>'Backend\ClienteFTPDominioController@adicionarFTP',    	'as'=>'backend.cliente.dominio.ftp.adicionar']);
			Route::get('/backend/clientes/{id}/dominio/{id_dominio}/ftp/editar/', 	['uses'=>'Backend\ClienteFTPDominioController@editarFTP',    		'as'=>'backend.cliente.dominio.ftp.editar']);
		/************************** FIM Dominio FTP ***************************/

		/************************** Transferir Cliente ***************************/
			Route::get('/backend/clientes/{id}/projeto/transferir/{id_projeto}', ['uses'=>'Backend\ClienteController@tranferirCliente',      		'as'=>'backend.cliente.transferir']);
			Route::post('/backend/clientes/{id}/projeto/transferir/salvar/{id_projeto}', 	['uses'=>'Backend\ClienteController@tranferirSalvarCliente',      	'as'=>'backend.cliente.salvar.transferir']);
			Route::post('/backend/clientes/{id}/projeto/transferir/{id_projeto}/dominio/salvar', ['uses'=>'Backend\ClienteController@salvarDominioTransferir',      'as'=>'backend.cliente.transferir.dominio.salvarDominio']);
			Route::get('/backend/clientes/{id}/dominios/', 				['uses'=>'Backend\ClienteController@dominiosCliente',      			'as'=>'backend.cliente.json.transferir'				]);
			Route::get('/backend/clientes/{id}/adicionar/dominios/', 	['uses'=>'Backend\ClienteController@dominioAdicionarCliente',      	'as'=>'backend.cliente.adicionar.transferir'		]);
		/************************** Transferir Cliente ***************************/


	/************************** Fim Cliente ***************************/

    /************************** Projetos ***************************/
		Route::get('/backend/projetos', 				['uses'=>'Backend\ProjetoController@index',     'as'=>'backend.projeto']);
		Route::get('/backend/projetos/adicionar', 		['uses'=>'Backend\ProjetoController@adicionar', 'as'=>'backend.projeto.adicionar']);
		Route::post('/backend/projetos/salvar', 		['uses'=>'Backend\ProjetoController@salvar',    'as'=>'backend.projeto.salvar']);
		Route::get('/backend/projetos/editar/{id}', 	['uses'=>'Backend\ProjetoController@editar',    'as'=>'backend.projeto.editar']);
		Route::put('/backend/projetos/atualizar/{id}', 	['uses'=>'Backend\ProjetoController@atualizar', 'as'=>'backend.projeto.atualizar']);
		Route::get('/backend/projetos/deletar/{id}', 	['uses'=>'Backend\ProjetoController@deletar',   'as'=>'backend.projeto.deletar']);
		Route::post('/backend/projetos/busca/', 		['uses'=>'Backend\ProjetoController@busca',     'as'=>'backend.projeto.busca']);
	/************************** Fim Projetos  ***************************/

    /************************** Status ***************************/
		Route::get('/backend/status', 					['uses'=>'Backend\StatusController@index',     'as'=>'backend.status']);
		Route::get('/backend/status/adicionar', 		['uses'=>'Backend\StatusController@adicionar', 'as'=>'backend.status.adicionar']);
		Route::post('/backend/status/salvar', 			['uses'=>'Backend\StatusController@salvar',    'as'=>'backend.status.salvar']);
		Route::get('/backend/status/editar/{id}', 		['uses'=>'Backend\StatusController@editar',    'as'=>'backend.status.editar']);
		Route::put('/backend/status/atualizar/{id}', 	['uses'=>'Backend\StatusController@atualizar', 'as'=>'backend.status.atualizar']);
		Route::get('/backend/status/deletar/{id}', 		['uses'=>'Backend\StatusController@deletar',   'as'=>'backend.status.deletar']);
		Route::post('/backend/status/busca/', 			['uses'=>'Backend\StatusController@busca',     'as'=>'backend.status.busca']);
	/************************** Fim Status  ***************************/

	/************************** Tipos de Tarefas ***************************/
		Route::get('/backend/tipos-tarefas', 				['uses'=>'Backend\TiposTarefasController@index',     'as'=>'backend.tipotarefa']);
		Route::get('/backend/tipos-tarefas/adicionar', 		['uses'=>'Backend\TiposTarefasController@adicionar', 'as'=>'backend.tipotarefa.adicionar']);
		Route::post('/backend/tipos-tarefas/salvar', 		['uses'=>'Backend\TiposTarefasController@salvar',    'as'=>'backend.tipotarefa.salvar']);
		Route::get('/backend/tipos-tarefas/editar/{id}', 	['uses'=>'Backend\TiposTarefasController@editar',    'as'=>'backend.tipotarefa.editar']);
		Route::put('/backend/tipos-tarefas/atualizar/{id}', ['uses'=>'Backend\TiposTarefasController@atualizar', 'as'=>'backend.tipotarefa.atualizar']);
		Route::get('/backend/tipos-tarefas/deletar/{id}', 	['uses'=>'Backend\TiposTarefasController@deletar',   'as'=>'backend.tipotarefa.deletar']);
		Route::post('/backend/tipos-tarefas/busca/', 		['uses'=>'Backend\TiposTarefasController@busca',     'as'=>'backend.tipotarefa.busca']);
		Route::get('/backend/tipos-tarefas/status', 		['uses'=>'Backend\TiposTarefasController@mudarStatus', 'as'=>'backend.tipotarefa.status']);
	/************************** Fim Tipos de Tarefas  ***************************/

	/************************** Cliente Vencidos ***************************/

		Route::get('/backend/clientes/vencidos', 	['uses'=>'Backend\ClienteController@vencidos',		'as'=>'backend.cliente.vencidos']);

		/* Ordem Alfabetica */
		Route::get('/backend/clientes/vencidos/nome-maior', 	['uses'=>'Backend\ClienteController@vencidos_nome_maior',		'as'=>'backend.cliente.vencidos.nome_maior']);
		Route::get('/backend/clientes/vencidos/nome-menor', 	['uses'=>'Backend\ClienteController@vencidos_nome_menor',		'as'=>'backend.cliente.vencidos.nome_menor']);

		/* Valor */
		Route::get('/backend/clientes/vencidos/valor-maior', 	['uses'=>'Backend\ClienteController@vencidos_valor_maior',		'as'=>'backend.cliente.vencidos.valor_maior']);
		Route::get('/backend/clientes/vencidos/valor-menor', 	['uses'=>'Backend\ClienteController@vencidos_valor_menor',		'as'=>'backend.cliente.vencidos.valor_menor']);

		/* Vencimento */
		Route::get('/backend/clientes/vencidos/data-maior', 	['uses'=>'Backend\ClienteController@vencidos_data_maior',		'as'=>'backend.cliente.vencidos.data_maior']);
		Route::get('/backend/clientes/vencidos/data-menor', 	['uses'=>'Backend\ClienteController@vencidos_data_menor',		'as'=>'backend.cliente.vencidos.data_menor']);

		/* Atualizar Banco*/
		Route::get('/backend/clientes/vencidos/atualizar', 	['uses'=>'Backend\ClienteController@atualizar_vencidos',	'as'=>'backend.cliente.vencidos.atualizar']);

		/* Buscar */
		Route::post('/backend/clientes/vencidos/busca/', 	['uses'=>'Backend\ClienteController@buscavencidos',     	'as'=>'backend.cliente.vencidos.busca']);
	/************************** Fim Cliente Vencidos ***************************/

    /************************** Meu Perfil ***************************/
		Route::get('/backend/perfil', 				    		['uses'=>'Backend\ControllerPerfil@index',     	'as'=>'backend.perfil']);
		Route::get('/backend/usuario/{idusuario}/perfil', 		['uses'=>'Backend\ControllerPerfil@perfil',     'as'=>'backend.usuario.perfil']);
	/************************** Fim Meu Perfil  ***************************/

    /************************** Lembretes ***************************/

		Route::post('/backend/lembretes/busca/', 			['uses'=>'Backend\LembreteController@busca','as'=>'backend.lembrete.busca']);

		/****** CRUD ******/
			Route::get('/backend/lembretes', 				['uses'=>'Backend\LembreteController@index',        'as'=>'backend.lembrete']);
			Route::get('/backend/lembretes/adicionar', 		['uses'=>'Backend\LembreteController@adicionar',    'as'=>'backend.lembrete.adicionar']);
			Route::post('/backend/lembretes/salvar', 		['uses'=>'Backend\LembreteController@salvar',       'as'=>'backend.lembrete.salvar']);
			Route::get('/backend/lembretes/editar/{id}', 	['uses'=>'Backend\LembreteController@editar',       'as'=>'backend.lembrete.editar']);
			Route::put('/backend/lembretes/atualizar/{id}', ['uses'=>'Backend\LembreteController@atualizar',    'as'=>'backend.lembrete.atualizar']);
			Route::get('/backend/lembretes/deletar/{id}', 	['uses'=>'Backend\LembreteController@deletar',      'as'=>'backend.lembrete.deletar']);
        /****** FIM DO CRUD ******/

        /****** Itens a parte ******/
			/* Painel */
			Route::get('/backend/lembretes/area-equipe', 	['uses'=>'Backend\LembreteController@area',         'as'=>'backend.lembrete.area-equipe']);
			Route::get('/backend/lembretes/eu-criei', 		['uses'=>'Backend\LembreteController@criei',        'as'=>'backend.lembrete.eu-criei']);
			Route::get('/backend/lembretes/abertos', 		['uses'=>'Backend\LembreteController@abertos',      'as'=>'backend.lembrete.abertos']);
			Route::get('/backend/lembretes/pendentes', 		['uses'=>'Backend\LembreteController@pendentes',    'as'=>'backend.lembrete.pendentes']);
            Route::get('/backend/lembretes/fechados', 		['uses'=>'Backend\LembreteController@fechados',     'as'=>'backend.lembrete.fechados']);

			/* Nível de Importância */
			Route::get('/backend/lembretes/nivel-de-importancia/alta', 	['uses'=>'Backend\LembreteController@alta','as'=>'backend.lembrete.nivel-de-importancia.alta']);
			Route::get('/backend/lembretes/nivel-de-importancia/media', ['uses'=>'Backend\LembreteController@media','as'=>'backend.lembrete.nivel-de-importancia.media']);
			Route::get('/backend/lembretes/nivel-de-importancia/baixa', ['uses'=>'Backend\LembreteController@baixa','as'=>'backend.lembrete.nivel-de-importancia.baixa']);
		/****** Fim Itens a parte ******/

        /****** Controle Sobre o Lembrete ******/
			Route::get('/backend/lembretes/concluir/{id}', 	 ['uses'=>'Backend\LembreteController@concluir','as'=>'backend.lembrete.concluir']);
			Route::get('/backend/lembretes/reabrir/{id}', 	 ['uses'=>'Backend\LembreteController@reabrir','as'=>'backend.lembrete.reabrir']);
			Route::post('/backend/lembretes/comentario/{id}', ['uses'=>'Backend\ComentarioController@comentario_adicionar',    'as'=>'backend.lembrete.comentario.adicionar']);
			Route::get('/backend/lembretes/comentario/deletar/{id}', ['uses'=>'Backend\ComentarioController@comentario_deletar',    'as'=>'backend.lembrete.comentario.deletar']);
		/****** Fim Controle Sobre o Lembrete ******/

	/************************** Fim Lembretes ***************************/

	/************************** Tarefas ***************************/

		Route::any('/backend/tarefas/busca/', 			['uses'=>'Backend\TarefaController@busca','as'=>'backend.tarefa.busca']);
		//Route::get('backend.tarefa.busca', ['as' => 'backend.tarefa.busca', 'uses' => 'Backend\TarefaController@busca']);

		/****** CRUD ******/
			Route::get('/backend/tarefas/adicionar', 		['uses'=>'Backend\TarefaController@adicionar',    'as'=>'backend.tarefa.adicionar']);
			Route::post('/backend/tarefas/salvar', 			['uses'=>'Backend\TarefaController@salvar',       'as'=>'backend.tarefa.salvar']);
			Route::get('/backend/tarefas/deletar/{id}', 	['uses'=>'Backend\TarefaController@deletar',      'as'=>'backend.tarefa.deletar']);
        /****** FIM DO CRUD ******/

		/****** Comentários ******/
			Route::post('/backend/tarefas/comentarios/adicionar/{id}', 		['uses'=>'Backend\TarefaController@adicionar_comentario',    	'as'=>'backend.tarefa.comentario.adicionar']);
			Route::delete('/backend/tarefas/{id_tarefa}/comentarios/{id_comentario}/apagar', 'Backend\TarefaController@apagarComentario')->name('backend.tarefa.comentario.apagar');
		/****** Fim Comentário ******/

		/****** Anexos ******/
			Route::post('/backend/tarefas/anexos/adicionar/{id}', 					['uses'=>'Backend\TarefaController@adicionar_anexo',    		'as'=>'backend.tarefa.anexo.adicionar']);
			Route::get('/backend/tarefas/{id_tarefa}/anexos/{id_anexo}/deletar', 	['uses'=>'Backend\TarefaController@deletar_anexo',    			'as'=>'backend.tarefa.anexo.deletar']);
            Route::delete('/backend/tarefas/{id_tarefa}/anexos/{id_anexo}/apagar', 'Backend\TarefaController@apagarAnexo')->name('backend.tarefa.anexo.apagar');
			Route::get('/backend/tarefas/{id_tarefa}/anexos/all', 					['uses'=>'Backend\TarefaController@downloadAnexos',    			'as'=>'backend.tarefa.anexo.all'])->middleware('cors');
		/****** Fim Anexos ******/

		/****** Seguidor ******/
			Route::post('/backend/tarefas/seguidor/adicionar/{id}', 					['uses'=>'Backend\TarefaController@adicionar_seguidor',    		'as'=>'backend.tarefa.seguidor.adicionar']);
			Route::get('/backend/tarefas/{id_tarefa}/seguidor/{id_seguidor}/deletar', 	['uses'=>'Backend\TarefaController@deletar_seguidor',    		'as'=>'backend.tarefa.seguidor.deletar']);
		/****** Fim Seguidor ******/

		/****** Ajax ******/
			Route::get('/backend/inserirStatus/tarefa/{id_tarefa}/status/{id_status}/usuario/{id_usuario}', 	['uses'=>'Backend\TarefaController@ajaxStatusTarefa',    	'as'=>'backend.tarefa.json.tipoTarefa'			]);
			Route::get('/backend/trocarUsuario/tarefa/{id_tarefa}/usuario/{id_usuario}/postou/{id_postou}', 	['uses'=>'Backend\TarefaController@ajaxUsuarioTarefa',    	'as'=>'backend.tarefa.json.UsuarioTTarefa'		]);
			Route::get('/backend/alterarTipos/tarefa/{id_tarefa}/tipo/{id_tipo}/usuario/{id_usuario}', 			['uses'=>'Backend\TarefaController@ajaxAlterarTipo',    	'as'=>'backend.tarefa.json.alterarTipo'			]);
			Route::get('/backend/alterarProjeto/tarefa/{id_tarefa}/projeto/{id_projeto}/usuario/{id_usuario}', 	['uses'=>'Backend\TarefaController@ajaxAlterarProjeto',    	'as'=>'backend.tarefa.json.alterarProjeto'		]);
			Route::post('/backend/tarefas/{id_tarefa}/alterartitulo',	 										['uses'=>'Backend\TarefaController@alterarTitulo',    		'as'=>'backend.tarefa.json.alterarTitulo'		]);
			Route::post('/backend/tarefas/{id_tarefa}/alterardescricao',	 									['uses'=>'Backend\TarefaController@alterarDescricao',    	'as'=>'backend.tarefa.json.alterarDescricao'	]);
		/****** Fim Ajax ******/

		/****** JSON ******/
			Route::get('/backend/tarefas/statusTarefa', 					['uses'=>'Backend\TarefaController@statusTarefa',    	'as'=>'backend.tarefa.json.tipoTarefa']);
			Route::get('/backend/tarefas/tipoTarefa', 						['uses'=>'Backend\TarefaController@tipoTarefa',    		'as'=>'backend.tarefa.json.tipoTarefa']);
			Route::get('/backend/tarefas/projetoTarefa', 					['uses'=>'Backend\TarefaController@projetoTarefa',    	'as'=>'backend.tarefa.json.projetoTarefa']);

			Route::get('/backend/tarefas/setorTarefa',	 					['uses'=>'Backend\TarefaController@setorTarefa',    	'as'=>'backend.tarefa.json.setorTarefa']);
			Route::get('/backend/tarefas/setor/{id_setor}/usuarioTarefa', 	['uses'=>'Backend\TarefaController@usuarioTarefaSetor', 'as'=>'backend.tarefa.json.usuarioTarefaSetor']);
		/****** JSON ******/

		/****** Painel ******/

			// Para Mim
			Route::get('/backend/tarefas', 						['uses'=>'Backend\TarefaController@index',        	'as'=>'backend.tarefa'			]);
			Route::get('/backend/tarefas/filtro/{filtro}', 	['uses'=>'Backend\TarefaController@index',        	'as'=>'backend.tarefa.filtro']);
			Route::get('/backend/tarefas/entregue', 			['uses'=>'Backend\TarefaController@entregues',     	'as'=>'backend.tarefa.entregue'	]);
			Route::get('/backend/tarefas2', 					['uses'=>'Backend\TarefaController@index2',        	'as'=>'backend.tarefa2'			]);


			// Que Criei
			Route::get('/backend/tarefas/criadas', 				['uses'=>'Backend\TarefaController@criei',        			'as'=>'backend.tarefa.criadas']);
			Route::get('/backend/tarefas/criadas/entregue', 	['uses'=>'Backend\TarefaController@criei_entregues',        'as'=>'backend.tarefa.criadas.entregue']);

			// Que eu sigo
			Route::get('/backend/tarefas/seguindo', 			['uses'=>'Backend\TarefaController@seguindo',     			'as'=>'backend.tarefa.seguindo']);
			Route::get('/backend/tarefas/seguindo/entregues', 	['uses'=>'Backend\TarefaController@seguindo_entregues',     'as'=>'backend.tarefa.seguindo.entregue']);

			// Backlog
			Route::get('/backend/tarefas/backlog/{idequipe}', 				['uses'=>'Backend\TarefaController@backlog',     			'as'=>'backend.tarefa.backlog']);
			Route::get('/backend/usuario/{idusuario}/tarefas/',				['uses'=>'Backend\TarefaController@tarefaUser',				'as'=>'backend.usuario.tarefa']);
			Route::get('/backend/usuario/{idusuario}/tarefas/entregues',	['uses'=>'Backend\TarefaController@tarefaUserEntregues',	'as'=>'backend.usuario.tarefa.entregue']);

			// Visualizar Tarefa
			Route::get('/backend/pausarTarefa/tarefa/{id_tarefa}/tempo_trabalhado/{tempo_trabalhado}', 		['uses'=>'Backend\TarefaController@ajax',       	'as'=>'backend.tarefa.tempo']);
			Route::get('/backend/usuarios/tarefas/', 					['uses'=>'Backend\TarefaController@usuarios',       	'as'=>'backend.tarefa.usuarios']);
			Route::get('/backend/usuarios/{id_usuario}/tarefas/', 		['uses'=>'Backend\TarefaController@usuarios_tarefa',    'as'=>'backend.tarefa.usuarios.interna']);
			Route::get('/backend/tarefas/{id}', 						['uses'=>'Backend\TarefaController@editar',       		'as'=>'backend.tarefa.editar']);

		/****** Painel ******/

        /****** Controles ******/
			Route::get('/backend/tarefas/{id}/concluir', 	 		['uses'=>'Backend\TarefaController@concluir',					'as'=>'backend.tarefa.concluir']);
			Route::get('/backend/tarefas/{id}/reabrir', 	 		['uses'=>'Backend\TarefaController@reabrir',					'as'=>'backend.tarefa.reabrir']);
		/****** Fim dos Controles ******/

    /************************** Fim Tarefas ***************************/

	/************************** Tipo de Projeto ***************************/
		Route::get('/backend/tipo-projeto', 					['uses'=>'Backend\ProjetoController@indexTipoProjeto',       'as'=>'backend.tipo-projeto']);
		Route::get('/backend/tipo-projeto/adicionar', 			['uses'=>'Backend\ProjetoController@adicionarTipoProjeto',   'as'=>'backend.tipo-projeto.adicionar']);
		Route::post('/backend/tipo-projeto/salvar', 			['uses'=>'Backend\ProjetoController@salvarTipoProjeto',      'as'=>'backend.tipo-projeto.salvar']);
		Route::get('/backend/tipo-projeto/editar/{id}', 		['uses'=>'Backend\ProjetoController@editarTipoProjeto',      'as'=>'backend.tipo-projeto.editar']);
		Route::put('/backend/tipo-projeto/atualizar/{id}', 		['uses'=>'Backend\ProjetoController@atualizarTipoProjeto',   'as'=>'backend.tipo-projeto.atualizar']);
		Route::get('/backend/tipo-projeto/deletar/{id}', 		['uses'=>'Backend\ProjetoController@deletarTipoProjeto',     'as'=>'backend.tipo-projeto.deletar']);

		/* Json */
			Route::get('/backend/tipo-projeto/listagemTipo',	['uses'=>'Backend\ProjetoController@listagemTipo',    		 'as'=>'backend.tipo-projeto.json.listagemTipo']);
		/* FIm Json */
	/************************** Fim do Tipo de Projeto  ***************************/

	/************************** Cronograma **************************/
		// Rota para visualizar todos os usuários
		Route::get('/backend/cronograma', 				    				['uses'=>'Backend\CronogramaController@index',     				'as'=>'backend.cronograma']);
		Route::get('/backend/cronograma/usuarios', 				    		['uses'=>'Backend\CronogramaController@cronogramaUsuarios',    	'as'=>'backend.cronograma.usuarios']);

		// Rota para o Json de cada usuários especifico
		Route::get('/backend/usuario/{id}/cronograma/tarefas', 				['uses'=>'Backend\CronogramaController@tarefas',     	'as'=>'backend.cronograma.tarefas']);

		// Rota para adicionar no cronograma no banco de dados via ajax
		Route::get('/backend/tarefa/{id_tarefa}/cronograma/{valor_data}/usuario/{id_responsavel}', 	['uses'=>'Backend\CronogramaController@adicionar',     	'as'=>'backend.cronograma.adicionar']);

		// Rota para adicionar no cronograma no banco de dados via ajax
		Route::get('/backend/cronograma/{id_tarefa_cronograma}', 			['uses'=>'Backend\CronogramaController@remover',     	'as'=>'backend.cronograma.deletar']);

		// Rota para visualizar o cronograma
		Route::get('/backend/usuario/{id}/cronograma', 						['uses'=>'Backend\CronogramaController@cronograma',     'as'=>'backend.cronograma.usuario']);
        Route::get('/backend/cronograma/concluir-tarefa/{idtarefa}', 'Backend\CronogramaController@concluirTarefa');
        Route::get('/backend/usuario/{idsetor}/montacronograma', 						['uses'=>'Backend\CronogramaController@montaCronograma',     'as'=>'backend.cronograma.usuario.montacronograma']);
	/************************** Fim Cronograma **************************/

	/************************** Relatorios ********************
	 * Modelo: /backend/relatorio/modulo/nome-relatorio
	 * Ex: /backend/relatorio/cliente/ftps
	 * ******/
		Route::get('/backend/relatorio/cliente/ftps', 								['uses'=>'Backend\RelatorioClienteController@listarFTPs',     			'as'=>'backend.relatorio.cliente.ftps']);
		Route::get('/backend/relatorio/documentos/{idequipe}', 						['uses'=>'Backend\RelatorioClienteController@listarDocumentos',     			'as'=>'backend.relatorio.documentosgerais']);
		Route::get('/backend/relatorio/tarefa/cronograma', 							['uses'=>'Backend\RelatorioClienteController@listarCronogramas',     	'as'=>'backend.relatorio.tarefa.cronograma']);
		Route::get('/backend/relatorio/tarefa/cronograma/usuario/{id}/graficos', 	['uses'=>'Backend\RelatorioClienteController@listarCronogramasGrafico', 'as'=>'backend.relatorio.tarefa.cronogramagrafico']);

		Route::post('/backend/relatorio/busca/tarefas/cronograma/usuario/{id}/graficos', 	['uses'=>'Backend\RelatorioClienteController@buscarCronograma',				'as'=>'backend.relatorio.tarefa.cronogramagraficoBuscar']);
	/************************** Fim Relatorio **************************/

	/************************** Gatilhos **************************/
		Route::get('/backend/gatilhos', 						['uses'=>'Backend\GatilhosController@index',       'as'=>'backend.gatilhos'					]);
		Route::get('/backend/gatilhos/template/{id}', 			['uses'=>'Backend\GatilhosController@template',    'as'=>'backend.gatilhos.template'		]);
		Route::get('/backend/gatilhos/adicionar', 				['uses'=>'Backend\GatilhosController@adicionar',   'as'=>'backend.gatilhos.adicionar'		]);
		Route::post('/backend/gatilhos/salvar', 				['uses'=>'Backend\GatilhosController@salvar',      'as'=>'backend.gatilhos.salvar'			]);
		Route::get('/backend/gatilhos/editar/{id}', 			['uses'=>'Backend\GatilhosController@editar',      'as'=>'backend.gatilhos.editar'			]);
		Route::put('/backend/gatilhos/atualizar/{id}', 			['uses'=>'Backend\GatilhosController@atualizar',   'as'=>'backend.gatilhos.atualizar'		]);
		Route::get('/backend/gatilhos/deletar/{id}', 			['uses'=>'Backend\GatilhosController@deletar',     'as'=>'backend.gatilhos.deletar'			]);

		Route::get('/backend/gatilhos/projeto/{id_projeto}', 								['uses'=>'Backend\GatilhosController@projeto',     	 'as'=>'backend.gatilhos.projeto'			]);
		Route::get('/backend/gatilhos/{id_gatilho}/statusFinalizado/usuario/{id_usuario}', 	['uses'=>'Backend\GatilhosController@finalizar',     'as'=>'backend.gatilhos.finalizar'			]);
		Route::get('/backend/gatilhos/{id_gatilho}/statusAberto/usuario/{id_usuario}', 		['uses'=>'Backend\GatilhosController@aberto',     'as'=>'backend.gatilhos.finalizar'			]);

		// Status do Projeto
		Route::get('/backend/gatilhos/tipoprojeto/{id_projeto}/aberto', 					['uses'=>'Backend\GatilhosController@projetoaberto',     	 	'as'=>'backend.gatilhos.tipoprojeto.aberto'		]);
		Route::get('/backend/gatilhos/tipoprojeto/{id_projeto}/finalizado', 				['uses'=>'Backend\GatilhosController@projetofinalizado',   		'as'=>'backend.gatilhos.tipoprojeto.finalizado'	]);
        Route::get('/backend/gatilhos/relatorio', 'Backend\GatilhosController@relatorioGatilhos');

		// Adicionar Comentário
			Route::post('/backend/gatilhos/tipoprojeto/{id_projeto}/comentarios/adicionar/',  ['uses'=>'Backend\GatilhosController@adicionar_comentario',    	'as'=>'backend.gatilhos.tipoprojeto.comentario.adicionar']);
		//

		/* Guia Geral */
			Route::get('/backend/gatilhos/geral', 						['uses'=>'Backend\GatilhosController@geral',       			'as'=>'backend.gatilhos.geral'					]);
            Route::post('/backend/gatilhos/filtro','Backend\GatilhosController@filtrarGatilhos')->name('backend.gatilhos.geral.filtro');
            Route::get('/backend/gatilhos/ultimo-comentario/{id_projeto}','Backend\GatilhosController@ultimoComentarioProjeto')->name('backend.gatilhos.ultimo-comentario');
            Route::post('/backend/gatilhos/projeto/registrar-comentario/','Backend\GatilhosController@registrarComentarioProjeto')->name('backend.gatilhos.registrar-comentario');
			Route::get('/backend/gatilhos/testegatilhocron', 			['uses'=>'Backend\GatilhosController@dispararEmailGatilhos',     'as'=>'backend.gatilhos.teste'					]);
            Route::get('/backend/gatilhos/atualizar-status', 'Backend\GatilhosController@atualizaStatusGatilhos');
            Route::post('/backend/gatilhos/pausar-projeto', 'Backend\GatilhosController@pausarProjeto')->name('backend.gatilhos.pausar-projeto');
		/* Guia Geral */

		/* GRUPOS DE E-MAIL */
			Route::get('/backend/gatilhos/grupo', 						['uses'=>'Backend\GatilhosController@indexgrupo',       'as'=>'backend.gatilhos.grupo'					]);
			Route::get('/backend/gatilhos/grupo/adicionar', 			['uses'=>'Backend\GatilhosController@adicionargrupo',   'as'=>'backend.gatilhos.grupo.adicionar'		]);
			Route::post('/backend/gatilhos/grupo/salvar', 				['uses'=>'Backend\GatilhosController@salvargrupo',      'as'=>'backend.gatilhos.grupo.salvar'			]);
			Route::get('/backend/gatilhos/grupo/editar/{id}', 			['uses'=>'Backend\GatilhosController@editargrupo',      'as'=>'backend.gatilhos.grupo.editar'			]);
			Route::put('/backend/gatilhos/grupo/atualizar/{id}', 		['uses'=>'Backend\GatilhosController@atualizargrupo',   'as'=>'backend.gatilhos.grupo.atualizar'		]);
			Route::get('/backend/gatilhos/grupo/deletar/{id}', 			['uses'=>'Backend\GatilhosController@deletargrupo',     'as'=>'backend.gatilhos.grupo.deletar'			]);
		/* FIM GRUPOS DE E-MAIL */

		// Salvar Adiamento
			Route::post('/backend/gatilhos/projeto/adiamento/salvar', 		['uses'=>'Backend\GatilhosController@adiamentosalvar',     	'as'=>'backend.gatilhos.projeto.adiamento'	]);

	/************************** Gatilhos **************************/

	/************************** Eventos Calendário **************************/
		Route::get('/backend/eventos/', 					['uses'=>'Backend\EventoController@index',     					'as'=>'backend.evento'				]);
		Route::get('/backend/eventos/usuario/{id_usuario}', ['uses'=>'Backend\EventoController@individual',     			'as'=>'backend.evento.individual'	]);
		Route::post('/backend/eventos/salvar', 				['uses'=>'Backend\EventoController@salvar',    					'as'=>'backend.evento.salvar'		]);
		Route::post('/backend/eventos/salvarTarefa', 		['uses'=>'Backend\EventoController@salvarEventoTarefa',    		'as'=>'backend.evento.salvarTarefa'	]);

		Route::post('/backend/eventos/atualizar', 			['uses'=>'Backend\EventoController@atualizar', 			'as'=>'backend.evento.atualizar']);
		Route::get('/backend/eventos/deletar/{id}',			['uses'=>'Backend\EventoController@deletar',   			'as'=>'backend.evento.deletar']);
		Route::post('/backend/eventos/visualizar', 			['uses'=>'Backend\EventoController@visualizar',    		'as'=>'backend.evento.visualizar']);
		Route::post('/backend/eventos/visualizarGatilho', 	['uses'=>'Backend\EventoController@visualizarGatilho',  'as'=>'backend.evento.visualizarGatilho']);
	/************************** Fim Eventos Calendário **************************/

	/************************** Ficha Comercial **************************/
		Route::get('/backend/ficha-comercial/',				['uses'=>'Backend\FichaComercialController@index',	'as'=>'backend.fichacomercial'				]);
		// Passo a Passo dos formulários
		Route::post('/backend/ficha-comercial/formPasso1', 	['uses'=>'Backend\FichaComercialController@form1',  'as'=>'backend.fichacomercial.form.passo1'	]);
		Route::post('/backend/ficha-comercial/formPasso2', 	['uses'=>'Backend\FichaComercialController@form2',  'as'=>'backend.fichacomercial.form.passo2'	]);
		Route::post('/backend/ficha-comercial/formPasso3', 	['uses'=>'Backend\FichaComercialController@form3',  'as'=>'backend.fichacomercial.form.passo3'	]);
	/************************** Fim Ficha Comercial **************************/
    /*****************Pautas */
		//Route::get('/backend/pautas/cron', 'Backend\ToDoListController@fnPautasCron')->name('backend.pautas.cron');
	    Route::get('/backend/pautas/', 'Backend\ToDoListController@index')->name('backend.pauta.index');
        Route::post('/backend/pautas/', 'Backend\ToDoListController@index')->name('backend.pauta.index');
        Route::post('/backend/pauta/salvar', 'Backend\ToDoListController@salvar')->name('backend.pauta.salvar');
        Route::get('/backend/pauta/finalizar/{id}', 'Backend\ToDoListController@finalizar')->name('backend.pauta.finalizar');
        Route::post('/backend/pautas/registrar-observacao', 'Backend\ToDoListController@registrarProjeto')->name('backend.pauta.registrar-projeto');
	/*****************Datas comemorativas */
	    Route::post('/backend/data-comemorativa/salvar', 'Backend\DataComemorativaController@salvar')->name('backend.data-comemorativa.salvar');
		Route::get('/backend/data-comemorativa/{mes}', 'Backend\DataComemorativaController@fnRetornaDatasComemorativas')->name('backend.data-comemorativa.mes.listar');

		/******************************GUT - Matriz de Prioridade **********/
		    Route::get('/backend/tarefas/gut/{idequipe}', 'Backend\GUTController@index')->name('backend.tarefas.gut.index');
		    Route::get('/backend/tarefas/gut/{idequipe}/filtro', 'Backend\GUTController@listarTarefas')->name('backend.tarefas.gut.filtro');
		    Route::post('/backend/tarefas/gut/salvar/pontuacao', 'Backend\GUTController@salvarPontuacao')->name('backend.tarefas.gut.salvar.pontuacao');

		Route::get('/backend/mailable', function () {
			$equipe = User::where('setor', 1)->where('ativo', 1)->where('id', '!=', 3)->get();
			$arrEquipe = $equipe->pluck('name');
			$arrEquipe->all();
			//dd($arrEquipe);

			return new App\Mail\NovoUsuario('Bem-vindo', 'Marcelinho', $arrEquipe, 'marcelo@logicadigital.com.br', 'mcardoso');
		});

		Route::get('/backend/conta-azul/authorize', 'Backend\ContaAzulController@fnAutorizarAplicacao')->name('backend.contaazul.authorize');
		Route::post('/backend/conta-azul/authorize', 'Backend\ContaAzulController@fnAutorizarAplicacao')->name('backend.contaazul.authorize');
		Route::get('/backend/conta-azul/outh-autentication', 'Backend\ContaAzulController@outh')->name('backend.contaazul.outh');
		Route::post('/backend/conta-azul/outh-autentication', 'Backend\ContaAzulController@outh')->name('backend.contaazul.outh');
        Route::get('/backend/conta-azul/clientes', 'Backend\ContaAzulController@clientes')->name('backend.contaazul.clientes');
        Route::get('/backend/conta-azul/vendas', 'Backend\ContaAzulController@vendas')->name('backend.contaazul.vendas');
        Route::get('/backend/conta-azul/atualizaParcela', 'Backend\ContaAzulController@atualizaParcela')->name('backend.contaazul.atualiza-parcela');
        Route::get('/backend/conta-azul/atualizaStatus', 'Backend\ContaAzulController@atualizaStatus')->name('backend.contaazul.atualiza-status');
        Route::get('/backend/conta-azul/relatorio', 'Backend\ContaAzulController@index')->name('backend.contaazul.relatorio');
        Route::get('/backend/conta-azul/devedores', 'Backend\ContaAzulController@fnListaDevedores')->name('backend.contaazul.devedores');
        Route::get('/backend/conta-azul/pdf', 'Backend\ContaAzulController@getPDF')->name('backend.contaazul.pdf');
});
