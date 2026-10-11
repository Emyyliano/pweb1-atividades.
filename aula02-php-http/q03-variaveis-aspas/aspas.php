<?php
$nome = "Emyliano";
$curso = "ADS";
$semestre = 2;
?>
<p><?php echo "Aluno: " . $nome; ?></p>
<p><?php echo "Aluno: $nome"; ?></p>
<p><?php echo 'Aluno: $nome'; ?></p>
<p><?php echo "Cursa o {$semestre}o semestre de $curso"; ?></p>
<p><?php echo $nome . $curso; ?></p>
<p>Atalho: <?= $nome ?></p>