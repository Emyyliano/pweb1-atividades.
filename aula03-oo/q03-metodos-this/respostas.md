# Questão 03: Métodos e `$this`

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aluno.php` | Fornecido com os métodos a completar |

## 1. Análise do código

**1.1 Cole o código dos três métodos que você escreveu e explique cada um.**

```
    public function calcularMedia(): float {
        $soma = $this->nota1 + $this->nota2;
        return $soma / 2;

    }

    public function situacao(): string {
        $media = $this->calcularMedia();
        if ($media >= 7){
            return "Aprovado";
        }elseif ($media >= 4){
            return "Recuperação";
        }else{
            return "Reprovado";
        }
    }

    public function apresentar(): void {
        $media = $this->calcularMedia();
        $situacao = $this->situacao();

        $exibirMedia = number_format($media, 1, ',', '.');

        echo "{$this->nome}: média {$exibirMedia} ({$situacao})<br>";
    }
```

`public function calcularMedia(): float`: vai fazer a soma das notas `$nota1` e `$nota2` e fazer a média

`public function situacao(): string`: já nessa função, ela faz uma condição, caso o aluno tenha uma média `>= 7`, ele tá aprovado mas, se tiver `>= 4`, ele tá de AF, mas se tiver abaixo disso tá reprovado

`public function apresentar(): void`: essa função é a responsável por exibir as informações de `$nome`, `$media` e se foi aprovado ou não

**1.2 Classifique os três métodos: de ação, com retorno, com parâmetros, modificador ou de consulta? Justifique.**

`calcularMedia()`: Com retorno e de consulta. Usa return para devolver a média e apenas lê os valores, sem alterar os dados originais.

`situacao()`: Com retorno e de consulta. Usa return para devolver o texto e apenas analisa o resultado da média.

`apresentar()`: De ação. Executa uma tarefa direta (imprime na tela com echo) e é void (não devolve nenhum dado para o sistema).

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q03-metodos-this/aluno.php`

```
Ana: média 8,8 (Aprovado)<br>Bruno: média 5,5 (Recuperação)<br>Caio: média 2,8 (Reprovado)<br>
```

**Explicação:**

Exibe todos os nomes, médias e a situação do aluno, se passou ou não

**2.2 Saída com o quarto aluno (notas 6,5 e 7,5)**

```
Ana: média 8,8 (Aprovado)<br>Bruno: média 5,5 (Recuperação)<br>Caio: média 2,8 (Reprovado)<br>Emy: média 7,0 (Aprovado)<br>
```

**Explicação:**

Colocando as novas notas para um novo aluno, ele já exibe a média e que ele foi aprovado

## 3. Perguntas

**a) Por que `situacao()` chama `$this->calcularMedia()` em vez de repetir a conta?**

Isso é feito para evitar a repetição de código e facilitar a manutenção. Se a fórmula da nota mudar no futuro, basta atualizar apenas o método calcularMedia(), evitando o trabalho duplo e o risco de gerar bugs ao esquecer de alterar a regra na situacao().

**b) Com média exatamente 7,0, qual é a situação? Qual linha do código decide isso?**

Com média 7, a situação é `Aprovado`, já que pra ser aprovado precisa tirar 7 pra cima.

A linha que decide isso é 20: `if ($media >= 7)`

**c) O método `apresentar()` foi escrito uma vez. Como ele sabe se deve mostrar a Ana ou o Bruno?**

O método sabe qual aluno mostrar graças à variável especial $this->. Ela atua como uma referência dinâmica que aponta sempre para o objeto exato que chamou a função naquele momento. Ou seja, quando o código executa $ana->apresentar(), o $this-> lê os dados guardados dentro do objeto $ana. Quando o sistema executa $bruno->apresentar(), o $this-> aponta automaticamente para os dados do objeto $bruno.
