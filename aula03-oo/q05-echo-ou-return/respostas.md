# Questão 05: `echo` ou `return`?

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `retangulo.php` | Fornecido com métodos que imprimem. Você refatora |

## 1. Análise do código

**1.1 Cole a versão refatorada da classe e explique o que mudou em cada método.**

```
<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public float $largura;
    public float $altura;

    public function area(): float
    {
        return $this->largura * $this->altura;
    }

    public function perimetro(): float
    {
        return 2 * ($this->largura + $this->altura);
    }

    public function mostrarResultado(): void
    {
        $area = $this->area();
        $perimetro = $this->perimetro();
        echo "Área: {$area}<br>";
        echo "Perímetro: {$perimetro}<br>";
    }
}

$sala = new Retangulo();
$sala->largura = 8;
$sala->altura = 6;
$sala->mostrarResultado();

```

**1.2 Explique como o total da área foi calculado no `foreach`.**

No laço foreach, uma lista de objetos Retangulo foi percorrida e o resultado do método `area()` de cada um foi somado dentro de uma variável acumuladora (como `$somaTotal += $retangulo->area();`). Esse cálculo só foi possível porque o método foi refatorado para utilizar `return` e devolver um número `float`. Se a tipagem ainda fosse void utilizando echo, o sistema não conseguiria realizar a operação matemática e geraria um erro.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q05-echo-ou-return/retangulo.php`

```
Área: 48<br>Perímetro: 28<br>
```

**Explicação:**

É exibido a resultado da área e do perímetro do retangulo

**2.2 Saída do teste `var_dump($sala->area())` na versão original (item 2)**

```
Área: 48
Perímetro: 28
Área: 48
NULL
```

**Explicação:**

Como o método original `area()` possui o tipo de retorno `void`, a função `var_dump()` recebe apenas um vazio. Como resultado, ela avalia essa ausência de dados e imprime `NULL`.

**2.3 Saída da versão refatorada**

```
Área: 48
Perímetro: 28
float(48)
```

**Explicação:**

O resultado mudou para `float(48)` porque o método `area()` foi refatorado para o tipo de retorno `float` em vez de `void`. Ao substituir o comando echo pelo `return`, o método deixou de imprimir o texto diretamente na tela e passou a devolver o resultado matemático para o sistema. Com isso, a função `var_dump()` agora consegue capturar e exibir exatamente o valor numérico calculado e o seu tipo.

## 3. Perguntas

**a) O que um método `void` devolve? Use a saída 2.2 para responder.**

Um método `void` não devolve nenhum dado. Na saída 2.2, o `var_dump()` imprimiu `NULL` justamente porque o método apenas exibiu um texto na tela e entregou um valor vazio ao sistema.

**b) Por que não dava para somar as áreas na versão original?**

Porque o método original retornava `void`. Como ele apenas imprimia o resultado com echo e não devolvia o número, qualquer tentativa de somar esses valores vazios geraria um erro no `PHP` (`TypeError`).

**c) Cite uma situação em que um método com `echo` faz sentido.**

Faz sentido quando a única função do método é atuar como um "visor" ou relatório (como os métodos `imprimir()` ou `mostrarStatus())`, servindo exclusivamente para exibir no terminal os dados que já foram processados.
