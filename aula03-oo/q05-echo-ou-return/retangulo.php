<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public float $largura;
    public float $altura;

    public function area(): float
    {
        $area = $this->largura * $this->altura;
        return $area;
    }

    public function perimetro(): float
    {
        $perimetro = 2 * ($this->largura + $this->altura);
        return $perimetro;
    }

    public function imprimir(): void
    {
        echo "Área: " . $this->area() . PHP_EOL;
        echo "Perímetro: " . $this->perimetro() . PHP_EOL;
    }
}

$sala = new Retangulo();
$sala->largura = 8;
$sala->altura = 6;
$sala->imprimir();
$area = $sala->area();
$perimetro = $sala->perimetro();
var_dump($sala->area());