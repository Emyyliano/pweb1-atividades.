# Questão 08: O que o navegador entende? (Content-Type)

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `dados.php` | Código fornecido. No item 2.2 você vai descomentar a linha do header |
| `prints/devtools-html.png` | DevTools com o Content-Type antes de descomentar |
| `prints/devtools-json.png` | DevTools com o Content-Type depois de descomentar |

## 1. Análise do código

**1.1 Explique o que fazem `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`.**

`json_encode`: converte os daddos em uma string no formato json

`JSON_PRETTY_PRINT`: basicamente ele arruma a bagunça do `json_encode` quando ele converte os dados, quebrando linhas e espaços 

`JSON_UNESCAPED_UNICODE`: é o `htmlspecialchars` só que pra json, ele faz com que os caracteres especiais sejam exibidos corretamente

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q08-content-type/dados.php` com o header **comentado****

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 00:38:20 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

Bom aconteceu exatamente o que foi dito, ele foi convertido pra json, organizado e imprimido

**2.2 Saída do mesmo comando com o header **descomentado****

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 00:46:30 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

`Content-Type:`: nome do cabeçalho, diz o tipo do conteúdo

`application/json;`: significa que é uma aplicação json, então no site não exibirá o html padrão

`charset=utf-8`: é o mapa dos caracteres especiais

Bom aconteceu exatamente o que foi dito, ele foi convertido pra json, organizado e imprimido

## 3. Perguntas

**3.1 Compare o cabeçalho `Content-Type` nas duas saídas. O que mudou?**

Um possui `text/html;`, e o outro `application/json;`, significa que o navegador vai interpretar em html e outro em json, tipo um terminal

**3.2 O corpo da resposta mudou? O que isso mostra sobre quem decide como o conteúdo é interpretado?**

O corpo da resposta é o mesmo, o que muda é como o navegor interpreta o todo, em html ou em json, ou seja, quem decide é o cliente/usuário

**3.3 Retire o `JSON_UNESCAPED_UNICODE`, rode o curl de novo e explique o que aconteceu com "Programação".**

`"disciplina": "Programa\u00e7\u00e3o Web I",`: como o responsável pelos caracteres especiais foi retirado do código, ele não consegue interpretar o "ção" da palavra.
