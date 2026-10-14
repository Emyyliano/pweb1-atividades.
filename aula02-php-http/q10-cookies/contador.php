<?php
$visitas = (int) ($_COOKIE['visitas'] ?? 0);
$visitas++;
setcookie('visitas', $visitas, time() + 3600);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador com Cookie</title>
</head>
<body>
    <p>Você visitou esta página <?= $visitas ?> vez(es).</p>
</body>
</html>