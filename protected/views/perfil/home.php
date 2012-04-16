<?php
$this->pageTitle=Yii::app()->name . ' - Home';
$this->breadcrumbs=array(
	'Home',
);


?>

<!--<h1>Perfil do usuário</h1>-->
<?php echo $this->renderPartial('_notification'); ?>
<?php echo $this->renderPartial('_menuAdmin'); ?>
<?php echo $this->renderPartial('_menuCreate'); ?>
<!-- form -->