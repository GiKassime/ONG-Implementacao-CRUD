<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> • Detalhes da ONG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Detalhes da ONG</h2>
            <a href="<?= URL_BASE ?>/ongs" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="fw-bold">Nome</div>
                        <div><?= htmlspecialchars($ong['nome']) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="fw-bold">CPF/CNPJ</div>
                        <div><?= htmlspecialchars($ong['cnpj']) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="fw-bold">Telefone</div>
                        <div><?= htmlspecialchars($ong['telefone']) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="fw-bold">E-mail</div>
                        <div><?= htmlspecialchars($ong['email']) ?></div>
                    </div>
                    <div class="col-12">
                        <div class="fw-bold">Endereço</div>
                        <div><?= htmlspecialchars($ong['endereco']) ?></div>
                    </div>
                </div>

                <?php if (isset($_SESSION['usuario_logado'])): ?>
                    <hr>
                    <div class="d-flex gap-2">
                        <a href="<?= URL_BASE ?>/ongs/editar?id=<?= $ong['id'] ?>" class="btn btn-outline-primary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="<?= URL_BASE ?>/ongs/excluir?id=<?= $ong['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Deseja excluir esta ONG?')">
                            <i class="bi bi-trash"></i> Excluir
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
