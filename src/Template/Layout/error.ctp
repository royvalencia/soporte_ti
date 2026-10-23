<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Error de Internet';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
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
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
