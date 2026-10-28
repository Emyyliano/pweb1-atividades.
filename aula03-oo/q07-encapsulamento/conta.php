<?php

declare(strict_types=1);

// Questão 07 - a conta da aula (exemplo 05). Encapsule.
// O saldo é público apenas para fins didáticos nesta aula.
class ContaBancaria
{
    private string $titular;
    private string $numero;
    private float $saldo = 0.0;

    public function __construct(string $titular, string $numero)
    {
        $this->titular = $titular;
        $this->numero = $numero;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            echo "Depósito inválido.<br>\n";
            return;
        }
        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            echo "Saque inválido ou saldo insuficiente.<br>\n";
            return;
        }
        $this->saldo -= $valor;
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    public function apresentarDados(): void
    {
        echo "Titular: {$this->titular}<br>\n";
        echo "Conta: {$this->numero}<br>\n";
        echo 'Saldo: R$ ' . number_format($this->consultarSaldo(), 2, ',', '.') . "<br>\n";
    }
}

$conta = new ContaBancaria('João', '12345');
$conta->depositar(1000);
$conta->sacar(250);
$conta->apresentarDados();

