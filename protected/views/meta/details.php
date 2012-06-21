
<?php $this->breadcrumbs=array(
         'Indicador'=>array('indicador/admin'),
	 'Metas'=>array('meta/view','indicador_id'=>$_GET['indicador_id']),
         $model->nome
);
?>
<div class="update">
<h2>Meta: <?php echo $model->nome; ?> </h2>

</div>
<?php 
   // $labelEndereco=$model->endereco:null?'Cadastrar' :'Endereco';

        $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'valor',
               array('label'=>'Percentagem',
                      'value'=>$model->percentagem.'%'),
                array('label'=>'Periodicidade',
                      'value'=>$model->periodicidade->nome),
                array('label'=>'Tipo',
                      'value'=>$model->tipo($model->tipo)),
           
               
	),
)); ?>
