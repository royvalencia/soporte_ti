<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';
?>
<h2>Error interno</h2>
<p class="error">
    Ocurrió un error inesperado. Intenta de nuevo más tarde.
</p>
<p><?= $this->Html->link('Volver al inicio', '/') ?></p>
<?php if (Configure::read('debug')): ?>
<details class="error-detalle">
    <summary>Detalle técnico (solo desarrollo)</summary>
    <p><strong>Mensaje:</strong> <?= h($message) ?></p>
    <?php if (!empty($error->queryString)): ?>
        <p><strong>SQL Query:</strong> <?= h($error->queryString) ?></p>
    <?php endif; ?>
    <?php if (!empty($error->params)): ?>
        <p><strong>SQL Query Params:</strong></p>
        <?= Debugger::exportVar($error->params, 3) ?>
    <?php endif; ?>
    <?php if ($error instanceof Error): ?>
        <p><strong>Error en:</strong> <?= sprintf('%s, línea %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?></p>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
</details>
<?php endif; ?>
