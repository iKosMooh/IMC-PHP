<?php
// Ao entrar no php o erro é verificado e redirecionado para o index.php com erro, os parâmetros são passados via GET no link do index.php
$erro = filter_input(INPUT_GET, 'erro', FILTER_SANITIZE_STRING);
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora de IMC</title>
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
        <h1 class="mb-4 text-center">Calculadora de IMC</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php if ($erro === 'valores'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erro:</strong> Informe valores válidos de peso e altura antes de calcular.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                <?php endif; ?>

                <form action="calcular.php" method="post" class="card p-4 shadow-sm bg-white">
                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.1" min="1" class="form-control" id="peso" name="peso" required
                            placeholder="Ex: 70.5">
                    </div>
                    <div class="mb-3">
                        <label for="altura" class="form-label">Altura (m)</label>
                        <input type="number" step="0.01" min="0.5" class="form-control" id="altura" name="altura"
                            placeholder="Ex: 1.75">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Calcular IMC</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>