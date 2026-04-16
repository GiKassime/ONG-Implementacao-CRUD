<?php 
namespace app\controller;
use app\repositories\OngRepository;
use app\core\Controller;
use app\service\OngService;
class OngController extends Controller{

    private OngService $ong_service;
    public function __construct()
    {
        $this->ong_service = new OngService();
    }


    public function listarTodasOngs(){
        $dados = $this->ong_service->listarOngs();
        $this->view('', $dados);
    }

    public function verOng(){
        $id = $_GET['id'];
        $data['ong'] = $this->ong_service->getOng($id);

        $this->view('ongs/ong_show', $data);
    }

    public function criarOng(){

    }

    public function editarOng(){

    }

    public function excluirOng(){

    }


}