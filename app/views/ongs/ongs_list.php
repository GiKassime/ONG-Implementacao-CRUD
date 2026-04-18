<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> • Lista de ONGs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">ONGs</h2>
            <div class="d-flex gap-2">
                <?php if (isset($_SESSION['usuario_logado'])): ?>
                    <a href="<?= URL_BASE ?>/logout" class="btn btn-outline-secondary">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                    <a href="<?= URL_BASE ?>/ongs/cadastrar" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Nova ONG
                    </a>
                <?php else: ?>
                    <a href="<?= URL_BASE ?>/login" class="btn btn-outline-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Entrar
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">CPF/CNPJ</th>
                                <th class="px-4 py-3">Telefone</th>
                                <th class="px-4 py-3 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ongs as $ong): ?>
                                <tr>
                                    <td class="px-4 py-3 align-middle"><?= htmlspecialchars($ong['nome']) ?></td>
                                    <td class="px-4 py-3 align-middle"><?= htmlspecialchars($ong['cnpj']) ?></td>
                                    <td class="px-4 py-3 align-middle"><?= htmlspecialchars($ong['telefone']) ?></td>
                                    <td class="px-4 py-3 align-middle text-end">
                                        <a href="<?= URL_BASE ?>/ongs/ver?id=<?= $ong['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>

                                        <?php if (isset($_SESSION['usuario_logado'])): ?>
                                            <a href="<?= URL_BASE ?>/ongs/editar?id=<?= $ong['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>
                                            <a href="<?= URL_BASE ?>/ongs/excluir?id=<?= $ong['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir esta ONG?')">
                                                <i class="bi bi-trash"></i> Excluir
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="<?= URL_BASE ?>/usuarios" class="btn btn-link">Usuários</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
