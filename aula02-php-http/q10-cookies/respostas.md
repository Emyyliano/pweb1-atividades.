# Questão 10: Cookies e a ordem da resposta HTTP

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `contador.php` | Parte A: criado por você |
| `login.php` | Parte B: código fornecido com erro (corrija no item 1.2) |
| `dashboard.php` | Parte B: criado por você |
| `prints/cookies-application.png` | DevTools, aba Application > Cookies, mostrando o cookie do contador |

> O arquivo `cookies.txt` criado pelo curl **não** deve ser enviado ao GitHub (ele já está no `.gitignore`).

## 1. Análise do código

**1.1 **Parte A:** cole o código do `contador.php` e explique como ele lê e grava o cookie.**

```
<?php
$visitas = (int) ($_COOKIE['visitas'] ?? 0);
$visitas++;
setcookie('visitas', $visitas, time() + 3600);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador com Cookie</title>
</head>
<body>
    <p>Você visitou esta página <?= $visitas ?> vez(es).</p>
</body>
</html>
```

O PHP tenta procurar a informação no navegador usando a variável superglobal `$_COOKIE['visitas']`. O operador (`??`) garante que, se o cookie não existir, o sistema pega o valor padrão 0 em vez de gerar um erro. O (int) converte o dado recebido explicitamente para número.


**1.2 **Parte B:** cole o `login.php` corrigido e o `dashboard.php`, e explique a correção.**

```
<?php
setcookie("usuario_logado", "true", time() + 3600);
header("Location: dashboard.php");
exit;
```

```
<?php
$statusLogado = $_COOKIE['usuario_logado'] ?? "não";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Painel do Usuário</h1>
    <p>Usuário logado: <strong><?= $statusLogado ?></strong></p>
</body>
</html>
```

O erro foi é que PHP não permite o usar funções que modificam cabeçalhos HTTP, como `setcookie()` e `header()`, depois de imprimir qualquer coisa na tela. Quando o echo é disparado, o PHP fecha o envio de cabeçalhos e começa a desenhar o corpo da página, travando os cookies e o redirecionamento.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Parte A:** saída de `curl.exe -i http://localhost:8000/q10-cookies/contador.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 12:48:28 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: visitas=1; expires=Wed, 14 Oct 2026 13:48:28 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador com Cookie</title>
</head>
<body>
    <p>Você visitou esta página 1 vez(es).</p>
</body>
</html>
```

**Explicação linha por linha:**

`Set-Cookie:`: indica para o navegador que é para savlar a informação na memória dele

`visitas=1;`: define o nome do cookie, e valor atribuido a ele

`expires=Wed, 14 Oct 2026 13:48:28 GMT;`: data de expirar do arquivo, quando der essa hora, o arquivo vai se apagar

`Max-Age=3600`: tempo de validade do arquivo, escrito em segundos (3600seg = 1h). Se tiver essa função junto do `expires=Wed`, o navegador prioriza o `Max-Age`.

`Você visitou esta página 1 vez(es)`: o valor não sai de 1, pois o curl não envia cookies igual um navegador, então não tem como o contador aumentar

**2.2 **Parte A:** saída de `curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php`, executado **três vezes** (cole a terceira)**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 13:12:52 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: visitas=3; expires=Wed, 14 Oct 2026 14:12:52 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador com Cookie</title>
</head>
<body>
    <p>Você visitou esta página 3 vez(es).</p>
</body>
</html>
```

**Explicação linha por linha:**

`Set-Cookie: visitas=3;`: com essa nova requisição, o curl começa analisando o arquivo `cookies.txt` antes da página, depois de que acessa a página ele envia o cabeçalho já com `visitas=1`, então código vai e soma +1 e devolve com o `visitas=2` e depois o curl atualiza o arquivo `cookies.txt`, com a nova atribuição

**2.3 **Parte B, antes da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 13:34:58 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

Carregando a página...<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula02-php-http\q10-cookies\login.php:2) in <b>C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula02-php-http\q10-cookies\login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula02-php-http\q10-cookies\login.php:2) in <b>C:\Users\emyli\OneDrive\Documentos\GitHub\pweb1-atividades\aula02-php-http\q10-cookies\login.php</b> on line <b>4</b><br />

```

**Explicação linha por linha:**

`Warning: Cannot modify header information - headers already sent by...`: "Aviso: Não é possível modificar a informação do cabeçalho - os cabeçalhos já foram enviados por...", isso se deu pelo fato do echo estar primeiro que as regras de cookie, quando isso acontece meio que o echo que é uma parte do corpo foi executada, a parte de regras que fica invisivel, não conseguem ser enviadas.

**2.4 **Parte B, depois da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```
HTTP/1.1 302 Found
Host: localhost:8000
Date: Wed, 14 Oct 2026 13:54:11 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: usuario_logado=true; expires=Wed, 14 Oct 2026 14:54:11 GMT; Max-Age=3600
Location: dashboard.php
Content-type: text/html; charset=UTF-8

Carregando a página...
```

**Explicação linha por linha:**

`302 Found`: quando o curl lê o código ele começa a gerar o cookie, mas quando chega no `header("Location: dashboard.php");`, ele para a exucução e envia apenas a resposta `302 Found`,direcionando para a página do dashboard.

## 3. Perguntas

**3.1 No item 2.1, qual cabeçalho da resposta grava o cookie? E por que o contador não passa de 1 se você repetir o comando sem `-c` e `-b`?**

O responsável por guardar o cookie é o `Set-Cookie`

**3.2 No item 2.2, o que fazem as opções `-c` e `-b`? O que isso prova sobre quem "lembra" do usuário no HTTP?**

Sem o parâmetro -c (que salva o cookie recebido do servidor) e o -b (que envia esse cookie de volta na próxima requisição), o curl não exibe nenhum histórico para o servidor.

**3.3 No item 2.3, qual aviso apareceu e por que o redirecionamento não aconteceu?**

`Warning: Cannot modify header information - headers already sent by...`: "Aviso: Não é possível modificar a informação do cabeçalho - os cabeçalhos já foram enviados por...", isso se deu pelo fato do echo estar primeiro que as regras de cookie e header, quando isso acontece meio que o echo que é uma parte do corpo foi executada, a parte de regras que fica invisivel, não conseguem ser enviadas.

**3.4 No item 2.4, explique o status, o cabeçalho `Location` e o cabeçalho `Set-Cookie`. Por que `setcookie()` e `header()` precisam vir antes de qualquer `echo`?**

`302 Found`: quando o curl lê o código ele começa a gerar o cookie, mas quando chega no `header("Location: dashboard.php");`, ele para a exucução e envia apenas a resposta `302 Found`,direcionando para a página do dashboard.

`header("Location: dashboard.php");`: serve para redirecionar o usuário pra página destinada.

`Set-Cookie`: serve para o servidor enviar uma ordem direta ao navegador, dizendo pra guardar aquela informação ques está dentro dos `()`

Elas precisam vir antes, pois são regras, elas ficam invisíveis no código, já o `echo` é uma parte do corpo ou seja, quando o navegador lê o código ele já gera a página a partir do `echo`que aparece primeiro, e meio que deixa de fora o `setcookie()` e `header()`.