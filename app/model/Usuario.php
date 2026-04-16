<?php 
namespace app\model;

//classe usuário usada para Ongs, Tutores e Protetores
abstract class Usuario {
    private int $idUsuario ;
    private string $nome;
    private int $telefone;
    private string $email;
    private int $cep;
    
}