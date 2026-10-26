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

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.2 Saída com os métodos novos**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

## 3. Perguntas

**a) Sua previsão do item 1.2 acertou todas as linhas? Explique cada diferença.**

_(responda aqui)_

**b) Por que `echo $sala->getTemperatura() + 10` funciona, mas `$sala->mostrarStatus() + 10` não faria sentido?**

_(responda aqui)_

**c) Qual método chama outro método do mesmo objeto?**

_(responda aqui)_
