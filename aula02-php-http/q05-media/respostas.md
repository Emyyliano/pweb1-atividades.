# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, que você vai modificar no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

*const*: significa constante, que mantem a variável do jeito que ela foi criada e não pode ser trocada por outro valor.
*$media = ($n1 + $n2) / 2;*> o parentese é o básico de LLP, ela separa o calculo do restante da conta, e prioriza ele, na conta ele prioriza a soma e depois faz a divisão.
*?*: em termos de python seria o if
*:*: em termo de python seria o else

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

```
$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
```
*$_GET['n1/n2']*: ele pega o valor atribuido ao n1 pela URL então se eu escrever ?n1=9, ele pega o valor "9", que vem como string e o PHP converte pra inteiro ou float caso seja decimal
*?? 0*: basicamente se não for atribuido nenhum valor a n1 ou n2, ele substitui pelo 0 que foi fixado a variavel
## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

```
<p>Notas: 5 e 6</p>         
<p>Média: 5.5</p>       
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

mesma coisa da questão anterior, na URL é atribuido os dois valores e o código faz o resto, soma, faz média e depois entra na condição, se for >= 7 é aprovado se não, reprova

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

```
<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

como dito antes, como não foi atribuido nenhum valor a n2, o ?? substituiu pelo valor fixo, no caso 0

**2.3 Log do servidor das duas requisições acima**

```text
[Sun Oct 11 13:58:04 2026] [::1]:56730 Accepted
[Sun Oct 11 13:58:04 2026] [::1]:56730 [200]: GET /media.php?n1=5&n2=6
[Sun Oct 11 13:58:04 2026] [::1]:56730 Closing

[Sun Oct 11 14:05:09 2026] [::1]:49552 Accepted
[Sun Oct 11 14:05:09 2026] [::1]:49552 [200]: GET /media.php?n1=9
[Sun Oct 11 14:05:09 2026] [::1]:49552 Closing
```

**Explicação linha por linha:**

*GET*: método de requisão que vai puxar da URL
*200*: status que carregou o site com sucesso 
*/media.php?n1&n2*: caminho da requesição e o querystring, o que vem depois da ?

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

*?n1=5&n2=6*: os valores aparecem após a ?, no fim da URL

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

o valor enviado foi 0, o operador responsável foi o ?, que garante um "valor" fixo, quando tem a ausencia de um atribuido a variável. 

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

n1 acaba recebendo o valor 0, devido o ? atribuido com o 0. O float faz o papel de encontrar número inteiros e decimais, como abc não é número ele atribui o 0.
