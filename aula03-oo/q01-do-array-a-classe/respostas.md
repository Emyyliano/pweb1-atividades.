# Questão 01: Do array à classe

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `livro-array.php` | Fornecido: o livro em array associativo |
| `livro.php` | Você cria: a classe `Livro` e dois objetos |

## 1. Análise do código

**1.1 Explique a declaração `public float $preco;`: o que é cada uma das três partes?**

`public`: significa que o objeto pode ser modificado em qualquer parte do código.

`float`: do princípio de LLP, é uma função que diz ao programa que o valor atribuido a variável é um número decimal.

`$preco`: a variável que vai guardar o valor do livro.

**1.2 Compare `$livro['titulo']` (array) e `$livro1->titulo` (objeto). O que muda na escrita e o que muda no que o PHP garante?**

O que muda é que no array é preciso colocar a variável entre `[]`e `''` string, para poder associar a viariável, o que deixa mais complicado. Já em objeto ele já "aponta" para variável sem aspas e nem chaves.

Como um array o PHP não consegue garantir que seja posto variáveis, valores no meio das chaves, ou procurar chaves que não existem, gerando um error. Já o objeto é gerado apartir de um tipo de molde, ele não for usado igual a classe declarada. o PHP bloqueia

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q01-do-array-a-classe/livro.php`

```
Bleach, de Tite Kubo (2001)
```

**Explicação:**

ele exibe a resposta `echo`do código. Como foi dado uma sequência de como os valores seriam atribuidos a cada variável(`$titulo, $autor, $ano`)

**2.2 Erro ao atribuir o ano como texto (item 5)**

```
Fatal error: Uncaught TypeError: Livro::__construct(): Argument #3 ($ano) must be of type int, string given
```

**Explicação:**

`Uncaught TypeError`: basicamente o erro não pode ser capturado pelo PHP

`Livro::__construct()`: o error aconteceu no método da linha, no caso o `__construct()`

`Argument #3 ($ano) must be of type int, string given`: basicamente ele ta dizendo que o argumento 3, o `$ano` só recebe valores do tipo `int`, e não `string`

## 3. Perguntas

**a) Quantas classes e quantos objetos existem no seu `livro.php`?**

_(responda aqui)_

**b) No `var_dump`, o que significam `object(Livro)#2` e o `(5)`?**

_(responda aqui)_

**c) O que o `declare(strict_types=1)` mudou no resultado do item 5?**

_(responda aqui)_
