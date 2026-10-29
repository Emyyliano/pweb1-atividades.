<?php

declare(strict_types=1);

// 1. Classes (Projeto e Perfil)
class Projeto
{
    private string $titulo;
    private string $descricao;
    private string $tecnologias;

    public function __construct(string $titulo, string $descricao, string $tecnologias)
    {
        if (trim($titulo) === '') {
            throw new Exception('O projeto precisa de um título.');
        }
        
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->tecnologias = $tecnologias;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getTecnologias(): string
    {
        return $this->tecnologias;
    }

    public function paraArray(): array
    {
        return [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tecnologias' => $this->tecnologias
        ];
    }
}

class Perfil
{
    private string $nome;
    private string $curso;
    private string $campus;
    private string $cidade;
    private string $apresentacao;
    private array $habilidades;
    private array $projetos = [];

    public function __construct(string $nome, string $curso, string $campus, string $cidade, string $apresentacao, array $habilidades)
    {
        if (count($habilidades) < 5) {
            throw new Exception('O perfil precisa de pelo menos 5 habilidades.');
        }

        $this->nome = $nome;
        $this->curso = $curso;
        $this->campus = $campus;
        $this->cidade = $cidade;
        $this->apresentacao = $apresentacao;
        $this->habilidades = $habilidades;
    }

    public function adicionarProjeto(Projeto $projeto): void
    {
        $this->projetos[count($this->projetos) + 1] = $projeto;
    }

    public function getProjeto(int $id): Projeto
    {
        if (!isset($this->projetos[$id])) {
            throw new Exception('Projeto não encontrado.');
        }
        return $this->projetos[$id];
    }

    public function getNome(): string { return $this->nome; }
    public function getCurso(): string { return $this->curso; }
    public function getCampus(): string { return $this->campus; }
    public function getCidade(): string { return $this->cidade; }
    public function getApresentacao(): string { return $this->apresentacao; }
    public function getHabilidades(): array { return $this->habilidades; }
    public function getProjetos(): array { return $this->projetos; }

    public function paraArray(): array
    {
        $projetosArray = [];
        foreach ($this->projetos as $id => $projeto) {
            $projetosArray[$id] = $projeto->paraArray();
        }

        return [
            'nome' => $this->nome,
            'curso' => $this->curso,
            'campus' => $this->campus,
            'cidade' => $this->cidade,
            'apresentacao' => $this->apresentacao,
            'habilidades' => $this->habilidades,
            'projetos' => $projetosArray
        ];
    }
}

// 2. Os objetos
$perfil = new Perfil(
    'Emyliano Carvalho Costa',
    'Análise e Desenvolvimento de Sistemas',
    'IFCE Campus Boa Viagem',
    'Boa Viagem',
    'Desenvolvedor focado em interfaces, web design e administração de sistemas...',
    ['Figma', 'PHP', 'JavaScript', 'React', 'Linux']
);

$perfil->adicionarProjeto(new Projeto(
    'IVolley',
    'Sistema de gestão de treinos e rotações para a equipe de voleibol do IFCE.',
    'PHP, HTML, CSS'
));
$perfil->adicionarProjeto(new Projeto(
    'Observadores da Natureza',
    'Plataforma web implementada e avaliada em ambiente escolar.',
    'React, Docker, Figma'
));
$perfil->adicionarProjeto(new Projeto(
    'Efeitos Visuais (VFX)',
    'Desenvolvimento de scripts de efeitos visuais e animações para jogos.',
    'Lua, Roblox Studio'
));

// 3. Tema claro ou escuro
$tema_recebido = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

if ($tema_recebido === 'escuro') {
    $tema = 'escuro';
} else {
    $tema = 'claro';
}

if (isset($_GET['tema'])) {
    setcookie('tema', $tema, time() + (30 * 24 * 60 * 60));
}

// 4. Rota JSON
if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($perfil->paraArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// 5. Qual página mostrar
$pagina = $_GET['pagina'] ?? 'inicio';
$titulo_erro = '';

if ($pagina === 'projeto') {
    $id = (int) ($_GET['id'] ?? 0);
    
    try {
        $projetoAtual = $perfil->getProjeto($id);
    } catch (Exception $e) {
        http_response_code(404);
        $pagina = 'nao-encontrado';
        $titulo_erro = $e->getMessage();
    }
} elseif ($pagina !== 'inicio' && $pagina !== 'habilidades' && $pagina !== 'projetos') {
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
<body class="tema-<?= htmlspecialchars($tema) ?>">
  <header>
      <h1><?= htmlspecialchars($perfil->getNome()) ?></h1>
      <p><?= htmlspecialchars($perfil->getCurso()) ?></p>
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
        <li><strong>Nome:</strong> <?= htmlspecialchars($perfil->getNome()) ?></li>
        <li><strong>Curso:</strong> <?= htmlspecialchars($perfil->getCurso()) ?></li>
        <li><strong>Campus:</strong> <?= htmlspecialchars($perfil->getCampus()) ?></li>
        <li><strong>Cidade:</strong> <?= htmlspecialchars($perfil->getCidade()) ?></li>
      </ul>
      <p><?= htmlspecialchars($perfil->getApresentacao()) ?></p>

    <?php elseif ($pagina === 'habilidades'): ?>
      <h2>As minhas habilidades</h2>
      <p>Tenho <?= count($perfil->getHabilidades()) ?> habilidades principais:</p>
      <p><?= htmlspecialchars(implode(', ', $perfil->getHabilidades())) ?></p>

    <?php elseif ($pagina === 'projetos'): ?>
      <h2>Meus Projetos</h2>
      <?php foreach ($perfil->getProjetos() as $id => $projeto): ?>
        <div class="cartao-projeto">
          <h3><?= htmlspecialchars($projeto->getTitulo()) ?></h3>
          <p><a href="?pagina=projeto&id=<?= htmlspecialchars((string)$id) ?>">Ver detalhes do projeto</a></p>
        </div>
      <?php endforeach; ?>

    <?php elseif ($pagina === 'projeto'): ?>
      <div class="cartao-projeto">
        <h2><?= htmlspecialchars($projetoAtual->getTitulo()) ?></h2>
        <p><strong>Descrição:</strong> <?= htmlspecialchars($projetoAtual->getDescricao()) ?></p>
        <p><strong>Tecnologias:</strong> <?= htmlspecialchars($projetoAtual->getTecnologias()) ?></p>
        <br>
        <a href="?pagina=projetos">← Voltar para a lista</a>
      </div>

    <?php elseif ($pagina === 'nao-encontrado'): ?>
      <h2>Erro 404</h2>
      <p><?= htmlspecialchars($titulo_erro) ?></p>
      <a href="?pagina=projetos">← Voltar para a lista</a>

    <?php elseif ($pagina === '404_pagina'): ?>
      <h2>Página não encontrada</h2>
      <p>A página que solicitaste não existe.</p>
      <a href="?pagina=inicio">← Voltar ao início</a>

    <?php endif; ?>
  </main>
  <hr>
  <footer>
    <p>Tema atual: <strong><?= htmlspecialchars($tema) ?></strong></p>
    <p><a href="?formato=json" target="_blank">Ver dados em JSON</a></p>
    <p>&copy; <?= date('Y') ?> - <?= htmlspecialchars($perfil->getNome()) ?></p>
  </footer>
</body>
</html>