<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span9">
        <?php echo $content; ?>
    </div>
    <div class="span3">
        <h3>Operações</h3>
        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs',
            'stacked' => true,
            'tabs' => $this->menu,
        ));
        ?>
    </div>
</div>
<?php $this->endContent(); ?>