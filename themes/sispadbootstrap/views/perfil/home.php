<?php
$this->pageTitle = Yii::app()->name . ' - Perfil';
$this->breadcrumbs = array(
    'Perfil',
);
?>
<div class="fast-menu row">
    <div class="span1">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('producaoDiaria/send') ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/production-icon.png" />
            <p class="fast-menu-description">Enviar Produção diária</p>
        </a>
    </div>
    <div class="span1">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('profissionalVinculo/create') ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/professional-icon.png" />
            <p class="fast-menu-description">Vincular Profissional</p>
        </a>
    </div>
    <div class="span1">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('producaoDiaria/adminGestor') ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/report-icon.png" />
            <p class="fast-menu-description">Consultar Produção Diária</p>
        </a>
    </div>
    <div class="span1">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('producaoDiaria/admin') ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/history-icon.png" />
            <p class="fast-menu-description">Consultar Produção Diária</p>
        </a>
    </div>
</div>