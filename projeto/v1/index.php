<?php
// =====================================================================
// Projeto integrador v1: Perfil do Estudante
// Commit 5: Adiciona rota em JSON
// =====================================================================
$perfil = [
    'nome' => 'Emyliano Carvalho Costa',
    'curso' => 'Análise e Desenvolvimento de Sistemas',
    'campus' => 'IFCE Campus Boa Viagem',
    'cidade' => 'Boa Viagem',
    'apresentacao' => 'Desenvolvedor focado em interfaces, web design e administração de sistemas...',
    'habilidades' => ['Figma', 'PHP', 'JavaScript', 'React', 'Linux']
];

$projetos = [
    1 => [
        'titulo' => 'IVolley',
        'descricao' => 'Sistema de gestão de treinos e rotações para a equipe de voleibol do IFCE.',
        'tecnologias' => 'PHP, HTML, CSS'
    ],
    2 => [
        'titulo' => 'Observadores da Natureza',
        'descricao' => 'Plataforma web implementada e avaliada em ambiente escolar.',
        'tecnologias' => 'React, Docker, Figma'
    ],
    3 => [
        'titulo' => 'Efeitos Visuais (VFX)',
        'descricao' => 'Desenvolvimento de scripts de efeitos visuais e animações para jogos.',
        'tecnologias' => 'Lua, Roblox Studio'
    ]
];
$tema_recebido = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

if ($tema_recebido === 'escuro') {$tema = 'escuro';
} else {
    $tema = 'claro';
}

if (isset($_GET['tema'])) {
    setcookie('tema', $tema, time() + (30 * 24 * 60 * 60));
}

if (isset($_GET['formato']) &&$_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode([
        'perfil' => $perfil,
        'projetos' => $projetos
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}
$pagina =$_GET['pagina'] ?? 'inicio';

if ($pagina === 'projeto') {
    $id = (int) ($_GET['id'] ?? 0);
    
    if (!isset($projetos[$id])) {$pagina = '404_projeto'; 
        http_response_code(404);
    }
} 
elseif ($pagina !== 'inicio' &&$pagina !== 'habilidades' && $pagina !== 'projetos') {$pagina = '404_pagina';
    http_response_code(404);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-<?= $tema ?>">
  <header>
      <h1><?= htmlspecialchars($perfil['nome']) ?></h1>
      <p><?= htmlspecialchars($perfil['curso']) ?></p>
      <nav>
          <a href="?pagina=inicio">Início</a> |
          <a href="?pagina=habilidades">Habilidades</a> |
          <a href="?pagina=projetos">Projetos</a> |
          <a href="?tema=<?= $tema === 'claro' ? 'escuro' : 'claro' ?>">Trocar Tema</a>
      </nav>
  </header>
  <hr>
  <main>
    <?php if ($pagina === 'inicio'): ?>
      <h2>Sobre mim</h2>
      <ul>
        <li><strong>Nome:</strong> <?= htmlspecialchars($perfil['nome']) ?></li>
        <li><strong>Curso:</strong> <?= htmlspecialchars($perfil['curso']) ?></li>
        <li><strong>Campus:</strong> <?= htmlspecialchars($perfil