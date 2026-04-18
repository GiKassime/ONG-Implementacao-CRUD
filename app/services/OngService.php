<?php

namespace app\services;

use app\models\Ong;
use app\repositories\OngRepository;

class OngService
{
    private OngRepository $repository;

    public function __construct()
    {
        $this->repository = new OngRepository();
    }

    public function getOngs(): array
    {
        return $this->repository->getOngs();
    }

    public function getOngById(int $id): ?array
    {
        return $this->repository->getOngById($id);
    }

    public function saveOng(Ong $ong): bool
    {
        $cnpj = $this->normalizarDocumento($ong->getCnpj());
        $email = $this->normalizarEmail($ong->getEmail());

        if ($this->repository->getOngByCnpj($cnpj) || $this->repository->getOngByEmail($email)) {
            return false;
        }

        $ongNormalizada = new Ong(
            0,
            $ong->getNome(),
            $cnpj,
            $ong->getTelefone(),
            $email,
            $ong->getEndereco()
        );

        return $this->repository->saveOng($ongNormalizada);
    }

    public function updateOng(Ong $ong): bool
    {
        $cnpj = $this->normalizarDocumento($ong->getCnpj());
        $email = $this->normalizarEmail($ong->getEmail());

        if ($this->repository->existeCnpjEmOutraOng($cnpj, $ong->getId()) || $this->repository->existeEmailEmOutraOng($email, $ong->getId())) {
            return false;
        }

        $ongNormalizada = new Ong(
            $ong->getId(),
            $ong->getNome(),
            $cnpj,
            $ong->getTelefone(),
            $email,
            $ong->getEndereco()
        );

        return $this->repository->updateOng($ongNormalizada);
    }

    public function deleteOng(int $id): bool
    {
        return $this->repository->deleteOng($id);
    }

    private function normalizarDocumento(string $documento): string
    {
        return preg_replace('/\D+/', '', $documento) ?? '';
    }

    private function normalizarEmail(string $email): string
    {
        return mb_strtolower(trim($email));
    }
}
