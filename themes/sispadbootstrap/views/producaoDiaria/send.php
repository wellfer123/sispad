<?php
/* @var $this ProducaoDiariaController */
/* @var $model ProducaoDiaria */

$this->breadcrumbs = array(
    'Produção Diária' => array('adminGestor'),
    'Envio',
);

$this->menu = array(
    array('label' => 'Histórico Produção Diária', 'url' => array('producaoDiaria/adminGestor'), 'icon' => 'icon-chevron-right'),
    array('label' => 'Vincular Profissional', 'url' => array('profissionalVinculo/create'), 'icon' => 'icon-chevron-right'),
);
?>
<div class="well page-content">
    <h2 class="page-title">Envio da Produção Diária</h2>

    <?php
    echo $this->renderPartial('_send', array(
        'model' => $model,
        'unidades' => $unidades,
        'grupos' => $grupos,
        'observacoes' => $observacoes,
        'profissionais' => $profissionais,
        'especialidades' => $especialidades,
        'servidor' => $servidor));
    ?>

    <div id="producoes">
        <?php
        echo $this->renderPartial('_producoes', array(
            'model' => $model,
            'unidades' => $unidades,));
        ?>
    </div>

</div>

<script type="text/javascript">
    //função que envia o código do formulário e do item a serem adicionados


    function send()
    {
        //pega os dados do formulário
        var data = $("#producao-diaria-form").serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("producaoDiaria/updateProducoes"); ?>',
            data: data,
            success: function(data) {
                updateProducoes();
            },
            error: function() { // if error occured
                alert("Ops! Ocorreu um erro!");
            },
            complete: function() {

            },
            dataType: 'html'
        });

    }
    //em caso de sucesso da adição do item no formulário
    //vai atualizar parcialmente o gridview com os itens do formulário
    function updateProducoes() {
<?php
echo CHtml::ajax(array(
    'data' => array('cnes' => $model->unidade_cnes, 'gestor' => $model->servidor_cpf),
    'url' => Yii::app()->createAbsoluteUrl("formulario/addQuestaoUpdate"),
    'update' => '#producoes',
    'type' => 'GET'));
?>
    }
</script>
