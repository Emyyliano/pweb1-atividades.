<?php
// =====================================================================
// Projeto integrador v1: Perfil do Estudante
// Commit 2: Adiciona páginas de habilidades e projetos
// =====================================================================

// 1. Dados do perfil
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
$pagina = $_GET['pagina'] ?? 'inicio';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <header>
      <h1><?= htmlspecialchars($perfil['nome']) ?></h1>
      <p><?= htmlspecialchars($perfil['curso']) ?></p>
      <nav>
          <a href="?pagina=inicio">Início</a> |
          <a href="?pagina=habilidades">Habilidades</a> |
          <a href="?pagina=projetos">Projetos</a>
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

    <?php endif; ?>
  </main>
  <hr>
  <footer>
    <p>&copy; <?= date('Y') ?> - <?= htmlspecialchars($perfil['nome']) ?></p>
  </footer>

</body>
</html>