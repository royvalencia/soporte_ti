<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';
?>
<h2>Página no encontrada</h2>
<p class="error">
    La dirección solicitada no existe o ya no está disponible.
</p>
<p><?= $this->Html->link('Volver al inicio', '/') ?></p>
<?php if (Configure::read('debug')): ?>
<details class="error-detalle">
    <summary>Detalle técnico (solo desarrollo)</summary>
    <p><strong>Mensaje:</strong> <?= h($message) ?></p>
    <p><strong>URL:</strong> <?= $url ?></p>
    <?php if (!empty($error->queryString)): ?>
        <p><strong>SQL Query:</strong> <?= h($error->queryString) ?></p>
    <?php endif; ?>
    <?php if (!empty($error->params)): ?>
        <p><strong>SQL Query Params:</strong></p>
        <?= Debugger::exportVar($error->params, 3) ?>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
</details>
<?php endif; ?>
