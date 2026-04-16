<?php

namespace app\repositories;
use PDO;

abstract class BaseRepository 
{
    protected PDO $db;
    protected string $tabela; // PARA CLASSES FILHAS EX -> ONGS, TUTOR E PROTETORES

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    // Buscar por ID
    public function buscarPorId(int $id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // deleta
    public function deletar(int $id): bool 
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tabela} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // cria/salva
    public function salvar(array $dados): bool 
    {
        $colunas = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));
        
        $sql = "INSERT INTO {$this->tabela} ($colunas) VALUES ($valores)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute($dados);
    }

    // atualiza/edita
    public function atualizar(int $id, array $dados): bool 
    {
        if (empty($dados)) {
            return false;
        }

        // Monta a estrutura "coluna = :coluna" 
        $setCampos = [];
        foreach ($dados as $coluna => $valor) {
            $setCampos[] = "{$coluna} = :{$coluna}";
        }
        
        // separa virgula
        $setQuery = implode(', ', $setCampos);

        // SQL final
        $sql = "UPDATE {$this->tabela} SET {$setQuery} WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $dados['id'] = $id;
        
        // Executa passando todos os dados juntos
        return $stmt->execute($dados);
    }
}