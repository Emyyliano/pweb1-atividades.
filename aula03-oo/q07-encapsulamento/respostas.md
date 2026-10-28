# Questão 07: Encapsulamento

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `conta.php` | A conta da aula. Você encapsula |
| `teste-protecao.php` | Fornecido: três tentativas de burlar a classe |

## 1. Análise do código

**1.1 Cole a sua classe e explique: quais atributos e métodos são `private`, quais são `public` e por quê.**

Os atributos (`$titular`, `$numero`, `$saldo`, `$extrato`) foram definidos como private para blindar a conta contra modificações externas indevidas. Os métodos principais (`depositar()`, `sacar()`, `consultarSaldo()`) são `public` para permitir que o sistema utilize a conta. Já o método `registrar()` é private porque é uma ferramenta de uso estritamente interno da classe.

**1.2 Explique o método privado `registrar()` e como o extrato é montado.**

O método `registrar()` atua como um auxiliar interno. Sempre que as operações de `depositar()` ou `sacar()` são validadas e concluídas, elas acionam esse método enviando um texto descritivo. Esse texto é então salvo dentro do array `$extrato`, construindo o histórico de transações de maneira automática e totalmente segura contra manipulações externas.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída com `$conta->saldo = -300;` na versão original (item 1)**

```                                                                                  
Titular: João<br>Conta: 12345<br>Saldo: R$ 450,00<br>
```

**Explicação:**

assim como foi colocado no código, o `$saldo` foi diminuido em `-300`

**2.2 Saída da versão encapsulada**: `php q07-encapsulamento/conta.php`

```
Titular: João<br>
Conta: 12345<br>
Saldo: R$ 750,00<br>
```

**Explicação:**

`Com encapsulamento (private)`: O acesso direto é bloqueado. O `$saldo` só pode ser lido por `consultarSaldo()` e modificado por `depositar()` e `sacar()`, garantindo que as validações matemáticas sejam sempre respeitadas. Além disso, o construtor (`__construct`) obriga que a conta já nasça com seus dados essenciais obrigatoriamente preenchidos.

**2.3 Tentativa 1: `$conta->saldo = -300;`**: `php q07-encapsulamento/teste-protecao.php`

```
Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q07-encapsulamento\conta.php:54
```

**Explicação:**

O erro ocorre porque o atributo $saldo foi definido como private. Com o encapsulamento, o PHP bloqueia qualquer tentativa de alterar a propriedade diretamente de fora da classe, gerando um erro fatal. Isso garante a segurança dos dados, obrigando que as modificações financeiras passem exclusivamente pelas regras de validação dos métodos `depositar()` e `sacar()`.

**2.4 Tentativa 2: `$conta->registrar(...)`**

```
Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q07-encapsulamento\conta.php:54
```

**Explicação:**

Isso acontece porque o método `registrar()` foi definido com a visibilidade private. Assim como ocorre com o atributo $saldo, o encapsulamento também bloqueia o acesso externo a métodos privados. Esse método foi projetado para ser um auxiliar de uso estritamente interno, acionado de forma automática e segura apenas pelos métodos depositar() e sacar().

**2.5 Tentativa 3: `echo $conta->saldo;`**

```
Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo in C:\Users\emyli\Documents\GitHub\pweb1-atividades\aula03-oo\q07-encapsulamento\conta.php:54
Stack trace:
```

**Explicação:**

O erro ocorre porque a visibilidade private bloqueia não apenas a alteração, mas também a leitura direta do atributo de fora da classe. O PHP impede o acesso, e a única forma autorizada de visualizar o valor na tela passa a ser através da chamada do método público

## 3. Perguntas

**a) Por que a conta não tem um método `setSaldo()`?**

Porque a propriedade `$saldo` não deve ser alterada de forma livre. A sua modificação deve ocorrer exclusivamente através das operações de `depositar()` e `sacar()`, garantindo que os valores sempre passem pelas validações de segurança.

**b) Qual a diferença entre a versão original (`echo` + `return`) e a nova (`throw`) quando uma operação é inválida?**

A versão com `echo` e `return` apenas exibe um aviso em texto e deixa o programa continuar rodando. A versão com `throw` lança uma exceção real que interrompe imediatamente a execução do código para barrar a operação inválida com rigor.

**c) O que acontece com o saldo quando um saque é recusado? Use a saída 2.2.**

O saldo permanece inalterado. A validação encerra o método antes que a linha de subtração seja atingida, preservando o valor exato que a conta possuía antes da tentativa.
