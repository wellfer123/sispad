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
                <div id="logo"><?php //echo CHtml::encode(Yii::app()->name);  ?></div>
            </div><!-- header -->


            <div id="mainmenu2">
                <?php
                //instancia do RBAC para verificação de acesso ao menu
                $RBAC2 = new RBACAccessVerifier();
                //SOMENTE O SUPER ADMINISTRADOR PODE VER O MENU COMPLETO
                $visible = $RBAC2->checkAccess('SuperAdmin');
                
              
                //$roles = $this->getState("roles");
                 $gestor_visible= false;
                 $roles =  Yii::app()->user->getState(UserIdentity::ROLES);
                 if($roles!=null){
                    foreach($roles as $n=>$role)
                    {
                            if($n==UserIdentity::ROLE_GESTOR){
                                $gestor_visible = true;

                            }
                    }
                 }
                $menuGestor=array();
                
                    //$servidor=$this->getServidor();
                    $menuGestor=array("url" => array(),
                            "label" => "Gestor",
                            array("url" => array("route" => "/producaoDiaria/send"), "label" => "Enviar Produção Diária"),
                            array("url" => array("route" => "/producaoDiaria/adminGestor"), "label" => "Consultar Histórico"),
                            array("url" => array("route" => "/profissionalVinculo/create"), "label" => "Vincular Profissional"),
                            'visible' =>$gestor_visible,
                    );
                
                $this->widget('application.extensions.menu.SMenu', array(
                    "menu" => array(
                        //menu raiz
                        array("url" => array("route" => "/"), "label" => "Início"),
                        array("url" => array(),
                            "label" => "Relatório",
                            array("url" => array("route" => "/Relatorio/create"), "label" => "Enviar Meu Relatório"),
                            array("url" => array("route" => "/TotalRelatorio/create"), "label" => "Enviar Quantidade"),
                            array("url" => array("route" => "/TotalRelatorio/list"), "label" => "Total de Relatórios (Meus)"),
                            'visible' => $visible,
                        ),
                        $menuGestor,
                        array("url" => array(),
                            "label" => "Faltas",
                            array("url" => array("route" => "/Falta/preparedCreate"), "label" => "Enviar"),
                            array("url" => array("route" => "/Falta/preparedViewDetail"), "label" => "Relatorio Detalhado"),
                            array("url" => array("route" => "/Falta/preparedViewMonth"), "label" => "Relatorio Mensal"),
                            'visible' => $visible,
                        ),
                        array("url" => array(),
                            "label" => "Cadastro",
                            array("url" => array("route" => "/cargo/create"), "label" => "Cargo"),
                            array("url" => array("route" => "/competencia/create"), "label" => "Competências"),
                            array("url" => array("route" => "/departamento/create"), "label" => "Departamento"),
                            array("url" => array("route" => "/Setor/create"), "label" => "Setor"),
                            array("url" => array("route" => "/Servidor/create"), "label" => "Servidor"),
                            array("url" => array("route" => "/unidadeGestor/create"), "label" => "Gestor de Unidade"),
                            array("url" => array("route" => "/Unidade/create"), "label" => "Unidade"),
                            array("url" => array("route" => "/metas/indicador/create"), "label" => "Indicador"),
                            array("url" => array("route" => "/metas/equipe/create"), "label" => "Equipe"),
                            'visible' => $visible,
                        ),
                        array("url" => array(),
                            "label" => "Administração",
                            array("url" => array("route" => "/cargo/admin"), "label" => "Cargo"),
                            array("url" => array("route" => "/competencia/admin"), "label" => "Competências"),
                            array("url" => array("route" => "/user/admin"), "label" => "Usuário"),
                            array("url" => array("route" => "/rbac/assignment"), "label" => "Permissões"),
                            array("url" => array("route" => "/metas/indicador/admin"), "label" => "Indicadores"),
                            array("url" => array("route" => "/metas/equipe/admin"), "label" => "Equipes"),
                            array("url" => array("route" => "/producaoDiaria/adminSuper"), "label" => "Produção Diária"),
                            array("url" => array("route" => "/profissionalVinculo/admin"), "label" => "Vínculo do Servidor"),
                            array("url" => array("route" => ""), "label" => "Metas Executadas",
                                array("url" => array("route" => "/metas/medicoExecutaMeta/admin"), "label" => "Executadas por Médico"),
                                array("url" => array("route" => "/metas/enfermeiroExecutaMeta/admin"), "label" => "Enfermeiro"),
                                array("url" => array("route" => "/metas/odontologoExecutaMeta/admin"), "label" => "Odontologo"),
                                array("url" => array("route" => "/metas/agenteSaudeExecutaMeta/admin"), "label" => "Agente de Saúde"),
                            ),
                            array("url" => array("route" => ""), "label" => "Metas",
                                array("url" => array("route" => "/metas/meta/calculo"), "label" => "Lançamento"),
                            ),
                            array("url" => array("route" => "relatorio/admin"), "label" => "Relatórios"),
                            array("url" => array("route" => "totalRelatorio/admin"), "label" => "Quantidade de Relatórios"),
                            'visible' => $visible,
                        ),
                        //menu raiz
                        array("url" => array(),
                            "label" => "Ajuda",
                            array("url" => array("route" => "/site/page/about", "view" => "about"), "label" => "Sobre"),
                            array("url" => array("route" => "/site/contact"), "label" => "Contato")),
                        array("url" => array("route" => "user/login"), "label" => "Entrar", "visible" => Yii::app()->user->isGuest),
                        array("url" => array("route" => "user/logout"), "label" => 'Sair (' . Yii::app()->user->name . ')', "visible" => !Yii::app()->user->isGuest),
                    ),
                    "stylesheet" => "menudropdown.css", //Yii::app()->request->baseUrl.'/css/menudropdown.css'
                    "menuID" => "myMenu",
                    "delay" => 3
                        )
                );
                ?>
                <p></p>
                <?php /* $this->widget('zii.widgets.CMenu',array(
                  'items'=>array(
                  array('label'=>'Home', 'url'=>array('/site/index')),
                  array('label'=>'Sobre', 'url'=>array('/site/page', 'view'=>'about')),
                  array('label'=>'Contato', 'url'=>array('/site/contact')),
                  array('label'=>'Entrar', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                  array('label'=>'Sair ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                  ),
                  )); */ ?>
            </div> <!-- mainmenu -->
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
            <?php endif ?>

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
