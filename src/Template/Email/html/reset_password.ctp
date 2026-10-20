<!-- src/Template/Email/html/reset_password.ctp -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Recuperación de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .header {
            background-color: #0073b1;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .button {
            background-color: #0073b1;
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            color: #999999;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Recuperación de Contraseña</h1>
    </div>
    <div class="content">
        <p>Hola <?= h($name) ?></p>
        <p>Has solicitado restablecer tu contraseña. Haz clic en el botón de abajo para restablecerla:</p>
        <a href="<?= $reseturl ?>" class="button">Restablecer Contraseña</a>
        <p>Si no has solicitado este cambio, simplemente ignora este correo.</p>
        <p>Gracias,</p>
        <p>El equipo de Soporte</p>
    </div>
    <div class="footer">
        <p>Incidencias y Servicios. <br>&copy; <?= date('Y') ?>Todos los derechos reservados.</p>
    </div>
</div>
</body>
</html>
