<?php

return array(
	
	'indMedico'=>array(
		'nome' => 'Indicador de médico',
		'descricao' => 'serve para qualquer médico',
		'profissao_codigo' => Medico::CODIGO_PROFISSAO,
		'status' => Indicador::ATIVO,
		'afericao' =>'',
	),
	'indEnfermeiro'=>array(
		'nome' => 'Indicador de enfermeiro',
		'descricao' => 'qualquer enfermeiro vai ter esse indicador',
		'profissao_codigo' => Enfermeiro::CODIGO_PROFISSAO,
		'status' => Indicador::ATIVO,
		'afericao' => '',
	),
        'indOdontologo'=>array(
		'nome' => 'Indicador de Odontólogo',
		'descricao' => 'serve para qualquer odontólogo',
		'profissao_codigo' => Odontologo::CODIGO_PROFISSAO,
		'status' => Indicador::ATIVO,
		'afericao' =>'',
	),
	'indAgenteSaude'=>array(
		'nome' => 'Indicador de Agente de saúde',
		'descricao' => 'serve para qualquer agente de saúde',
		'profissao_codigo' => AgenteSaude::CODIGO_PROFISSAO,
		'status' => Indicador::ATIVO,
		'afericao' => '',
	),
	
);
