# Questão 04: Tipos de métodos

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `termostato.php` | Fornecido. Você acrescenta dois métodos no item 4 |

## 1. Análise do código

**1.1 ANTES de executar, classifique os métodos:**

| Método | Tipo de retorno | Recebe parâmetro? | Altera o objeto? | Tipo do método |
|---|---|---|---|---|
| `getTemperatura()` | float | Não | Não  | Getter |
| `definirAlvo()` | void | Sim($alvo) | Sim | Setter |
| `resfriar()` | void | Sim($graus) | Sim | Modificador |
| `precisaResfriar()` | bool | Não | Não | Consulta |
| `mostrarStatus()` | void | Não | Não | Ação |

**1.2 ANTES de executar, escreva as 5 linhas que você espera ver na saída:**

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
```

**1.3 Cole os dois métodos novos (`aquecer` e `diferencaParaAlvo`) e classifique cada um.**

```
    public function aquecer(float $graus): void 
    {
        $this->temperatura += $graus;
    }

    public function diferencaParaAlvo(): float 
    {
        return abs($this->temperatura - $this->alvo);
    }
```

`aquecer()`: É um método Modificador / De ação (com retorno void)

`diferencaParaAlvo()`: É um método De consulta (com retorno float)

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q04-tipos-de-metodos/termostato.php`

```
Laboratório 1: 25 °C (alvo 22 °C) - resfriando<br>Laboratório 1: 23 °C (alvo 22 °C) - resfriando<br>Laboratório 1: 23 °C (alvo 24 °C) - ok<br>33<br>bool(false)
```

**Explicação:**

Faz a comparação da temperatura do laboratório e o graus de que ela deve estar

**2.2 Saída com os métodos novos**

```
Laboratório 1: 28 °C (alvo 24 °C) - resfriando<br>
```

**Explicação:**

Como indicado no programa, ele aqueceu o local

## 3. Perguntas

**a) Sua previsão do item 1.2 acertou todas as linhas? Explique cada diferença.**

Sim, todas certas

**b) Por que `echo $sala->getTemperatura() + 10` funciona, mas `$sala->mostrarStatus() + 10` não faria sentido?**

Porque o `$sala->getTemperatura()` me devolve um número (`float`) através do return, permitindo que o PHP faça a soma matemática. Já o `$sala->mostrarStatus()` é do tipo void (não devolve nenhum dado, apenas imprime texto na tela), então tentar somar + 10 com algo "vazio" causaria um erro fatal no PHP (`TypeError`).

**c) Qual método chama outro método do mesmo objeto?**

O método que faz isso é o `mostrarStatus()`. Dentro dele, o método `$this->precisaResfriar()` é chamado para avaliar automaticamente se o texto impresso na tela deve exibir a palavra "resfriando" ou "ok". Isso é feito utilizando o `$this->` para reaproveitar a verificação matemática sem a necessidade de reescrever a regra.
