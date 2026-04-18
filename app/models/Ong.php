<?php

namespace app\models;

use DateTimeImmutable;

class Ong
{
    private int $id;
    private string $nome;
    private string $cnpj;
    private string $telefone;
    private string $email;
    private string $endereco;
    private DateTimeImmutable $criadoEm;

    public function __construct(
        int $id,
        string $nome,
        string $cnpj,
        string $telefone,
        string $email,
        string $endereco
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->criadoEm = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEndereco(): string
    {
        return $this->endereco;
    }

    public function getCriadoEm(): DateTimeImmutable
    {
        return $this->criadoEm;
    }

    public static function arrayParaObjeto(array $ong): self
    {
        return new self(
            (int)$ong['id'],
            (string)$ong['nome'],
            (string)$ong['cnpj'],
            (string)$ong['telefone'],
            (string)$ong['email'],
            (string)$ong['endereco']
        );
    }
}
