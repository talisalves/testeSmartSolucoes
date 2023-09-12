<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Model\Agendamento;
use SmartSolucoes\Libs\Helper;

class AgendamentoController
{

    private $table = 'agendamento';
    private $baseView = 'admin/agendamento';
    private $urlIndex = 'agendamento';

    public function index()
    {
        $model = new Agendamento();
        $response = $model->all('agendamento', 'id DESC');
        Helper::view($this->baseView . '/index', $response);
    }


    public function find($id)
    {
        $model = new Agendamento();
        $response = $model->find($this->table, $id);
        echo json_encode($response);
    }



    public function update()
    {
       
        $model = new Agendamento();
        if (@$_SESSION['acesso'] == 'Administrador')
            $_POST['id_update_user'] = $_SESSION['id_user'];
        if ($model->save($this->table, $_POST, ['image'])) {
            header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
        } else {
            Helper::view($this->baseView . '/edit/' . $_POST['id']);
        }
    }

    public function getAgendamento()
    {
        $agendamento = new Agendamento();
        echo json_encode($agendamento->findAll());
        exit;
    }

    public function store($param)
    {
        //var_dump('tesdte');
        //TODO: needs validation
        $data = [
            'start' => $param['start'],
            'end' => $param['end'],
            'status' => 0,
            'title' => $param['title']
        ];

        $agendamento = new Agendamento();
        $agendamento->store($data);

        json_encode(['success' => true]);
        exit;
    }

    public function destroy($param)
    {
        $model = new Agendamento();
        $model->destroy($param['id']);
        json_encode(['success' => true]);
        exit;
    }


}