<?php
$statusLogado = $_COOKIE['usuario_logado'] ?? "não";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Painel do Usuário</h1>
    <p>Usuário logado: <strong><?= $statusLogado ?></strong></p>
</body>
</html>