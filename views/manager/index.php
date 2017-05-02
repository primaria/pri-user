<?php 


use yii\helpers\Html;



?>

<div class="Users-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        Vension : <?= $this->context->module->getVersion() ; ?> </br>  
        Esta es la vista de la action "<?= $this->context->action->id ?>".
        La accion pertenece al controller "<?= get_class($this->context) ?>"
        en el Modulo "<?= $this->context->module->id ?>" .
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
