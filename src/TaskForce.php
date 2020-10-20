<?php

namespace scr\TaskForce;

class TaskForce implements TaskInterface
{
    const STATUS_NEW = 'New';
    const STATUS_CANCEL = 'Cancel';
    const STATUS_WORK = 'Work';
    const STATUS_READY = 'Ready';
    const STATUS_FAILED = 'Failed';


    private $_idPerformer;
    private $_idClient;

    public $_activeStatus = TaskForce::STATUS_NEW;

    public function __construct (int $idPerformer, int $idClient) {
        $this->_idPerformer = $idPerformer;
        $this->_idClient = $idClient;
    }

    public function statusMap (string $status = '')
    {
        $statusMap = [
            TaskForce::STATUS_NEW => "Новое",
            TaskForce::STATUS_CANCEL => "Отменено",
            TaskForce::STATUS_WORK => "В работе",
            TaskForce::STATUS_READY => "Выполнено",
            TaskForce::STATUS_FAILED => "Провалено"
        ];
        if (!$status) {
            return $statusMap;
        }
        return $statusMap[$status] ?? $statusMap;
    }

    public function availableStatus (string $status = '')
    {
        $statusMap = [
            TaskForce::STATUS_NEW => [
                TaskForce::STATUS_CANCEL,
                TaskForce::STATUS_WORK
            ],
            TaskForce::STATUS_WORK => [
                TaskForce::STATUS_READY,
                TaskForce::STATUS_FAILED
            ]
        ];

        if (!$status) {
            return $statusMap;
        }
        return $statusMap[$status] ?? [];
    }

    public function setStatus (string $status)
    {
        $availableStatus = $this->availableStatus($this->_activeStatus);
        if (in_array($status, $availableStatus)) {
            $this->_activeStatus = $status;
            return $status;
        }
        return $this->_activeStatus;
    }


}

