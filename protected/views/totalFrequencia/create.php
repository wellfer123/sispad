<?php
$this->breadcrumbs=array(
	'Frequências'=>array('index'),
	'Envio',
);

$this->menu=array(
	array('label'=>'Gerenciamento de Frequências', 'url'=>array('admin')),
);


 
$this->widget('ext.htmlTableui.htmlTableUi',array(
    'ajaxUrl'=>'Servidor/testepost',
    'arProvider'=>'',    
    'collapsed'=>false,
    'columns'=>Servidor::model()->attributes,
    'cssFile'=>'',
    'editable'=>true,
    'enableSort'=>true,
    'exportUrl'=>'site/exportCsv',
    'extra'=>'Additional Information',
    'footer'=>'Total rows: '.count($rowsArray).' By: José Rullán',
    'formTitle'=>'Form Title',
    'rows'=>Servidor::model()->findAll(),
    'sortColumn'=>1,
    'sortOrder'=>'desc',
    'subtitle'=>'Rev 1.3.3',
    'title'=>'Table 2',
    'useInternalCss'=>true,
));
?>
<div class="form">
<h1>Envio de Frequência</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>