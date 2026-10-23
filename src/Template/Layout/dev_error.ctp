<?php
use Cake\Error\Debugger;

$isNotFound = isset($code) && $code < 500;
$titulo = $isNotFound ? 'Página no encontrada' : 'Error interno';
$mensaje = $isNotFound
    ? 'La dirección solicitada no existe o ya no está disponible.'
    : 'Ocurrió un error inesperado. Intenta de nuevo más tarde.';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        #container {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        #container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        #container h2 {
            margin: 10px 0;
        }
        #container p {
            line-height: 1.5;
        }
        #container a {
            color: #337ab7;
            text-decoration: none;
        }
        #container a:hover {
            text-decoration: underline;
        }
        #container details {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: left;
            font-size: 13px;
            word-break: break-word;
        }
        #container summary {
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="container">
        <?= $this->Html->image('Error.png', ['alt' => 'Error']) ?>
        <h2><?= $titulo ?></h2>
        <p class="error"><?= $mensaje ?></p>
        <p><?= $this->Html->link('Volver al inicio', '/') ?></p>
        <details class="error-detalle">
            <summary>Detalle técnico (solo desarrollo)</summary>
            <p><strong>Título:</strong> <?= $this->fetch('title') ?></p>
            <p><strong>Mensaje:</strong> <?= isset($message) ? h($message) : '' ?></p>
            <?php if (!empty($url)): ?>
                <p><strong>URL:</strong> <?= $url ?></p>
            <?php endif; ?>
            <?php if (!empty($file)): ?>
                <p><strong>Archivo:</strong> <?= h($file) ?><?= isset($line) ? ':' . h($line) : '' ?></p>
            <?php endif; ?>
            <?php if (!empty($error) && !empty($error->queryString)): ?>
                <p><strong>SQL Query:</strong> <?= h($error->queryString) ?></p>
            <?php endif; ?>
            <?= $this->fetch('subheading') ?>
            <?= $this->fetch('file') ?>
            <?php if (!empty($trace)): ?>
                <p><strong>Stack trace:</strong></p>
                <?= Debugger::exportVar($trace, 3) ?>
            <?php endif; ?>
        </details>
    </div>
</body>
</html>
