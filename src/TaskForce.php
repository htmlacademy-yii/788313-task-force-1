<?php

namespace TaskForce;

class TaskForce implements TaskInterface
{
    private $_idPerformer;
    private $_clientId;
    private $_idCurrentClient;

    private $_status1;
    private $_status2;
    private $_status3;
    private $_status4;
    private $_status5;

    public function __construct(int $idPerformer, int $clientId, int $idCurrentClient)
    {
        $this->_idPerformer = $idPerformer;
        $this->_clientId = $clientId;
        $this->_idCurrentClient = $idCurrentClient;

        $this->_status1 = new StatusNew();
        $this->_status2 = new StatusCancel();
        $this->_status3 = new StatusWork();
        $this->_status4 = new StatusReady();
        $this->_status5 = new StatusFailed();
    }

    public function languageMap($status)
    {
        $languageMap = [
            1 => "Новое",
            2 => "Отменено",
            3 => "В работе",
            4 => "Выполнено",
            5 => "Провалено"
        ];
        return $languageMap[$status] ?? $languageMap;
    }

    public function availableStatus(int $taskStatus)
    {

        $statusMap = [
            1 => [
                2,
                3
            ],
            3 => [
                4,
                5
            ]
        ];
        if (!$taskStatus) {
            return $statusMap;
        }
        return $statusMap[$taskStatus] ?? [];
    }

    public function setStatus(int $taskStatus, int $statusUser)
    {
        $availableStatus = $this->availableStatus($taskStatus);
        if (in_array($taskStatus, $availableStatus)) {
            if ($taskStatus !== 3) {

                return ($this->_status{$taskStatus}->Verification($this->_idPerformer, $this->_clientId, $this->_idCurrentClient)) ?? $taskStatus;
            } else {
                if ($statusUser) {return ($this->_status{$taskStatus}->Verification($this->_idPerformer, $this->_clientId, $this->_idCurrentClient)) ?? $taskStatus;}
            }
        }
    }


}

