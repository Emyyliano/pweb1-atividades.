# Questão 08: Desafio: a turma na web

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `turma.php` | Você cria do zero: as classes `Aluno` e `Disciplina` e a página HTML |

## 1. Análise do código

**1.1 Desenhe (em texto ou tabela) as duas classes: atributos com tipo e visibilidade e métodos com tipo de retorno.**

**Classe `Aluno`**

| Visibilidade | Atributo / Método | Tipo / Retorno |
|---|---|---|
| `private` | `$nome` | `string` |
| `private` | `$matricula` | `string` |
| `public` | `__construct(string $nome, string $matricula)`| - |
| `public` | `getNome()` | `string` |
| `public` | `getMatricula()` | `string` |

**Classe `Disciplina`**

| Visibilidade | Atributo / Método | Tipo / Retorno |
|---|---|---|
| `private` | `$nome` | `string` |
| `private` | `$alunos` | `array` |
| `public` | `__construct(string $nome)` | - |
| `public` | `matricular(Aluno $aluno)` | `void` |
| `public` | `listarAlunos()` | `array` |

**1.2 Explique `adicionarAluno(Aluno $aluno)`: o que significa um parâmetro do tipo de uma classe?**

O parâmetro `Aluno $aluno` indica uma tipagem restrita. Ele exige que o método receba obrigatoriamente um objeto instanciado da classe `Aluno`, fazendo com que o PHP bloqueie automaticamente o envio de tipos primitivos (como `string` ou `int`)  ou de objetos criados a partir de outras classes.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Resposta da página**: `curl.exe -i http://localhost:8000/q08-turma-web/turma.php`

```
        th { background-color: #f4f4f4; }
        .erro { color: #d9534f; background-color: #f2dede; padding: 10px; border: 1px solid #ebccd1; border-radius: 4px; }
        .estatisticas { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Gestão da Disciplina: Programação Web I</h1>

    
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Média</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
                            <tr>
                    <td>Ana</td>
                    <td>8,75</td>
                    <td>Aprovado</td>
                </tr>
                            <tr>
                    <td>Bruno</td>
                    <td>5,50</td>
                    <td>Reprovado</td>
                </tr>
                            <tr>
                    <td>Caio</td>
                    <td>2,75</td>
                    <td>Reprovado</td>
                </tr>
                            <tr>
                    <td>Daniela</td>
                    <td>7,00</td>
                    <td>Aprovado</td>
                </tr>
                    </tbody>
    </table>

    <div class="estatisticas">
        <p>Média da Turma: 6,00</p>
        <p>Alunos Aprovados: 2</p>
    </div>
</body>
</html>
```

**Explicação:**

`curl.exe`: Acessa a página padrão sem parâmetros adicionais, exibindo os cabeçalhos de rede e o HTML resultante do fluxo normal e bem-sucedido.

**2.2 Trecho da resposta com `?teste=1`**: `curl.exe -s "http://localhost:8000/q08-turma-web/turma.php?teste=1"`

```text
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma - Programação Web I</title>
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
    <h1>Gestão da Disciplina: Programação Web I</h1>

            <p class="erro"><strong>Aviso:</strong> Nota inválida para Estudante Inválido: use valores de 0 a 10.</p>
    
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Média</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
                            <tr>
                    <td>Ana</td>
                    <td>8,75</td>
                    <td>Aprovado</td>
                </tr>
                            <tr>
                    <td>Bruno</td>
                    <td>5,50</td>
                    <td>Reprovado</td>
                </tr>
                            <tr>
                    <td>Caio</td>
                    <td>2,75</td>
                    <td>Reprovado</td>
                </tr>
                            <tr>
                    <td>Daniela</td>
                    <td>7,00</td>
                    <td>Aprovado</td>
                </tr>
                    </tbody>
    </table>

    <div class="estatisticas">
        <p>Média da Turma: 6,00</p>
        <p>Alunos Aprovados: 2</p>
    </div>
</body>
</html>
```

**Explicação:**

`?teste=1`: Injeta um valor na variável `$_GET`, o que força o sistema a instanciar uma nota inválida (11.0) propositalmente para disparar a `Exception` e testar a exibição da mensagem de erro pelo bloco catch.

**2.3 Log do servidor das duas requisições**

```
[Wed Oct 28 20:05:43 2026] [::1]:57031 Accepted
[Wed Oct 28 20:05:43 2026] [::1]:57031 [200]: GET /turma.php
[Wed Oct 28 20:05:43 2026] [::1]:57031 Closing
[Wed Oct 28 20:07:25 2026] [::1]:64528 Accepted
[Wed Oct 28 20:07:25 2026] [::1]:64528 [200]: GET /turma.php?teste=1
[Wed Oct 28 20:07:25 2026] [::1]:64528 Closing
```

**Explicação:**

O status `200` na segunda requisição comprova o sucesso do bloco `try/catch`. O sistema capturou a exceção da nota inválida e evitou um erro fatal de servidor (`500`), entregando a página HTML normalmente com o aviso de recusa.

**2.4 Erro ao passar um texto para `adicionarAluno` (pergunta a)**

```
Stack trace:
#0 C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q08-turma-web\turma.php(95): Aluno-&gt;__construct('teste')
#1 {main}
  thrown in <b>C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q08-turma-web\turma.php</b> on line <b>11</b><br />
```

**Explicação:**

O rastreamento de pilha indica que a falha ocorreu porque, na `linha 95`, tentou-se instanciar a classe enviando apenas um parâmetro (`'teste'`). Como o método `__construct`, definido na linha 11, exige múltiplos argumentos obrigatórios (como nome e notas), o PHP interrompeu a execução. Para corrigir o problema, deve-se ajustar a chamada na linha 95 fornecendo todos os dados exigidos pelo construtor.

## 3. Perguntas

**a) O que acontece ao chamar `$pweb->adicionarAluno('Eduardo')`? Por quê?**

Ao chamar a instrução `$pweb->adicionarAluno('Eduardo')`, o PHP lança um erro fatal do tipo `TypeError` e interrompe imediatamente a execução do script.

**b) Os objetos `Aluno` continuam na memória do servidor entre uma requisição e outra? Use o log para justificar.**

Não. Como o PHP funciona em um modelo sem estado, o log demonstra que cada conexão é curta e isolada, iniciando com Accepted e encerrando com `Closing`. No momento do encerramento, toda a memória é limpa e os objetos da classe `Aluno` são destruídos, sendo necessário recriá-los do zero a cada nova requisição ao servidor.

**c) Por que `calcularMediaTurma()` verifica se a lista está vazia antes de dividir?**

A verificação ocorre para evitar o erro fatal `DivisionByZeroError`. Se a lista estiver vazia, o divisor será 0, portanto o método retorna 0.0 antecipadamente para impedir uma divisão matemática impossível que causaria a quebra da aplicação
