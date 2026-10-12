# Questão 09: Método HTTP e código de status

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `api.php` | Criado por você, conforme o enunciado |

## 1. Análise do código

**1.1 Cole o código do `api.php` e explique cada parte: a verificação do método, o status, os cabeçalhos e o JSON.**

```
<?php
header('Content-Type: application/json; charset=utf-8');

$metodo = $_SERVER['REQUEST_METHOD'];
if ($metodo !== 'POST') {
    http_response_code(405);
    header('Allow: POST');  
    echo json_encode(["erro" => "Método não permitido"], JSON_UNESCAPED_UNICODE);
    exit;
}
http_response_code(200);
echo json_encode(["sucesso" => "Dados recebidos"], JSON_UNESCAPED_UNICODE);
```

`header('Content-Type: application/json; charset=utf-8');`: modifica o cabeçalho da resposta para definir o tipo do arquivo como json

`$_SERVER`: é uma variável especial ela guarda automaticamente as informações do servidor, ambiente e a requisição

`['REQUEST_METHOD'];`: como o nome sugere, é o método que diz como a página foi solicitada

`if ($metodo !== 'POST')`: como dito antes, o `['REQUEST_METHOD'];` vai dizer a requesição e o `if`vai fazer a condição caso o método seja diferente de `POST`.

`http_response_code(405);`: muda o código de status HTTP da resposta para 405, "Method Not Allowed" que quer dizer que o método escolhido tá errado

`header('Allow: POST');`: envia um cabeçalho de resposta dizendo que apenas o método `POST`é usado

`echo json_encode(["erro" => "Método não permitido"], JSON_UNESCAPED_UNICODE);`: pega o array de erro do PHP, converte pro formato de texto json, permitindo os caracteres especiais e exibindo a mensagem do `echo`

`exit`: para o programa, para que ele não continue lendo o resto do código

`http_response_code(200);`: da o status de OK, que o método é o `POST`

`echo json_encode(["sucesso" => "Dados recebidos"], JSON_UNESCAPED_UNICODE);`: imprime a mensagem de sucesso e que os dados foram recebidos.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Mon, 12 Oct 2026 02:34:52 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

`405 Method Not Allowed`: como dito antes, ele indica que o método escolhido não é o correto ou que não é permitido

`Allow: POST`: a mensagem dizendo que o método que é aceito é o `POST`

`{"erro":"Método não permitido"}`: mensagem de que não é permitido o método

**2.2 Saída de `curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 02:52:54 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8

{"sucesso":"Dados recebidos"}
```

**Explicação linha por linha:**

`200 OK`: status de sucesso e o método é o `POST`

`{"sucesso":"Dados recebidos"}`: mensagem de sucesso

**2.3 Saída de `curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Mon, 12 Oct 2026 02:54:21 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

Memsa coisa da 2.1, só aceita o método `POST`, se não o código não funciona

**2.4 Log do servidor das três requisições**

```
[Sun Oct 11 23:34:52 2026] [::1]:65200 Accepted
[Sun Oct 11 23:34:52 2026] [::1]:65200 [405]: GET /api.php
[Sun Oct 11 23:34:52 2026] [::1]:65200 Closing
[Sun Oct 11 23:52:54 2026] [::1]:65356 Accepted
[Sun Oct 11 23:52:54 2026] [::1]:65356 [200]: POST /api.php
[Sun Oct 11 23:52:54 2026] [::1]:65356 Closing
[Sun Oct 11 23:54:21 2026] [::1]:53300 Accepted
[Sun Oct 11 23:54:21 2026] [::1]:53300 [405]: PUT /api.php
[Sun Oct 11 23:54:21 2026] [::1]:53300 Closing
```


**Explicação linha por linha:**

`[405]: GET /api.php`: método `GET`, logo error 405

`[200]: POST /api.php`: método `POST`, único método que pode ser aceito

`[405]: PUT /api.php`: método `PUT`, mesma coisa, bem redundante inclusive, da erro igual

## 3. Perguntas

**3.1 Que método o navegador usa ao abrir o endereço? Qual status ele recebe?**

Usa o método `GET`, recebe o `405 Method Not Allowed`, pois o navegador sempre faz uma requisição `GET

**3.2 Para que serve o cabeçalho `Allow`?**

Do inglês "Permitir" ou seja, permite apenas o `POST`

**3.3 No log, onde aparecem o método e o status de cada requisição?**

No terminal do servidor e no Console do navegador
