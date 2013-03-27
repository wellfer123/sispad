<?php
$this->pageTitle=Yii::app()->name . ' - Home';
$this->breadcrumbs=array(
	'Perfil',
);


?>

<?php  $this->widget('ext.jnterface.fisheye',
            array(
                'name'=>'fish',
                'menu'=>array(
                    array(
                        'link'=>Yii::app()->createAbsoluteUrl('producaoDiaria/create'),
                        'image'=>'images/production.png',
                        'title'=>'Enviar Produção Diária',
                    ),
                    array(
                        'link'=>Yii::app()->createAbsoluteUrl('unidadeEspecialidade/add',array('unidade'=> isset($this->model->unidade) ? $this->model->unidade->cnes : 0)),
                        'image'=>'images/hospital.png',
                        'title'=>'Adicionar Especialidade a Unidade',
                    ),
                    array(
                        'link'=>Yii::app()->createAbsoluteUrl('producaoDiaria/adminGestor'),
                        'image'=>'images/report.png',
                        'title'=>'Consultar Produção Diária',
                    ),
                    array(
                        'link'=>Yii::app()->createAbsoluteUrl('producaoDiaria/admin'),
                        'image'=>'images/history.png',
                        'title'=>'Histórico da Produção Diária',
                    ),
                ),
            )); ?>
<!-- form -->