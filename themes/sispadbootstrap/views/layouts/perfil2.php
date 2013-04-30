<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span8">
        <?php echo $content; ?>
    </div>
    
    <div class="span4 profile-box">
        <div class="row span3">
            <h4>Perfil</h4>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <td style="text-transform: uppercase"><?php echo $this->model->nome ?></td>

                </tr>
                <tr>
                    <th>Matrícula</th>
                    <td><?php echo $this->model->matricula ?></td>
                </tr>
                <tr>
                    <th>CPF</th>
                    <td><?php echo $this->model->cpf ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>