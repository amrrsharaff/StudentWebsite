<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <?php if (isset($title)): ?>
            <title>Amr: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Amr</title>
        <?php endif ?>
        <link rel="stylesheet" href="css/style.css">    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
