<?php

namespace app\controllers;

use app\core\Controller;
use app\services\AutenticacaoService;

class AutenticacaoController extends Controller
{

    private AutenticacaoService $autenticacaoService;

    public function __construct()
    {
        $this->autenticacaoService = new AutenticacaoService();
    }

    public function login()
    {

        $this->view('autenticacao/login');
    }

    public function logar()
    {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $resultado = $this->autenticacaoService->logar($email, $senha);

        if ($resultado) {
            $this->redirect(URL_BASE . '/ongs');
        } else {

            $dados['erros'] = "E-mail ou senha inválidos.";

            $this->view('autenticacao/login', $dados);
        }
    }

    public function logout(): void
    {
        $this->autenticacaoService->logout();
        $this->redirect(URL_BASE . '/login');
    }
}
