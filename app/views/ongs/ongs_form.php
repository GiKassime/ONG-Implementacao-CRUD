<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> • <?= isset($ong['id']) ? 'Editar ONG' : 'Cadastrar ONG' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><?= isset($ong['id']) ? 'Editar ONG' : 'Cadastrar ONG' ?></h2>
            <a href="<?= URL_BASE ?>/ongs" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <?php if (isset($erros) && !empty($erros)): ?>
            <div class="alert alert-danger">
                <?php foreach ($erros as $erro): ?>
                    <div><?= htmlspecialchars($erro) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= URL_BASE ?>/ongs/<?= isset($ong['id']) ? 'atualizar' : 'salvar' ?>" method="post">

                    <?php if (isset($ong['id'])): ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$ong['id']) ?>">
                    <?php endif; ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome</label>
                            <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($ong['nome'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cnpj" value="<?= htmlspecialchars($ong['cnpj'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone</label>
                            <input type="text" class="form-control" name="telefone" value="<?= htmlspecialchars($ong['telefone'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">E-mail</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($ong['email'] ?? '') ?>" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Endereço</label>
                            <input type="text" class="form-control" name="endereco" value="<?= htmlspecialchars($ong['endereco'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Salvar
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
