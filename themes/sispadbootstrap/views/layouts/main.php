<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
        <!--[if lt IE 9]>
            <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/html5shiv.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/global.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/font-awesome.min.css" />
    </head>

    <body>
        <div class="container">
            <div class="header">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/imagens/logo-transparent.png"/>
            </div>
            <?php
            //instancia do RBAC para verificação de acesso ao menu
            $RBAC2 = new RBACAccessVerifier();
            //SOMENTE O SUPER ADMINISTRADOR PODE VER O MENU COMPLETO
            $visible = $RBAC2->checkAccess('SuperAdmin');

            //$roles = $this->getState("roles");
            $gestor_visible = false;
            $roles = Yii::app()->user->getState(UserIdentity::ROLES);
            if ($roles != null) {
                foreach ($roles as $n => $role) {
                    if ($n == UserIdentity::ROLE_GESTOR) {
                        $gestor_visible = true;
                    }
                }
            }
            $menuGestor = array();

            //$servidor=$this->getServidor();
            $menuGestor = array(
                "label" => "Gestor",
                "url" => array(),
                "active" => false,
                'visible' => $gestor_visible,
                "items" => array(
                    array(
                        "label" => "Enviar Produção Diária",
                        "url" => Yii::app()->createAbsoluteUrl("/producaoDiaria/send"),
                        "active" => false
                    ),
                    array(
                        "url" => Yii::app()->createAbsoluteUrl("/producaoDiaria/adminGestor"),
                        "label" => "Consultar Histórico",
                        "active" => false
                    ),
                    array(
                        "url" => Yii::app()->createAbsoluteUrl("/profissionalVinculo/create"),
                        "label" => "Vincular Profissional",
                        "active" => false
                    ),
                ),
            );
            $this->widget('bootstrap.widgets.TbNavbar', array(
                "brand" => false,
                "htmlOptions" => array(
                    "class" => "navbar"
                ),
                "fixed" => array(),
                "items" => array(
                    array(
                        "class" => 'bootstrap.widgets.TbMenu',
                        "items" => array(
                            array(
                                "icon" => "icon-home",
                                "label" => "Início",
                                "url" => Yii::app()->createAbsoluteUrl("/"),
                                "active" => false,
                            ),
                            array(
                                "icon" => "icon-table",
                                "label" => "Relatório",
                                "active" => false,
                                "visible" => $visible,
                                "items" => array(
                                    array(
                                        "label" => "Enviar Meu Relatório",
                                        "url" => Yii::app()->createAbsoluteUrl("/Relatorio/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Enviar Quantidade",
                                        "url" => Yii::app()->createAbsoluteUrl("/TotalRelatorio/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Total de Relatórios (Meus)",
                                        "url" => Yii::app()->createAbsoluteUrl("/TotalRelatorio/list"),
                                        "active" => false
                                    ),
                                ),
                            ),
                            $menuGestor,
                            array(
                                "icon" => "icon-book",
                                "url" => array(),
                                "label" => "Faltas",
                                "visible" => $visible,
                                "active" => false,
                                "items" => array(
                                    array(
                                        "label" => "Enviar",
                                        "url" => Yii::app()->createAbsoluteUrl("/Falta/preparedCreate"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Relatorio Detalhado",
                                        "url" => Yii::app()->createAbsoluteUrl("/Falta/preparedViewDetail"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Relatorio Mensal",
                                        "url" => Yii::app()->createAbsoluteUrl("/Falta/preparedViewMonth"),
                                        "active" => false
                                    ),
                                ),
                            ),
                            array(
                                "icon" => "icon-pencil",
                                "label" => "Cadastro",
                                "url" => array(),
                                "visible" => $visible,
                                "active" => false,
                                "items" => array(
                                    array(
                                        "label" => "Cargo",
                                        "url" => Yii::app()->createAbsoluteUrl("/cargo/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Competências",
                                        "url" => Yii::app()->createAbsoluteUrl("/competencia/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Departamento",
                                        "url" => Yii::app()->createAbsoluteUrl("/departamento/index"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Setor",
                                        "url" => Yii::app()->createAbsoluteUrl("/Setor/index"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Servidor",
                                        "url" => Yii::app()->createAbsoluteUrl("/Servidor/index"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Gestor de Unidade",
                                        "url" => Yii::app()->createAbsoluteUrl("/unidadeGestor/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Unidade",
                                        "url" => Yii::app()->createAbsoluteUrl("/Unidade/index"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Indicador",
                                        "url" => Yii::app()->createAbsoluteUrl("/metas/indicador/create"),
                                        "active" => false
                                    ),
                                    array(
                                        "label" => "Equipe",
                                        "url" => Yii::app()->createAbsoluteUrl("/metas/equipe/create"),
                                        "active" => false
                                    ),
                                ),
                            ),
                            array(
                                "icon" => "icon-cogs",
                                "label" => "Administração",
                                "active" => false,
                                "visible" => $visible,
                                "active" => false,
                                "items" => array(
                                    array(
                                        "label" => "Cargo",
                                        "url" => Yii::app()->createAbsoluteUrl("/cargo/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Competências",
                                        "url" => Yii::app()->createAbsoluteUrl("/competencia/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Usuário",
                                        "url" => Yii::app()->createAbsoluteUrl("/user/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Permissões",
                                        "url" => Yii::app()->createAbsoluteUrl("/rbac/assignment"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Indicadores",
                                        "url" => Yii::app()->createAbsoluteUrl("/metas/indicador/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Equipes",
                                        "url" => Yii::app()->createAbsoluteUrl("/metas/equipe/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Produção Diária",
                                        "url" => Yii::app()->createAbsoluteUrl("/producaoDiaria/adminSuper"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Vínculo do Servidor",
                                        "url" => Yii::app()->createAbsoluteUrl("/profissionalVinculo/admin"),
                                        "active" => false,
                                    ),
                                    array(
                                        "label" => "Metas Executadas",
                                        "url" => array("route" => ""),
                                        "active" => false,
                                        "items" => array(
                                            array(
                                                "label" => "Executadas por Médico",
                                                "url" => Yii::app()->createAbsoluteUrl("/metas/medicoExecutaMeta/admin"),
                                                "active" => false
                                            ),
                                            array(
                                                "label" => "Enfermeiro",
                                                "url" => Yii::app()->createAbsoluteUrl("/metas/enfermeiroExecutaMeta/admin"),
                                                "active" => false
                                            ),
                                            array(
                                                "label" => "Odontologo",
                                                "url" => Yii::app()->createAbsoluteUrl("/metas/odontologoExecutaMeta/admin"),
                                                "active" => false
                                            ),
                                            array(
                                                "label" => "Agente de Saúde",
                                                "url" => Yii::app()->createAbsoluteUrl("/metas/agenteSaudeExecutaMeta/admin"),
                                                "active" => false
                                            ),
                                        ),
                                    ),
                                    array(
                                        "label" => "Metas",
                                        "url" => array("route" => ""),
                                        "active" => false,
                                        "items" => array(
                                            array(
                                                "url" => Yii::app()->createAbsoluteUrl("/metas/meta/calculo"),
                                                "label" => "Lançamento",
                                                "active" => false,
                                            ),
                                        ),
                                    ),
                                    array(
                                        "url" => Yii::app()->createAbsoluteUrl("/relatorio/admin"),
                                        "label" => "Relatórios",
                                        "active" => false,
                                    ),
                                    array(
                                        "url" => Yii::app()->createAbsoluteUrl("/totalRelatorio/admin"),
                                        "label" => "Quantidade de Relatórios",
                                        "active" => false,
                                    ),
                                ),
                            ),
                            array(
                                "icon" => "icon-info-sign",
                                "label" => "Ajuda",
                                "active" => false,
                                "items" => array(
                                    array(
                                        "label" => "Sobre",
                                        "url" => Yii::app()->createAbsoluteUrl("/site/page/about"),
                                        "active" => false,
                                    ),
                                    array(
                                        "url" => Yii::app()->createAbsoluteUrl("/site/contact"),
                                        "label" => "Contato",
                                        "active" => false,
                                    ),
                                ),
                            ),
                            array(
                                "icon" => "icon-user",
                                "url" => Yii::app()->createAbsoluteUrl("/user/login"),
                                "label" => "Entrar",
                                "visible" => Yii::app()->user->isGuest,
                                "active" => false,
                            ),
                            array(
                                "icon" => "icon-off",
                                "url" => Yii::app()->createAbsoluteUrl("/user/logout"),
                                "label" => 'Sair (' . Yii::app()->user->name . ')', "visible" => !Yii::app()->user->isGuest,
                                "active" => false,
                            ),
                        ), //fim do menu principal
                        'htmlOptions' => array('style' => 'margin-left:60px'),
                    )
                )
            ));
            ?>
        </div>
        <div class="container page-container">
            <?php echo $content ?>
        </div>
        <footer>
            Copyright &copy; <?php echo date('Y'); ?> da Prefeitura Municipal de Caruaru.<br/>
            Todos os Direitos Reservados.<br/>
            Powered por Setor de Tecnologia da Informação - Secretaria de Saúde.
        </footer>

    </body>
</html>
