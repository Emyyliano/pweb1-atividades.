# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrija no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

`Parse error: syntax error, unexpected token "echo" in...on line 11`

`Parse error: syntax error, unexpected token "<", expecting end of file in... on line 13`

O código aponta dois erros de sintaxe, tanto (;), quanto o (?>), exibem um error diferente, por mais que o problema não seja necessariamente o echo mas, sim o que tem antes dele

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

```
Host: localhost:8000
Date: Sat, 10 Oct 2026 17:05:25 GMT
Connection: close
...

<br />
<b>Parse error</b>:  syntax error, unexpected token &quot;echo&quot; in <b>C:...\GitHub\pweb1-atividades\aula02-php-http\q02-erros\erro.php</b> on line <b>11</b><br />
```

**Explicação linha por linha:**

O que exibe é o mesmo da q01, apenas o site em si, que mostra os erros

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

```
HTTP/1.0 500 Internal Server Error
Host: localhost:8000
Date: Sat, 10 Oct 2026 15:57:27 GMT
Connection: close
```

**Explicação linha por linha:**

*500 Internal Server Error*: significa que erro aconteceu dentro do servidor, no caso no código

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

`erro na line 11`: o PHP enterpretou o código como se fosse uma linha só, pela falta de ; o foi lido assim ($curso = "ADS" echo "Bem-vindo ao curso de $curso";), em uma linha só ai o erro deu como see fosse no echo que estaria no lugar errado.

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

`200`: quer dizer que a requesição HTTP foi aceita e ele abre o acesso pro site mesmo tendo um erro no código.

`500`: fatal error no servidor, indica que tem algo errado no codigo e o usuário não pode acesssar.

O correto é o `500`, pois no caso do `200`, você acessar um site mesmo ele tendo um erro de sintaxe, é um mal para segurança do servidor, então o erro de `page not found`, é a forma mais segura.

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sat, 10 Oct 2026 17:22:26 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Bem-vindo ao curso de ADS</body>
</html>
```