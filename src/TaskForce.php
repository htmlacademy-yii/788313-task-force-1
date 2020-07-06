<?php
namespace TaskForce;

class Task {

    const STATUS_NEW = 'New';
    const STATUS_CANCEL = 'Cancel';
    const STATUS_WORK = 'Work';
    const STATUS_READY = 'Ready';
    const STATUS_FAILED = 'Failed';

    public $activeStatus = Task::NEW_TASK;

    public function status (){
    /*определение активного статуса и вывод названия

    'New' => 'Новое',
    'Cancel' => 'Отменено',
    'Work' => 'В работе',
    'Ready' => 'Выполнено',
    'Failed' => 'Провалено' */
    }

    public function availableStatus (){
        //определение возможного действия
    }

    private $idPerformer = [];
    private $idClient = [];
    private function __construct ($idPerformer, $idClient) {
        $this->idPerformer = $idPerformer;
        $this->idClient = $idClient;
    }

    }
