<?php
// =====================================================================
// Projeto integrador v1: Perfil do Estudante
// Commit 1: Dados do perfil e página inicial
// =====================================================================
$perfil = [
    'nome' => 'Emyliano Carvalho Costa',
    'curso' => 'Análise e Desenvolvimento de Sistemas',
    'campus' => 'IFCE Campus Boa Viagem',
    'cidade' => 'Boa Viagem',
    'apresentacao' => 'Desenvolvedor focado em interfaces, web design e administração de sistemas...',
    'habilidades' => ['Figma', 'PHP', 'JavaScript', 'React', 'Linux']
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
          <a href="?pagina=inicio">Início</a>
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
    <?php endif; ?>
  </main>
  <hr>
  <footer>
    <p>&copy; <?= date('Y') ?> - <?= htmlspecialchars($perfil['nome']) ?></p>
  </footer>

</body>
</html>