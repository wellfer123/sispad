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
    
    public static $TIPOS_RELATORIOS= array('RelatoriolUnidadeProcedimento'=>'Unidade/Procedimento',
                                  'RelatoriolUnidadeProfissional'=>'Unidade/Profissional',
                                  'RelatoriolUnidadeProfissionalProcedimento'=>'Unidade/Profissional/Procedimento',
                                  'RelatorioUnidadeTotal'=>'Unidade Total',
                                  );
    public static $DE_ATRIBUTO_PARA_PARAMETRO= array('relatorio'=>'jkwf8923r8923nh9hiwqehnd',
                                                     'unidade_cnes'=>'wkdn23je9329032900932',
                                                     'profissional_cns'=>'weioewi2438u8aiujnui',
                                                     'competencia_movimento'=>'934uehf784y37823e',
                                                      'profissional_cbo'=>'921ij32io09wAINVHBDSO'
                                                    );
    public $relatorio;
    public $data_inicial;
    public $data_final;
    
    public $unidade_cnes;
    public $profissional_cns;
    public $profissional_cbo;
    public $equipe;
    public $competencia;
    public $folha;
    
    public $paciente_cns;
    public $paciente_nome;
    public $paciente_sexo;
    public $paciente_data_nascimento;
    public $paciente_cidade;
    public $paciente_nacionalidade;
    public $paciente_raca;
    public $paciente_etnia;
    
    public $data_atendimento;
    public $procedimento;
    public $cid;
    public $carater_atendimento;
    public $servico;
    public $classificacao_servico;
    public $sequencia;
    public $competencia_movimento;
    
    
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
                    'data_atendimento'=>'Data de Atendimento',
                    'procedimento_codigo'=>'Procedimento Ambulatorial',
                    'cid'=>'CID',
                    'carater_atendimento'=>'Caráter de Atendimento',
                    'servico'=>'Serviço',
                    'classificacao_servico'=>'Classificação do serviço',
                    'sequencia'=>'Sequência',
                    'competencia_movimento'=>'Competência Movimento'
        );
    }

}

?>
