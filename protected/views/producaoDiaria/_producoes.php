
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producao-diaria-grid',
	'dataProvider'=>$model->getMaisRecente(),
	'columns'=>array(
                array(
                    'header'=>'Unidade',
                    'value'=>'$data->unidade->nome',
                ),
                array(
                    'name'=>'profissao_codigo',
                    'value'=>'$data->especialidade->nome',
                ),
                array(
                    'filter'=>false,
                    'name'=>'quantidade',
                    'value'=>'$data->quantidade'
                ),
                array(
                    'filter'=>false,
                    'header'=>'Profissional',
                    'value'=>'$data->profissional->nome'
                ),
                array(
                    'name'=>'data',
                    'value'=>'ParserDate::inverteDataEnToPt($data->data)',
                ),
	),
)); ?>
