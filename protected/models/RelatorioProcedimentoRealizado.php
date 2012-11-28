<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RelatorioProcedimentoRealizado
 *
 * @author Albuquerque
 */
class RelatorioProcedimentoRealizado extends CFormModel{
    //put your code here
    
    //mapeamento para cada relatório
    public static $TIPOS_RELATORIOS= array('RelatoriolUnidadeProcedimento'=>'Unidade/Procedimento',
                                  'RelatoriolUnidadeProfissional'=>'Unidade/Profissional',
                                  'RelatoriolUnidadeProfissionalProcedimento'=>'Unidade/Profissional/Procedimento',
                                  'RelatorioUnidadeTotal'=>'Unidade Total',
                                  );
    //CARATERS DE ATENDIMENTOS
    public static $CARATER_ATENDIMENTO = array(
                                                '00'=>'SEM INFORMAÇÃO',
                                                '01'=>'ELETIVO',
                                                '02'=>'URGÊNCIA',
                                                '03'=>'ACIDENTE NO LOCAL DE TRABALHO OU A SERVIÇO DA EMPRESA',
                                                '04'=>'ACIDENTE NO TRAJETO PARA O TRABALHO',
                                                '05'=>'OUTROS TIPOS DE ACIDENTES DE TRÂNSITO',
                                                '06'=>'OUTROS TIPOS DE LESÕES E EVENENAMENTO POR AGENTES QUÍMICOS OU FÍSICOS'
    );
    
    //RAÇA/COR
    public static $RACA_COR = array(
                                    '01'=>'BRANCA',
                                    '02'=>'PRETA',
                                    '03'=>'PARDA',
                                    '04'=>'AMARELA',
                                    '05'=>'INDÍGENA',
                                    '99'=>'SEM INFORMAÇÃO'
    );
    //mapeamento para cada parâmetro do relatório
    public static $DE_ATRIBUTO_PARA_PARAMETRO= array('relatorio'=>'jkwf8923r8923nh9hiwqehnd',
                                                     'unidade_cnes'=>'wkdn23je9329032900932',
                                                     'profissional_cns'=>'weioewi2438u8aiujnui',
                                                     'competencia_movimento'=>'934uehf784y37823e',
                                                      'profissional_cbo'=>'921ij32io09wAINVHBDSO',
                                                      'equipe'=>'jkwqnd38u38ugyfr56uhc78yd',
                                                      'competencia'=>'35u90wnd7BVYGFQEG74',
                                                      'folha'=>'93i432jeq8f8qf89ADJI3',
                                                      'paciente_cns'=>'[]aokoweo93e9937487qwg',
                                                      'paciente_nome'=>'kwemijiojew932490kifi',
                                                      'paciente_sexo'=>'kfioewrfiji34i3kio',
                                                      'paciente_data_nascimento'=>'LKASCJNJXZC89Y34',
                                                      'paciente_cidade'=>'jkwnv89wqf883r',
                                                      'paciente_raca'=>'9mqjnui2eh82',
                                                      'paciente_etnia'=>'jnaiofi93489034nfwqj',
                                                      'data_atendimento'=>'nkjd8234bnfb823hd',
                                                      'procedimento'=>'903nsag873rbqbucw',
                                                      'cid'=>'9jkdfn89213n8923njsdj',
                                                      'carater_atendimento'=>'092i13nq8u9hff38',
                                                      'servico'=>'09dqjn8234hn89sdio',
                                                      'classificacao_servico'=>'923noaf0932rkdkw',
                                                      'sequencia'=>'93unhf8934ruisudh',
                                                      'competencia_movimento'=>'9i329dfqwjnui238',
                                                      'data_inicial'=>'398u32nw8932jkwfdf',
                                                      'data_final'=>'okcsdk832nfdnwek',
                                                      'paciente_id'=>'3unadfq78bf784r',
                                                      'equipe_area'=>'jrna8489we3282dwe',
                                                      'equipe_sequencia'=>'324nfh8348cfy436f',
                                                      'paciente_idade'=>'kc98u23dn389rh383',
                                                      'origem'=>'93248nvcq7ghDJKDF',
                                                      'cnpj'=>'pk349fqier3490FJKNS',
                                                      'numero_autorizacao'=>'93chqe756dgwe65zxc83'
                                                    );
    
    
    //parametros adicionais
    public $relatorio;
    public $data_inicial;
    public $data_final;
    
    //cabeçalho do procedimento realizado
    public $unidade_cnes;
    public $profissional_cns;
    public $profissional_cbo;
    public $equipe;
    public $equipe_area;
    public $equipe_sequencia;
    public $competencia;
    public $folha;
    
    //dados referente ao paciente
    public $paciente_cns;
    public $paciente_nome;
    public $paciente_sexo;
    public $paciente_data_nascimento;
    public $paciente_cidade;
    public $paciente_nacionalidade;
    public $paciente_raca;
    public $paciente_etnia;
    public $paciente_id;
    public $paciente_idade;
    
    //dados procedimento
    public $data_atendimento;
    public $procedimento;
    public $cid;
    public $carater_atendimento;
    public $servico;
    public $classificacao_servico;
    public $sequencia;
    public $competencia_movimento;
    public $numero_autorizacao;
    public $origem;
    public $cnpj;
    
    
    public function rules() {
        return array(
                        array('unidade_cnes, relatorio', 'required'),
                        array('profissional_cbo, profissional_cns', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
                    'relatorio'=>'Tipo de relatório',
                    'data_inicial'=>'Data inicial de atendimento',
                    'data_final'=>'Data final de atendimento',
                    'profissional_cns'=>'CNS do Profissional',
                    'profissional_cbo'=>'CBO do profissional',
                    'equipe'=>'Equipe',
                    'equipe_area'=>'Área da Equipe',
                    'equipe_sequencia'=>'Sequência da Equipe',
                    'competencia'=>'Competência',
                    'folha'=>'Folha',
                    'paciente_cns'=>'CNS do Paciente',
                    'paciente_nome'=>'Nome do Paciente',
                    'paciente_sexo'=>'Sexo do Paciente',
                    'pacinete_data_nascimento'=>'Data de Nascimento do Paciente',
                    'paciente_cidade'=>'Cidade do Paciente',
                    'paciente_nacionalidade'=>'Nacionalidade do Paciente',
                    'paciente_etnia'=>'Etnia do Paciente',
                    'paciente_raca'=>'Raça do Paciente',
                    'paciente_idade'=>'Idade do Paciente',
                    'paciente_id'=>'Id do Paciente',
                    'data_atendimento'=>'Data de Atendimento',
                    'procedimento_codigo'=>'Procedimento Ambulatorial',
                    'cid'=>'CID',
                    'carater_atendimento'=>'Caráter de Atendimento',
                    'servico'=>'Serviço',
                    'classificacao_servico'=>'Classificação do serviço',
                    'sequencia'=>'Sequência',
                    'competencia_movimento'=>'Competência Movimento',
                    'numero_autorizacao'=>'Número de Autorização',
                    'cnpj'=>'CNPJ',
                    'origem'=>'Origem'
        );
    }

}

?>
