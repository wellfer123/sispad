<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-especialidade-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'grupo_codigo',
                    'value'=>'$data->grupo->nome'
                ),
                array(
                    'name'=>'profissao_codigo',
                    'value'=>'$data->especialidade->nome'
                ),
                array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                                'view'=>array(
                                                'visible'=>'false',
                                ),
                                'update'=>array(
                                                'visible'=>'false',
                                ),
                                'delete'=>array(
                                                'visible'=>'false',
                                                'url'=> 'Yii::app()->createUrl("producaoDiaria/delete",
                                                        array("especialidade"=>$data->profissao_codigo,"unidade"=>$data->unidade_cnes))',
                                ),
                        )
		),
	),
)); ?>
