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
                        'link'=>Yii::app()->createAbsoluteUrl('producaoDiaria/send'),
                        'image'=>'images/production.png',
                        'title'=>'Enviar Produção Diária',
                    ),
                    array(
                        'link'=>Yii::app()->createAbsoluteUrl('profissionalvinculo/create'),
                        'image'=>'images/add2.png',
                        'title'=>'Vincular Profissional',
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