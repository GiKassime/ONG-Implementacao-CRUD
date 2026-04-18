<?php

namespace app\repositories;

use app\database\ConnectionFactory;
use app\models\Ong;
use PDO;

class OngRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionFactory::getConnection();
    }

    public function getOngs(): array
    {
        $stmt = $this->connection->prepare('SELECT id, nome, cnpj, telefone, email, endereco FROM ongs ORDER BY id DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOngById(int $id): ?array
    {
        $stmt = $this->connection->prepare('SELECT id, nome, cnpj, telefone, email, endereco FROM ongs WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $ong = $stmt->fetch();
        return $ong ?: null;
    }

    public function getOngByEmail(string $email): ?array
    {
        $stmt = $this->connection->prepare('SELECT id, nome, cnpj, telefone, email, endereco FROM ongs WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $ong = $stmt->fetch();
        return $ong ?: null;
    }

    public function getOngByCnpj(string $cnpj): ?array
    {
        $stmt = $this->connection->prepare('SELECT id, nome, cnpj, telefone, email, endereco FROM ongs WHERE cnpj = :cnpj');
        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->execute();
        $ong = $stmt->fetch();
        return $ong ?: null;
    }

    public function existeEmailEmOutraOng(string $email, int $idAtual): bool
    {
        $stmt = $this->connection->prepare('SELECT COUNT(*) AS total FROM ongs WHERE email = :email AND id <> :id');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $idAtual, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return ((int)($row['total'] ?? 0)) > 0;
    }

    public function existeCnpjEmOutraOng(string $cnpj, int $idAtual): bool
    {
        $stmt = $this->connection->prepare('SELECT COUNT(*) AS total FROM ongs WHERE cnpj = :cnpj AND id <> :id');
        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->bindValue(':id', $idAtual, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return ((int)($row['total'] ?? 0)) > 0;
    }

    public function saveOng(Ong $ong): bool
    {
        $sql = 'INSERT INTO ongs (nome, cnpj, telefone, email, endereco) VALUES (:nome, :cnpj, :telefone, :email, :endereco)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':nome', $ong->getNome());
        $stmt->bindValue(':cnpj', $ong->getCnpj());
        $stmt->bindValue(':telefone', $ong->getTelefone());
        $stmt->bindValue(':email', $ong->getEmail());
        $stmt->bindValue(':endereco', $ong->getEndereco());
        return $stmt->execute();
    }

    public function updateOng(Ong $ong): bool
    {
        $sql = 'UPDATE ongs SET nome = :nome, cnpj = :cnpj, telefone = :telefone, email = :email, endereco = :endereco WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $ong->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nome', $ong->getNome());
        $stmt->bindValue(':cnpj', $ong->getCnpj());
        $stmt->bindValue(':telefone', $ong->getTelefone());
        $stmt->bindValue(':email', $ong->getEmail());
        $stmt->bindValue(':endereco', $ong->getEndereco());
        return $stmt->execute();
    }

    public function deleteOng(int $id): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM ongs WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
