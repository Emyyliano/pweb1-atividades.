# Questão 06: Construtor

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `produto.php` | O Produto da aula. Você acrescenta o construtor |
| `teste-erros.php` | Fornecido: três criações erradas, uma de cada vez |

## 1. Análise do código

**1.1 Cole o seu construtor e explique cada linha.**

```
public function __construct(string $nome, float $preco, int $quantidade)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }
```

O método `__construct` serve para garantir que o meu objeto já nasça com seus dados essenciais. Na assinatura, eu exijo receber os três parâmetros básicos (`$nome`, `$preco` e `$quantidade`). Nas três linhas internas, eu utilizo o `$this->` para pegar os valores exatos que chegaram pelos parâmetros e guardá-los de forma definitiva nas propriedades do meu próprio objeto.

**1.2 Explique o `= 1` no parâmetro `$quantidade`.**

O `= 1`  indica que eu defini um valor padrão para o parâmetro $quantidade, tornando-o opcional na hora de criar o objeto. Se por acaso eu colocar um produto sem a quantidade o PHP vai assumir que é 1

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q06-construtor/produto.php`

```
Produto: Notebook
Preço unitário: R$ 3.500,00<br>Quantidade: 3
Total: R$ 10.500,00<br>Preço após desconto: R$ 3.150,00<br>
```

**Explicação:**

Exibe de forma correta as inforamações do preço, total e desconto

**2.2 Erro com `new Produto('Teclado')`**: `php q06-construtor/teste-erros.php`

```
Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php on line 9 and exactly 3expected in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php:34
Stack trace:
#0 C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php(9): Produto->__construct('Teclado')
#1 {main}
  thrown in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php on line 34
```

**Explicação:**

`$p1 = new Produto('Teclado');`: Gera um `ArgumentCountError` porque falta o segundo parâmetro obrigatório (`$preco`).

**2.3 Erro com `new Produto('Teclado', 'cem reais', 2)`**

```
en, called in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php on line 10 and defined in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php:34
Stack trace:
#0 C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php(10): Produto->__construct('Teclado', 'cem reais', 2)
#1 {main}
  thrown in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php on line 34
```

**Explicação:**

`$p2 = new Produto('Teclado', 'cem reais', 2);`: Gera um `TypeError` porque o preço foi enviado como texto (`string`), mas a classe exige um número (`float`).

**2.4 Erro com `new Produto()`**

```
Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php on line 11 and exactly 3 expected in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php:34
Stack trace:
#0 C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\teste-erros.php(11): Produto->__construct()
#1 {main}
  thrown in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q06-construtor\produto.php on line 34
```

**Explicação:**
`$p3 = new Produto();`: Gera um `ArgumentCountError` porque tenta criar o objeto totalmente vazio, ignorando os parâmetros obrigatórios do construtor.

## 3. Perguntas

**a) A mensagem diz "at least 2 expected", e não "exactly 3". Por quê?**

Porque o terceiro parâmetro (`$quantidade`) possui um valor padrão definido (`= 1`), o que o torna opcional. O sistema exige apenas a passagem dos dois primeiros parâmetros obrigatórios (`$nome` e `$preco`).

**b) Quem devolve o objeto pronto: o `__construct` ou o `new`?**

A palavra-chave `new` é a verdadeira responsável por criar e devolver o objeto pronto na memória. O método `__construct` serve apenas para inicializar as propriedades internamente e não possui nenhum retorno.

**c) Que erro da versão anterior (sem construtor) deixou de ser possível?**

Deixou de ser possível criar um objeto com propriedades tipadas não inicializadas (vazias). O construtor obriga que o objeto já nasça com todos os seus dados essenciais preenchidos, evitando erros fatais por ausência de dados.
