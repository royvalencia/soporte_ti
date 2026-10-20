<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Cuenta</title>
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
                <h1>Registro de Cuenta</h1>
            </div>
            <div class="content">
                <p>¡Hola <?= $coUser->nombre ?>!</p>
                <p>Gracias por registrarte en nuestro portal</p>
                <a href="<?= h($LinkPagina) ?>" class="button">Entrar al Portal</a>
                <p><b>Datos de Acceso</b></p>
                <p>Usuario:  <?= $coUser->email ?></p>
                <p>Contraseña: La que ingresaste en el formulario de registro<br><em><i>(Por la razones de seguridad, encriptamos la contraseña)</i></em></p>
                <p>&nbsp;</p>
                <p>Consulte el Manual Enviado</p>
                <p style="color: #999999; font-size: 15px; margin-top: 20px;" align="center">
                    <u>Este es un correo informativo, por favor no responda a este mensaje.</u>
                </p>
            </div>
            <div class="footer">
                <p>Incidencias y Servicios. <br>&copy; <?= date('Y') ?>Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
</html>
