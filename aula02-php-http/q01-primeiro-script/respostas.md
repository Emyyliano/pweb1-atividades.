# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**
Das linhas 1 a 7;11 a 12 são HTML. Das linhas 8 a 10 são PHP

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**
`<?php echo ... ?>` é o comando padrão do `echo` no PHP, já `<?= ... ?>` é apenas um atalho para o mesmo comando echo.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor (as linhas que apareceram no terminal do `php -S` ao abrir a página no navegador)**

```
[Wed Oct  7 15:53:35 2026] PHP 8.5.11 Development Server (http://localhost:8000) started
[Wed Oct  7 15:53:40 2026] [::1]:62240 Accepted
[Wed Oct  7 15:53:40 2026] [::1]:62240 [200]: GET /ola.php
[Wed Oct  7 15:53:40 2026] [::1]:62240 Closing
```

**Explicação linha por linha:**
*[Wed Oct  7 15:53:35 2026]*: data e hora que o servidor foi iniciado;
*PHP 8.5.11*: a versão do meu PHP;
*Development Server*: confirma que é o servidor de desenvolvimento;
*(http://localhost:8000)*: endereço que o servidor criou;
*started:*: indica que ele foi iniciado.
*[::1]*: abreviação de localhost, está acessando minha máquina;
*:62240*: porta selecionada para o navegador usar;
*Accepted*: aceito.
*[200]*: código de status da resposta de (OK);
*GET*: método que o navegador usou;
*/ola.php*: nome do arquivo;
*Closing:*: ta fechado, o servidor enviou o conteúdo pro arquivo;

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 19:25:33 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: text/html; charset=UTF-8
Content-Length: 628

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Questão 01</title>
</head>
<body>
    <h1>Olá, turma!</h1>
    <p>Este texto foi escrito pelo PHP.</p>
    <p>Hora no servidor: 22:56:30</p>
</body>
</html>
*O horário está diferente porque no IF, eu coloquei o comando curl.exe com o caminho errado*
```

**Explicação linha por linha:**

*HTTP/1.1*: versão do http 
*200 OK*: status da resposta, informa que deu tudo certo;
*Host: localhost:8000*: enedereço e a porta que sendo acessado;
*Date: Wed, 07 Oct 2026 19:25:33 GMT*: indica a data hora;
*Connection: close*: a conexão vai ser encerrada quando retornar a resposta;
*X-Powered-By: PHP/8.5.11*: indica a tecnologia usada, no caso o PHP e a versão dele;
*Content-Type: text/html; charset=UTF-8*: é um informativo pro navegador que é um documento em HTML e usa os caracteres UTF-8 (, ´ , ~ , ^);
*Content-Length: 628*: indica o tamanho do corpo da resposta em bytes
## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

[Wed Oct  7 19:43:28 2026] [::1]:64367 Accepted
[Wed Oct  7 19:43:28 2026] [::1]:64367 [200]: GET /ola.php
[Wed Oct  7 19:43:28 2026] [::1]:64367 Closing

O código apenas abre a requesição, porque o usuário está "logando" novamente e depois que ele entra no site regista (hora, data, o que usou, versão do PHP e etc.), e depois fecha.
**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não, os códigos em PHP só são visíveis do lado do servidor. já que navegadores não são programados para interpretar essa linguagem, por isso exibe o resultado final (HTML).

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**
*1 Linha do Cabeçalho:*: Indica a versão do HTTP e status da resposta.
*Content-type*: é um informativo pro navegador que é um documento em HTML e usa os caracteres UTF-8
*X-Powered-By*: indica a tecnologia usada

