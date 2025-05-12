<?php
function categorizaImc(float $imc): string
{
    return match (true) {
        $imc < 18.5 => 'Abaixo do peso',
        $imc < 25 => 'Peso normal',
        $imc < 30 => 'Sobrepeso',
        $imc < 35 => 'Obesidade Grau 1',
        $imc < 40 => 'Obesidade Grau 2',
        default => 'Obesidade Grau 3 (Mórbida)',
    };
}

// Validação dos valores enviados, para evitar injeção de código SQL e XSS :)
$peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT);
$altura = filter_input(INPUT_POST, 'altura', FILTER_VALIDATE_FLOAT);

if (!$peso || !$altura || $altura <= 0) {
    // Caso use um sqlMap aqui, ele vai redirecionar para o index.php com erro se não for um número válido
    header('Location: index.php?erro=valores');
    exit;
}

// Cálculo do IMC
$imc = round($peso / ($altura * $altura), 2);
$categoria = categorizaImc($imc);
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado do IMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("bg.jpg");
            background-size: cover;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Seu Resultado de IMC</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-3">IMC: <strong><?= number_format($imc, 2, ',', '') ?></strong></h2>
                        <p class="lead">
                            Categoria: <span class="badge 
                <?=
                    match (true) {
                        $imc < 18.5 => 'bg-info',
                        $imc < 25 => 'bg-success',
                        $imc < 30 => 'bg-warning text-dark',
                        default => 'bg-danger',
                    }
                    ?>
              ">
                                <?= htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php" class="btn btn-outline-primary">Calcular Novamente</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>