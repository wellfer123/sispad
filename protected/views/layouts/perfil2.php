<?php $this->beginContent('//layouts/main'); ?>


<div class="span-content_perfil">
	<div id="content_perfil">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-inf_perfil">
	<div id="sidebar_perfil">
	<?php
                $unidade= null;
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Perfil',
                        'htmlOptions'=>array('class'=>'portlet_perfil')
		));

                   $this->widget('zii.widgets.CDetailView', array(
                        'data'=>$this->model,
                        'cssFile' => Yii::app()->theme->baseUrl .'/css/details_perfil.css',
                        'attributes'=>array(
                            'nome',
                            'matricula',
                            'cpf',
                           
                        ),
                    ));
              


		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>