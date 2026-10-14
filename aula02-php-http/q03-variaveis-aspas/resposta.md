# Questão 03: Variáveis, aspas e concatenação

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aspas.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o que cada linha vai mostrar.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"Aluno: " . $nome` | Aluno: Emyliano | Aluno: Emyliano |
| `"Aluno: $nome"` | Aluno: Emyliano | Aluno: Emyliano |
| `'Aluno: $nome'` | 'Aluno: $nome' | Aluno: $nome |
| `"Cursa o {$semestre}º semestre de $curso"` | Cursa o {$semestre}º semestre de ADS | Cursa o 2o semestre de ADS |
| `$nome . $curso` | EmylianoADS | EmylianoADS |
| `<?= $nome ?>` | Emyliano | Atalho: Emyliano |


**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

para não haver erro de ambiguidade, elas dizem ao PHP que a string que está junto da variável não faz parte dela, por exemplo `{$semestre}º -> 2º`. Já quando remover as {} $semestreº -> vai dar erro pois não existe uma variável assim.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

```
<p>Aluno: Emyliano</p>
<p>Aluno: Emyliano</p>
<p>Aluno: $nome</p>
<p>Cursa o 2o semestre de ADS</p>
<p>EmylianoADS</p>
<p>Atalho: Emyliano</p>
```

**Explicação linha por linha:**

`Aluno: Emyliano`: está entre " ", logo vai exibir a string que está dentro variavel $nome na mensagem, vale pro 1 e 2.

`Aluno: $nome`: exibiu a variável pois ' ', exibe exatamente o que está lá dentro.

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

`"Cursa o {$semestre}º semestre de $curso"`: na minha cabeça não fazia sentido o {}, pois outra linguagem para exibir o que tem dentro da variável é exatamente assim (esqueci qual era), já que no PHP so precisa do cifrão.

`<?= $nome ?>`: pra mim só iria aparecer o "Emyliano", ao inves de "Atalho: Emyliano"

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Porque ele concatena as duas variáveis, ai ficam juntas. Para resolver basta colocar " " entre elas para imprimir com espaço: `$nome . " " . $curso`.
