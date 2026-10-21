<?php

declare(strict_types=1);

class Livro
{
    public function __construct(
        public string $titulo,
        public string $autor,
        public int $ano,
        public float $preco,
        public int $disponivel,
    ) {
    }

    public function __toString(): string
    {
        return "{$this->titulo}, de {$this->autor} ({$this->ano})";
    }
}

$livro1 = new Livro('Bleach', 'Tite Kubo', '2001', 29.99, 10);
$livro2 = new Livro('Vidas Secas', 'Graciliano Ramos', 1938, 39.90, 5);
echo $livro1;
echo "<br>";
echo $livro2;