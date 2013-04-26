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
                <div id="logo"><?php //echo CHtml::encode(Yii::app()->name);    ?></div>
            </div><!-- header -->


            <div id="mainmenu2">
                <?php
                //SOMENTE O SUPER ADMINISTRADOR PODE VER O MENU COMPLETO
                $admin_visible = false;
                $gestor_visible = false;
                $gerencia_unidade_visible = false;
                //pega todos os papeis daquele profissional
                $roles = Yii::app()->user->getState(UserIdentity::ROLES);
                if ($roles != null) {
                    foreach ($roles as $n => $role) {
                        //verifica os papéis que o usuário possui e exibi os menus
                        if ($n == UserIdentity::GERENTE_UNIDADE) {
                            $gerencia_unidade_visible = true;
                        } elseif ($n == UserIdentity::ADMIN) {
                            $admin_visible = true;
                        } elseif ($n == UserIdentity::GESTOR) {
                            $gestor_visible = true;
                        }
                    }
                }
                
                $this->widget('application.extensions.menu.SMenu', array(
                    "menu" => array(
                        //menu raiz
                        array("url" => array("route" => "/"), "label" => "Início"),
                        //menu do gerente da unidade
                        array("url" => array(),
                            "label" => "G. da Unidade",
                            array("url" => array("route" => "/producaoDiaria/send"), "label" => "Enviar Produção Diária"),
                            array("url" => array("route" => "/producaoDiaria/adminGestor"), "label" => "Consultar Histórico"),
                            array("url" => array("route" => "/profissionalVinculo/create"), "label" => "Vincular Profissional"),
                            'visible' => $gerencia_unidade_visible,
                        ),
                        //menu para os gestores
                        array("url" => array(),
                            "label" => "Gestor",
                            array("url" => array("route" => "/producaoDiaria/admin"), "label" => "Consultar Histórico"),
                            array("url" => array("route" => ""), "label" => "Relatórios da Produção Diária",
                                array("url" => array("route" => "/producaoDiaria/monthEspecialidade"), "label" => "Por Especialidade"),
                                array("url" => array("route" => "/producaoDiaria/monthEspecialidadeGrupo"), "label" => "Por Especialidade e Grupo"),
                                array("url" => array("route" => "/producaoDiaria/monthGrupo"), "label" => "Por Grupo"),
                                array("url" => array("route" => "/producaoDiaria/monthProfissional"), "label" => "Por Profissional"),
                            ),
                            'visible' => $gestor_visible,
                        ),
                        //menus que somente são e
                        array("url" => array(),
                            "label" => "Cadastro",
                            array("url" => array("route" => "/cargo/create"), "label" => "Cargo"),
                            array("url" => array("route" => "/competencia/create"), "label" => "Competências"),
                            array("url" => array("route" => "/departamento/create"), "label" => "Departamento"),
                            array("url" => array("route" => "/metas/equipe/create"), "label" => "Equipe"),
                            array("url" => array("route" => "/unidadeGestor/create"), "label" => "Gerentes de Unidades"),
                            array("url" => array("route" => "/grupo/create"), "label" => "Grupo"),
                            array("url" => array("route" => "/Servidor/create"), "label" => "Servidor"),
                            array("url" => array("route" => "/Setor/create"), "label" => "Setor"),
                            array("url" => array("route" => "/Unidade/create"), "label" => "Unidade"),
                            'visible' => $admin_visible,
                        ),
                        array("url" => array(),
                            "label" => "Administração",
                            array("url" => array("route" => "/cargo/admin"), "label" => "Cargo"),
                            array("url" => array("route" => "/competencia/admin"), "label" => "Competências"),
                            array("url" => array("route" => "/user/admin"), "label" => "Usuário"),
                            array("url" => array("route" => "/rbac/assignment"), "label" => "Permissões"),
                            array("url" => array("route" => "/producaoDiaria/adminSuper"), "label" => "Produção Diária"),
                            array("url" => array("route" => "/profissionalVinculo/admin"), "label" => "Vínculo do Servidor"),
                            'visible' => $admin_visible,
                        ),
                        //menu raiz
                        array("url" => array(),
                            "label" => "Ajuda",
                            array("url" => array("route" => "/site/page/about", "view" => "about"), "label" => "Sobre"),
                            array("url" => array("route" => "/site/contact"), "label" => "Contato")),
                        array("url" => array("route" => "user/login"), "label" => "Entrar", "visible" => Yii::app()->user->isGuest),
                        array("url" => array(),
                            "label" => Yii::app()->user->name,
                            array("url" => array("route" => "user/logout"), "label" => "Sair"),
                            'visible' => !Yii::app()->user->isGuest,
                        ),
                    ),
                    "stylesheet" => "menudropdown.css", //Yii::app()->request->baseUrl.'/css/menudropdown.css'
                    "menuID" => "myMenu",
                    "delay" => 3
                        )
                );
                ?>
                <p></p>
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
