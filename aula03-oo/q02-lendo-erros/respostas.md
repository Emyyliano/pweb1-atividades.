# Questão 02: Lendo erros de objetos

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erros.php` | Fornecido com quatro erros. Corrija um de cada vez |

## 1. Análise do código

**1.1 Preencha a tabela, na ordem em que os erros apareceram:**

| Rodada | Linha | Tipo da mensagem (Warning ou Fatal error) | O que estava errado | Como corrigiu |
|---|---|---|---|---|
| 1 | 19 | PHP Warning:  Undefined variable | o sifrão no `$aluno->$nome` | Removi o `$` do `$nome`, pois o PHP procura uma variável por conta do sifrão, o que caba dando error |
| 2 | 20 | HP Fatal error:  Uncaught TypeError | o `'3'` entre aspas | Removi as aspas pois o programa tá sendo forçado a não fazer a interpretação |
| 3 | 21 | Uncaught Error: Typed property | o `$aluno->curso`não tem nenhum valor para exibir | atribui `$aluno->curso = 'Sistemas'`|
| 4 | 14 | Undefined variable | `Sou $nome...` a variável tá solta e o PHP não sabe a quem ta se referindo | Colocando o `$this->nome` |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Rodada 1**: `php q02-lendo-erros/erros.php`

```
b1-atividades\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 20

Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.2 Rodada 2**

```
b1-atividades\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 20

Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.3 Rodada 3**

```
ub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 21

Fatal error: Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 21
```

**2.4 Rodada 4**

```text
eb1-atividades\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 21
PS C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros> php erros.php
Curso: Sistemas
PHP Warning:  Undefined variable $nome in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 14

Warning: Undefined variable $nome in C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 14
Sou , do 3º semestre.
```

**2.5 Execução final, sem erros**

```
Curso: Sistemas
Sou Carla, do 3º semestre.
```

**Explicação:**

Nestes logs do terminal, eu registrei a minha jornada corrigindo o arquivo `erros.php` passo a passo. Nas primeiras execuções, o PHP travou a aplicação com erros fatais (`Fatal error`): primeiro por causa do `strict_types` (tentei passar o semestre '3' como texto em vez de número na linha 20) e depois porque tentei ler o $curso na linha 21 antes de guardar qualquer valor nele (erro de inicialização).

Na Rodada 4, a aplicação não travou, mas o PHP disparou um Warning e o nome da Carla sumiu do texto impresso na tela! Isso aconteceu porque, dentro da função `apresentar()`, eu deixei a variável `$nome` solta, esquecendo de usar o `$this->nome` para avisar ao PHP que aquele dado pertencia ao objeto atual. Depois de corrigir esse último detalhe, a execução final funcionou perfeitamente e sem nenhum aviso no terminal.

## 3. Perguntas

**a) Na rodada 1 apareceram duas mensagens. Qual delas parou o programa? Qual a diferença entre `Warning` e `Fatal error`?**

O `Fatal error` parou o programa. A diferença é que o `Warning` é só um aviso e deixa o código continuar rodando, enquanto o `Fatal error` é um erro grave que trava e aborta a execução imediatamente.

**b) Por que o erro do `$curso` só aparece na linha do `echo`, e não na linha do `new Aluno()`?**

Porque criar o objeto com `new Aluno()` vazio é permitido na memória. O erro só acontece na linha do `echo` porque é o momento exato em que eu tento ler e usar a propriedade `$curso` sem ter guardado nenhum valor nela antes.

**c) Dentro do método, por que é preciso escrever `$this->nome`, e não só `$nome`?**

Porque se eu usar só `$nome`, o PHP vai achar que é uma variável solta e vazia criada ali dentro. Eu preciso usar `$this->nome` para avisar ao PHP que quero acessar a propriedade que pertence a este objeto.