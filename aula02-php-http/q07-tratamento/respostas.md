# Questão 07: O dado pode não vir, o dado pode ser perigoso

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `saudacao.php` | Código fornecido, que você vai corrigir no item 1.2 |

## 1. Análise do código

**1.1 Quais são os dois problemas deste código?**

`$nome = $_GET['nome'];`: por não ter nenhum nome fixo, o GET tenta procurar na URL mas não encontra nada, por isso da um erro de ( Undefined array key "nome" )

E caso digite um nome com caractere com acento ou especial, não vai ser interpretado

**1.2 Corrija o código usando `??` (valor padrão "Visitante") e `htmlspecialchars`. Faça um commit **antes** e outro **depois** da correção. Cole o código corrigido e explique.**

```
<?php
$nome = $_GET['nome']?? "Visitante";
echo "Olá, " . htmlspecialchars($nome);
```

`?? "Visitante";`: quando eu acessar o site mesmo sem digitar nenhum nome na URL, ele vai funcionar

`htmlspecialchars($nome);`: como o prórprio nome sugere, ele permite caracteres especiais sejam lidos pela URL 

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Antes da correção**: log do servidor ao abrir `saudacao.php` sem parâmetro**

```
[Sun Oct 11 18:13:41 2026] [::1]:53913 Accepted
[Sun Oct 11 18:13:41 2026] PHP Warning:  Undefined array key "nome" in ...\pweb1-atividades\aula02-php-http\q07-tratamento\saudacao.php on line 2
[Sun Oct 11 18:13:41 2026] [::1]:53913 [200]: GET /saudacao.php
[Sun Oct 11 18:13:41 2026] [::1]:53913 Closing
```

**Explicação linha por linha:**

`PHP Warning:  Undefined array key "nome" in ..\pweb1-atividades\aula02-php-http\q07-tratamento\saudacao.php on line 2`: quer dizer que quando o usuário entra no site sem colocar nenhum nome da URL, ele interpreta que não tem nada definido para "nome" o que gera esse erro

Mesmo tendo esse erro o site abre, porque o problema não é na sintaxe, e sim na parte de atribuir valor a variável.

**2.2 **Antes da correção**: saída de `curl.exe -s "http://localhost:8000/q07-tratamento/saudacao.php?nome=<b>Oi</b>"`**

```
Olá, <b>Oi</b>
```

**Explicação linha por linha:**

Oi foi atribuido na URL por isso o site interpreta corretamente, e também não possui caracteres especiais

**2.3 **Depois da correção**: saída do mesmo comando do item 2.2**

```
Olá, &lt;b&gt;Oi&lt;/b&gt;
```

**Explicação linha por linha:**

com o `htmlspecialchars($nome);` ele interpreta tudo que tem na mensagem ( <>, /,), que estão incluidos na URL já que são caracteres especias, o `$lt` significa *less than* e `$gt` *greater than*, menor que, e maior que o `b`é o b mesmo

## 3. Perguntas

**3.1 Qual aviso apareceu no item 2.1? O que ele significa?**

`Undefined array key "nome"`: singnifica que não tem nada dentro da variável "nome", pois não foi alocado nada na URL, nem com `??`

**3.2 Compare o corpo da resposta em 2.2 e 2.3. O que o `htmlspecialchars` fez com `<b>`?**

ele apenas leu o `<b>`, o menor que e maior que, e o b

**3.3 Teste no navegador `?nome=<script>alert('Ataque')</script>` antes e depois da correção. Explique o que aconteceu e por que isso é perigoso (XSS).**

Antes da correção apareceu um `alert` na tela, escrito "Ataque", depois do `htmlspecialchars`, ele não apareceu mais.

Sem o `htmlspecialchars`, o navegador lê o script inteiro, ja com, ele não lê as `<>`, deixando elas convertidas `Olá, &lt;script&gt;alert(&#039;Ataque&#039;)&lt;/script&gt;` e assim o script não é executado 
