# Questão 06: Strings e acentuação

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `palavra.php` | Código fornecido, que você vai completar no item 1.2 |

> Se aparecer `Call to undefined function mb_strlen()`, ative a linha `extension=mbstring` no seu `php.ini` e reinicie o servidor. Registre isso na resposta 3.3.

## 1. Análise do código

**1.1 Explique o código original linha por linha.**

`$palavra = $_GET['palavra'] ?? "Ceara";`: basicamente é a mesma lógica da q05, só que com string, o site pode receber atravez da URL uma string qualquer e exibir o conteudo e quantas letras ela tem, no caso se for alocado nenhum "valor" a ($palavra), ela vai exibir "Ceara"

`echo "Palavra: $palavra";`: exibe o conteudo que foi alocado na variável, ou então só mostra "Ceara"

`echo "strlen: " . strlen($palavra) . ";`: strlen vai contar quantas letras possui a string, e retornar o número quantitativo 

**1.2 Complete o código para mostrar também: `mb_strlen`, `strtoupper`, `mb_strtoupper` e uma classificação com `if`: "palavra curta" (até 5 letras) ou "palavra longa". Use `mb_strlen` na classificação. Cole o código e explique.**

```
if (mb_strlen($palavra) >= 5) {
    echo "<p>Plavra longa<p>";
}else {
    echo "<p>Plavra curta<p>";
}
```

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"`**

```
<p>Palavra: Ceara</p><p>strlen: 5</p><p>mb_strlen: 5</p><p>strupper: CEARA</p><p>mb_strupper: CEARA</p><p>Plavra longa<p>
```

**Explicação linha por linha:**

`Palavra: Ceara`: basicamente exibindo a string que foi digitada na URL

`strlen: 5`: quantas letras tem a palavra "Ceara" em bytes

`mb_strlen: 5`: quantas letras realmente possui a palavra

**2.2 Abra no navegador `palavra.php?palavra=Ceará` e cole a linha do log do servidor**

```
[Sun Oct 11 17:24:13 2026] [::1]:55692 Accepted
[Sun Oct 11 17:24:13 2026] [::1]:55692 [200]: GET /palavra.php?palavra=Cear%C3%A1
[Sun Oct 11 17:24:13 2026] [::1]:55692 Closing
```

**Explicação linha por linha:**

`.../palavra.php?palavra=Cear%C3%A1`: 

deu esse monte caractere estranho, porque os links são no padrão ASCII, que naturamente interpreta o inglês, então acentos não conseguem ser interpretados

## 3. Perguntas

**3.1 Compare o `strlen` de "Ceara" e de "Ceará". Por que o acento muda o resultado?**

porque o strlen, faz a contagem atravez dos bytes da palavra, uma letra com acento conta como 2 bytes, por isso contou (6). Já o mb_strlen conta realmente o total de caracteres (5).

**3.2 No log, a palavra aparece como `Cear%C3%A1`. O que é isso? Por que o navegador transformou o "á"?**

como eu disse antes: deu esse monte caractere estranho, porque os links são no padrão ASCII, que naturamente interpreta o inglês, então acentos não conseguem ser interpretados

**3.3 Qual a diferença entre `strtoupper` e `mb_strtoupper` com a palavra "Ceará"?**

`strtoupper`: como ele só lê o alfabeto básico sem acentos, ele acaba não entendo o á, e deixa como tava.

`mb_strtoupper`: já ele entende os acentos por interpretar UTF-8, então o Á fica maiusculo.
