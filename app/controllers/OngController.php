<?php

namespace app\controllers;

use app\core\Controller;
use app\helpers\Validador;
use app\models\Ong;
use app\services\OngService;

class OngController extends Controller
{
    private OngService $service;

    public function __construct()
    {
        $this->service = new OngService();
    }

    public function index(): void
    {
        $data['ongs'] = $this->service->getOngs();
        $this->view('ongs/ongs_list', $data);
    }

    public function ver(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(URL_BASE . '/ongs');
        }

        $ong = $this->service->getOngById($id);
        if (!$ong) {
            $this->redirect(URL_BASE . '/ongs');
        }

        $data['ong'] = $ong;
        $this->view('ongs/ongs_show', $data);
    }

    public function cadastrar(): void
    {
        $this->autenticacaoRequired();
        $this->view('ongs/ongs_form');
    }

    public function salvar(): void
    {
        $this->autenticacaoRequired();

        $validador = new Validador();

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';
        $cnpj = (string)($_POST['cnpj'] ?? '');
        $telefone = (string)($_POST['telefone'] ?? '');
        $email = (string)($_POST['email'] ?? '');
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';

        $validador->obrigatorio('nome', $nome);
        $validador->obrigatorio('cnpj', $cnpj, 'O campo CPF/CNPJ é obrigatório');
        $validador->obrigatorio('telefone', $telefone);
        $validador->obrigatorio('email', $email);
        $validador->obrigatorio('endereco', $endereco);

        $cnpjDigits = preg_replace('/\D+/', '', $cnpj) ?? '';
        if ($cnpjDigits === '' || !in_array(strlen($cnpjDigits), [11, 14], true)) {
            $data['erros']['cnpj'] = 'CPF/CNPJ deve ter 11 ou 14 dígitos';
        }

        if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $data['erros']['email'] = 'E-mail inválido';
        }

        if ($validador->temErros()) {
            $data['ong'] = $_POST;
            $data['erros'] = array_merge($validador->getErros(), $data['erros'] ?? []);
            $this->view('ongs/ongs_form', $data);
            return;
        }

        $ong = new Ong(0, $nome, $cnpjDigits, $telefone, $email, $endereco);

        if ($this->service->saveOng($ong)) {
            $this->redirect(URL_BASE . '/ongs');
            return;
        }

        $data['ong'] = $_POST;
        $data['erros']['duplicado'] = 'Erro: CPF/CNPJ ou e-mail já cadastrado.';
        $this->view('ongs/ongs_form', $data);
    }

    public function editar(): void
    {
        $this->autenticacaoRequired();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(URL_BASE . '/ongs');
            return;
        }

        $ong = $this->service->getOngById($id);
        if (!$ong) {
            $this->redirect(URL_BASE . '/ongs');
            return;
        }

        $data['ong'] = $ong;
        $this->view('ongs/ongs_form', $data);
    }

    public function atualizar(): void
    {
        $this->autenticacaoRequired();

        $validador = new Validador();

        $id = (int)($_POST['id'] ?? 0);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';
        $cnpj = (string)($_POST['cnpj'] ?? '');
        $telefone = (string)($_POST['telefone'] ?? '');
        $email = (string)($_POST['email'] ?? '');
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';

        $validador->obrigatorio('nome', $nome);
        $validador->obrigatorio('cnpj', $cnpj, 'O campo CPF/CNPJ é obrigatório');
        $validador->obrigatorio('telefone', $telefone);
        $validador->obrigatorio('email', $email);
        $validador->obrigatorio('endereco', $endereco);

        $cnpjDigits = preg_replace('/\D+/', '', $cnpj) ?? '';
        if ($cnpjDigits === '' || !in_array(strlen($cnpjDigits), [11, 14], true)) {
            $data['erros']['cnpj'] = 'CPF/CNPJ deve ter 11 ou 14 dígitos';
        }

        if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $data['erros']['email'] = 'E-mail inválido';
        }

        if ($id <= 0) {
            $data['erros']['id'] = 'ID inválido';
        }

        if ($validador->temErros() || !empty($data['erros'] ?? [])) {
            $data['ong'] = $_POST;
            $data['erros'] = array_merge($validador->getErros(), $data['erros'] ?? []);
            $this->view('ongs/ongs_form', $data);
            return;
        }

        $ong = new Ong($id, $nome, $cnpjDigits, $telefone, $email, $endereco);

        if ($this->service->updateOng($ong)) {
            $this->redirect(URL_BASE . '/ongs');
            return;
        }

        $data['ong'] = $_POST;
        $data['erros']['duplicado'] = 'Erro: CPF/CNPJ ou e-mail já cadastrado.';
        $this->view('ongs/ongs_form', $data);
    }

    public function excluir(): void
    {
        $this->autenticacaoRequired();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(URL_BASE . '/ongs');
            return;
        }

        $this->service->deleteOng($id);
        $this->redirect(URL_BASE . '/ongs');
    }
}
