<?php
$this->breadcrumbs = array(
    'Registro',
);
?>
<div class="well page-content">
    <h2 class="page-title">Registro de Usuário</h2>
    <?php echo $this->renderPartial('_form_frontend', array('model' => $model)); ?>
</div>