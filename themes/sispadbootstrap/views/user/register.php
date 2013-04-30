<?php
$this->breadcrumbs = array(
    'Usuários' => array('index'),
    'Registro',
);
?>

<div class="well">
    <h2 class="page-title">Login</h2>
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>


