<?php

namespace TaskForce;

class TaskForce implements TaskInterface
{
    private $_idPerformer;
    private $_idClient;
    private $_idCurrentClient;
    private $_activeStatus;

    private $_status;

    public function __construct(int $idPerformer, int $idClient, int $idCurrentClient, int $activeStatus)
    {
        $this->_idPerformer = $idPerformer;
        $this->_idClient = $idClient;
        $this->_idCurrentClient = $idCurrentClient;
        $this->_activeStatus = $activeStatus;

        for ($i = 1; $i <= 5; $i++) {
            $statusName = "Status" . $i;
            $this->_status[$i] = new $statusName;
        }
    }

    public function languageMap(int $status)
    {
        $languageMap = [
            1 => "Новое",
            2 => "Отменено",
            3 => "В работе",
            4 => "Выполнено",
            5 => "Провалено"
        ];
        return $language[$status] ?? $languageMap;
    }

    public function availableStatus(int $status)
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
        if (!$status) {
            return $statusMap;
        }
        return $statusMap[$status] ?? [];
    }

    public function setStatus(int $taskStatus, bool $statusUser)
    {
        $availableStatus = $this->availableStatus($this->_activeStatus);
        if (in_array($taskStatus, $availableStatus)) {
            if ($taskStatus != 3) {
                return ($this->_status[$taskStatus]->Verification($this->_idPerformer, $this->_idClient, $this->_idCurrentClient)) ?? $taskStatus;
            } else {
                if ($statusUser) {return ($this->_status[$taskStatus]->Verification($this->_idPerformer, $this->_idClient, $this->_idCurrentClient)) ?? $taskStatus;}
            }
        }
    }


}

