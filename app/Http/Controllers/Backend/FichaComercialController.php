<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Segmento;
use App\TipoProjeto;
use App\FichaComercial;
use App\FichaComercialContatos;
use App\Http\Requests\FichaComercialContatoFormRequest;
use App\Http\Requests\FichaComercialFormRequest;
use Illuminate\Support\Facades\Auth;

class FichaComercialController extends Controller{

    public function index(){
        $segmentos = Segmento::all();
        $tipo_projetos = TipoProjeto::all();
        return view('backend.fichacomercial.index', compact('segmentos', 'tipo_projetos'));
    }

    /* Passo a Passo dos Formulários */
    public function form1(FichaComercialFormRequest $request){
        $dados          = $request->all();
        $fichacomercial = new FichaComercial();

        $fichacomercial->quem_vendeu            = Auth::id();
        $fichacomercial->razao_social           = $dados['razao_social'];
        $fichacomercial->nome_fantasia          = $dados['nome_fantasia'];
        $fichacomercial->segmento_empresa       = $dados['segmento_empresa'];
        $fichacomercial->cnpj_cpf               = $dados['cnpj_cpf'];
        $fichacomercial->inscricao_estadual     = $dados['inscricao_estadual'];
        $fichacomercial->dia_boleto             = $dados['dia_boleto'];
        $fichacomercial->observacao_boleto      = $dados['observacao_boleto'];
        $fichacomercial->nota_fiscal            = $dados['nota_fiscal'];

        // Endereço
        $fichacomercial->cep                    = $dados['cep'];
        $fichacomercial->endereco               = $dados['endereco'];
        $fichacomercial->bairro                 = $dados['bairro'];
        $fichacomercial->cidade                 = $dados['cidade'];
        $fichacomercial->estado                 = $dados['estado'];
        $fichacomercial->numero                 = $dados['numero'];
        $fichacomercial->complemento            = $dados['complemento'];

        $fichacomercial->save();

        return response()->json($fichacomercial);
    }

    /* Passo a Passo dos Formulários */
    public function form2(FichaComercialContatoFormRequest $request){
        $dados          = $request->all();
        $perfil    = implode(",", $dados['perfilcliente']);

        $contato = new FichaComercialContatos();
        $contato->id_ficha_comercial = $dados['id_ficha_comercial'];
        $contato->nome = $dados['nome_cliente'];
        $contato->cargo = $dados['cargo_cliente'];
        $contato->tipo_contato = $dados['tipo_contato'];
        $contato->telefone = $dados['telefone_cliente'];
        $contato->celular = $dados['celular'];
        $contato->email = $dados['email'];
        $contato->perfil = $perfil;
        $contato->save();
        //dd($dados);

        return response()->json($contato);

    }

    /* Passo a Passo dos Formulários */
    public function form3(Request $request){
        $dados          = $request->all();
        dd($dados);
        for($i = 0; $i < $dados['numeros_projeto']; $i++){
            DB::table('tb_ficha_comercial_projetos')
                        ->insert([
                            'id_ficha_comercial'        =>  $dados['id_ficha_comercial'         ],
                            'id_tipo_projeto'           =>  $dados['tipo_projeto_'.$i.''        ],
                            'data_contrato'             =>  $dados['fechamento_contrato_'.$i.'' ],
                            'prazo'                     =>  $dados['prazo_projeto_'.$i.''       ],
                            'tipo_manutenco'            =>  $dados['tipo_manutencao_'.$i.''     ],
                            'conteudo'                  =>  $dados['conteudo_site_'.$i.''       ],
                            'idiomas'                   =>  $dados['idiomas_'.$i.''             ],
                            'ssl_cdn'                   =>  $dados['ssl-cdn_'.$i.''             ],
                            'itens_menu'                =>  $dados['itens_menu_'.$i.''          ],
                            'itens_pagina_principal'    =>  $dados['itens_pp_'.$i.''            ],

                            // Slider
                            'slider_pagina_principal'   =>  $dados['slider_pp_'.$i.''                   ],
                            'slider_nos_desenvolver'    =>  $dados['slider_nos_desenvolvemos_'.$i.''    ],
                            'slider_quantidade'         =>  $dados['slider_qtd_'.$i.''                  ],
                            'slider_feito_uma_vez'      =>  $dados['slider_vezes_'.$i.''                ],
                            'slider_periocidade'        =>  $dados['slider_periodicidade_'.$i.''        ],
                            'slider_observacao'         =>  $dados['slider_observacao_'.$i.''           ],

                            // Domínio
                            'domino_nome'               =>  $dados['dominio_principal_'.$i.''           ],
                            'dominio_registrado'        =>  $dados['dominio_registrado_'.$i.''          ],
                            'dominio_criacao_migracao'  =>  $dados['dominio_criacao_migracao_'.$i.''    ],
                            'dominio_momento_execucao'  =>  $dados['dominio_executar_'.$i.''            ],
                            'dominio_email'             =>  $dados['dominio_email_'.$i.''               ],
                            'dominio_observacao'        =>  $dados['dominio_observacao_'.$i.''          ],

                            // Redirects
                            'redirects_havera'          =>  $dados['dominio_registrado_'.$i.''      ],
                            'redirects_quais'           =>  $dados['redirect_direcao_'.$i.''        ],
                            'redirects_observacao'      =>  $dados['redirect_observacao_'.$i.''     ],

                            // Marketing
                            'marketing_data_inicio'      =>  $dados['fechamento_contrato_marketing_'.$i.''    ],
                            'marketing_investimento'     =>  $dados['investimento_marketing_'.$i.''         ],
                            'marketing_quantidade'       =>  $dados['numero-post-marketing_'.$i.''          ],
                        ]);

            }
    }

}
