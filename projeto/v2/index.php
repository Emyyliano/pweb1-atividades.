<?php
// =====================================================================
// Projeto integrador v1: Perfil do Estudante
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

if ($tema_recebido === 'escuro') {
    $tema = 'escuro';
} else {
    $tema = 'claro';
}

if (isset($_GET['tema'])) {
    setcookie('tema', $tema, time() + (30 * 24 * 60 * 60));
}
if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode([
        'perfil' => $perfil,
        'projetos' => $projetos
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}
$pagina = $_GET['pagina'] ?? 'inicio';

if ($pagina === 'projeto') {
    $id = (int) ($_GET['id'] ?? 0);
    
    if (!isset($projetos[$id])) {
        $pagina = '404_projeto'; 
        http_response_code(404);
    }
} 
elseif ($pagina !== 'inicio' && $pagina !== 'habilidades' && $pagina !== 'projetos') {
    $pagina = '404_pagina';
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
        <li><strong>Campus:</strong> <?= htmlspecialchars($perfil['campus']) ?></li>
        <li><strong>Cidade:</strong> <?= htmlspecialchars($perfil['cidade']) ?></li>
      </ul>
      <p><?= htmlspecialchars($perfil['apresentacao']) ?></p>

    <?php elseif ($pagina === 'habilidades'): ?>
      <h2>As minhas habilidades</h2>
      <p>Tenho <?= count($perfil['habilidades']) ?> habilidades principais:</p>
      <p><?= htmlspecialchars(implode(', ', $perfil['habilidades'])) ?></p>

    <?php elseif ($pagina === 'projetos'): ?>
      <h2>Meus Projetos</h2>
      <?php foreach ($projetos as $id => $projeto): ?>
        <div class="cartao-projeto">
          <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
          <p><a href="?pagina=projeto&id=<?= $id ?>">Ver detalhes do projeto</a></p>
        </div>
      <?php endforeach; ?>

    <?php elseif ($pagina === 'projeto'): ?>
      <?php 
        $id = (int) $_GET['id'];
        $projeto_atual = $projetos[$id];
      ?>
      <div class="cartao-projeto">
        <h2><?= htmlspecialchars($projeto_atual['titulo']) ?></h2>
        <p><strong>Descrição:</strong> <?= htmlspecialchars($projeto_atual['descricao']) ?></p>
        <p><strong>Tecnologias:</strong> <?= htmlspecialchars($projeto_atual['tecnologias']) ?></p>
        <br>
        <a href="?pagina=projetos">← Voltar para a lista</a>
      </div>

    <?php elseif ($pagina === '404_projeto'): ?>
      <h2>Projeto não encontrado</h2>
      <p>O ID que tentaste aceder não existe no nosso sistema.</p>
      <a href="?pagina=projetos">← Voltar para a lista</a>

    <?php elseif ($pagina === '404_pagina'): ?>
      <h2>Página não encontrada</h2>
      <p>A página que solicitaste não existe.</p>
      <a href="?pagina=inicio">← Voltar ao início</a>

    <?php endif; ?>
  </main>
  <hr>
  <footer>
    <p>Tema atual: <strong><?= $tema ?></strong></p>
    <p><a href="?formato=json" target="_blank">Ver dados em JSON</a></p>
    <p>&copy; <?= date('Y') ?> - <?= htmlspecialchars($perfil['nome']) ?></p>
  </footer>

</body>
</html>