<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/perfil.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rbac.css" />
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

        
        <div id="mainmenu2">
                <?php
                    //instancia do RBAC para verificação de acesso ao menu
                    $RBAC2=new RBACAccessVerifier();
                    $this->widget('application.extensions.menu.SMenu',
array(
"menu"=>array(
          //menu raiz
          array("url"=>array("route"=>"/"), "label"=>"Início"),
          array("url"=>array(),
                       "label"=>"Relatório",
                       array("url"=>array("route"=>"/Relatorio/create"),"label"=>"Enviar Meu Relatório"),
                       array("url"=>array("route"=>"/TotalRelatorio/create"),"label"=>"Enviar Quantidade"),
                       array("url"=>array("route"=>"/TotalRelatorio/list"),"label"=>"Total de Relatórios (Meus)"),
                       
              ),
          array("url"=>array(),
                       "label"=>"Frequência",
                       array("url"=>array("route"=>"/TotalFrequencia/create"),"label"=>"Enviar"),
                       array("url"=>array("route"=>"/TotalFrequencia/list"),"label"=>"Total de Frequências (Minhas)")
              ),
          array("url"=>array(),
                            "label"=>"Cadastro",
                      array("url"=>array("route"=>"/departamento/index"), "label"=>"Departamento"),
                      array("url"=>array("route"=>"/Setor/index"), "label"=>"Setor"),
                      array("url"=>array("route"=>"/Servidor/index"), "label"=>"Servidor"),
                      array("url"=>array("route"=>"/Unidade/index"), "label"=>"Unidade"),
                      'visible'=>$RBAC2->checkAccess('SuperAdmin'),
              ),
          array("url"=>array(),
                            "label"=>"Administração",
                      array("url"=>array("route"=>"/user/admin"), "label"=>"Usuário"),
                      array("url"=>array("route"=>"/rbac/assignment"), "label"=>"Permissões"),
                      'visible'=>$RBAC2->checkAccess('SuperAdmin'),
                      
              ),
          array("url"=>array(),
                            "label"=>"indicadores",
                       array("url"=>array("route"=>"/indicador/create"), "label"=>"cadastro Indicador"),
                      array("url"=>array("route"=>"/item/create"), "label"=>"cadastro Itens"),
                      array("url"=>array("route"=>"/meta/create"), "label"=>"cadastro Metas"),
                      //array("url"=>array("route"=>"/rbac/assignment"), "label"=>"Permissões"),
                      //'visible'=>$RBAC2->checkAccess('SuperAdmin'),

              ),
          //menu raiz
          array("url"=>array(), "label"=>"Ajuda",
                        array("url"=>array("route"=>"/site/page/about", "view"=>"about"), "label"=>"Sobre"),
                        array("url"=>array("route"=>"/site/contact"), "label"=>"Contato")),
          array("url"=>array("route"=>"user/login"), "label"=>"Entrar","visible"=>Yii::app()->user->isGuest),
          array("url"=>array("route"=>"user/logout"), "label"=>'Sair ('.Yii::app()->user->name.')',"visible"=>!Yii::app()->user->isGuest),

          ),
"stylesheet"=>"menudropdown.css",//Yii::app()->request->baseUrl.'/css/menudropdown.css'
"menuID"=>"myMenu",
"delay"=>3
)
);
                ?>
        <p></p>
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Sobre', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contato', 'url'=>array('/site/contact')),
				array('label'=>'Entrar', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Sair ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */?>
       </div> <!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> da Prefeitura Municipal de Caruaru.<br/>
		Todos os Direitos Reservados.<br/>
		Powered por Setor de Tecnologia da Informação - Secretaria de Saúde.
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
