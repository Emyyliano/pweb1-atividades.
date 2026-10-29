<?php

declare(strict_types=1);

class Aluno
{
    private string $nome;
    private float $nota1;
    private float $nota2;

    public function __construct(string $nome, float $nota1, float $nota2)
    {
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
            throw new Exception("Nota inválida para {$nome}: use valores de 0 a 10.");
        }
        
        $this->nome = $nome;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->calcularMedia();
        return $media >= 7.0 ? 'Aprovado' : 'Reprovado';
    }
}

class Disciplina
{
    private string $nome;
    private array $alunos = [];

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getAlunos(): array
    {
        return $this->alunos;
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function calcularMediaTurma(): float
    {
        $totalAlunos = count($this->alunos);
        if ($totalAlunos === 0) {
            return 0.0;
        }

        $somaDasMedias = 0.0;
        foreach ($this->alunos as $aluno) {
            $somaDasMedias += $aluno->calcularMedia();
        }

        return $somaDasMedias / $totalAlunos;
    }

    public function contarAprovados(): int
    {
        $aprovados = 0;
        foreach ($this->alunos as $aluno) {
            if ($aluno->situacao() === 'Aprovado') {
                $aprovados++;
            }
        }
        return $aprovados;
    }
}

$mensagemDeErro = '';
$disciplina = new Disciplina('Programação Web I');

try {
    $disciplina->adicionarAluno(new Aluno('Ana', 8.0, 9.5));
    $disciplina->adicionarAluno(new Aluno('Bruno', 5.0, 6.0));
    $disciplina->adicionarAluno(new Aluno('Caio', 2.5, 3.0));
    $disciplina->adicionarAluno(new Aluno('Daniela', 7.0, 7.0));

    // Captura de parâmetro via URL para forçar erro de validação
    if (isset($_GET['teste']) && $_GET['teste'] == '1') {
        $disciplina->adicionarAluno(new Aluno('Estudante Inválido', 11.0, 5.0));
    }
} catch (Exception $e) {
    // Armazena a exceção lançada para exibição no HTML
    $mensagemDeErro = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma - <?= htmlspecialchars($disciplina->getNome()) ?></title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; padding: 20px; }
        table { border-collapse: collapse; width: 60%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .erro { color: #d9534f; background-color: #f2dede; padding: 10px; border: 1px solid #ebccd1; border-radius: 4px; }
        .estatisticas { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Gestão da Disciplina: <?= htmlspecialchars($disciplina->getNome()) ?></h1>

    <?php if ($mensagemDeErro !== ''): ?>
        <p class="erro"><strong>Aviso:</strong> <?= htmlspecialchars($mensagemDeErro) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Média</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplina->getAlunos() as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno->getNome()) ?></td>
                    <td><?= number_format($aluno->calcularMedia(), 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($aluno->situacao()) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="estatisticas">
        <p>Média da Turma: <?= number_format($disciplina->calcularMediaTurma(), 2, ',', '.') ?></p>
        <p>Alunos Aprovados: <?= $disciplina->contarAprovados() ?></p>
    </div>
</body>
</html>