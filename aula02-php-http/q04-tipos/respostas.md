# Questão 04: Tipos e conversões

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `tipos.php` | Código fornecido (no item 3.3 você vai acrescentar linhas) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o tipo e o valor de cada linha.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"10" + 5` | int 15 | int(15) |
| `"10" . 5` | str 105 | string(3) "105" |
| `7 / 2` | float 3.5 | float(3.5) |
| `7 % 2` | int 1 | int(1) |
| `(int) "3.9 kg"` | int 3kg | int(3) |
| `(bool) "0"` | false | bool(false) |
| `(bool) "false"` | false | bool(true) |
| `0.1 + 0.2 == 0.3` | true | bool(false) |**

int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q04-tipos/tipos.php`**

```
<pre>int(15)                        
string(3) "105"      
float(3.5)                
int(1)
int(3)
bool(false)
bool(true)
bool(false)
</pre>
```

**Explicação linha por linha:**

*"10" + 5*: o PHP ele consegue fazer essa interpretação mesmo 0 10 sendo uma string: 15
*"10 . 5*: já aqui não, pois ele não está usando nenhum sinal matemático, apenas concatenando, então da mesma forma que ele transforma o 10 em inteiro, nesse caso foi o 5 em string.
*7 / 2*: calculo normal e já sabe que é um float: 3,5
*7 % 2*: o resto da divisão é 1, logo é um inteiro
*(int)"3.9 kg"*: o PHP transforma essa string em inteiro, logo não pode ser um numero decimal e nem ter texto, então ele corta o (.9) e o (kg).
*(bool)"0"*: no PHP para algo ser false, a string ou tem que ter o 0 ou estar vazia " ".
*(bool)"false"*: para ser true, só precisar haver texto dentro da string, mesmo estando escrito "false"
*0.1 + 0.2 == 0.3*: bom pelo que eu vi, o computador sempre vai interpretar números decimais com dízimas periódicas infinitas, então seria 0.1000000 e 0.200000 e uns números depois então quando compara com 0.3, acaba sendo false.

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

"+" é uma expressão matemática, o PHP ele converte mesmo sendo uma string, logo fica (15). Já o outro está concatenando, então ele converte o número para uma string, ficando ("105") 

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

porque uma string tendo 0 ou vazia, é interpretado como false, já o "false", possui 5 letras nela, então é true, porque possui um "valor" detro dela, mesmo sendo escrito false.

**3.3 Acrescente ao arquivo duas linhas `var_dump` criadas por você, com resultados que te surpreenderam ou que você achou interessantes. Explique cada uma.**

```
string(6) "3.9 kg"
float(3.9)
```
usei a mesma lógica do (int) "3.9 kg", com os dois tipos de "valores" string e float.
*string(6) "3.9 kg"*: ele exibe exatamente o que tem lá, porque inicialmente já era uma string
*float(3.9)*: já aqui como é uma converção pra float, ele só considera números, então o (kg) é cortado.