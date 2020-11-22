<?php

namespace TaskForce;

use TaskInterface;

use TaskForce\Action\RespondAction;
use TaskForce\Action\UndoAction;
use TaskForce\Action\RefuseAction;
use TaskForce\Action\DoneAction;

class Task implements TaskInterface
{
    private const STATUS_NEW     = 'New';
    private const STATUS_CANCEL  = 'Cancel';
    private const STATUS_WORK    = 'Work';
    private const STATUS_READY   = 'Ready';
    private const STATUS_FAILED  = 'Failed';

    private const ACTION_RESPOND = 'Respond'; //Откликнуться, статус New, user - исполнитель. Подтверждает заказчик и после этого меняется статус на Work.
    private const ACTION_UNDO    = 'Undo'; //Отменить, статус New, user = текущий пользователь, меняется статус на Cancel
    private const ACTION_REFUSE  = 'Refuse'; //Отказаться, статус Work, исполнитель = текущий пользователь, меняется сатус на Failed.
    private const ACTION_DONE    = 'Done'; //Выполнено, статус Work, заказчик = текущий пользователь, меняется статус на Ready.

    private $_idPerformer; //Исполнитель, который откликнулся.
    private $_clientId; //Заказчик, который опубликовал.
    public $_activeStatus; //Текущий статус задания.

    public function __construct(int $idPerformer, int $clientId, string $activeStatus)
    {
        $this->_clientId     = $clientId;
        $this->_idPerformer  = $idPerformer;
        $this->_activeStatus = $activeStatus;
    }

    /**
     * Метод принимаюет внутреннее имя и возвращает имя статуса на русском языке.
     * @return string|string[]
     */
    public function LanguageMap()
    {
        $languageMap = [
            'New'     => 'Новое',
            'Cancel'  => 'Отменено',
            'Work'    => 'В работе',
            'Ready'   => 'Выполнено',
            'Failed'  => 'Провалено'
        ];
        return $languageMap[$this->_activeStatus] ?? $languageMap;
    }

    /**
     * Метод возвращающий карту статусов или доступные для перехода в них статусы.
     * @return array|string[]|\string[][]
     */
    public function availableStatus()
    {
        $statusMap = [
            self::STATUS_NEW => [
                self::STATUS_CANCEL,
                self::STATUS_WORK
            ],
            self::STATUS_WORK => [
                self::STATUS_READY,
                self::STATUS_FAILED
            ]
        ];
        if (!$this->_activeStatus) {
            return $statusMap;
        }
        return $statusMap[$this->_activeStatus] ?? [];
    }

    public function availableActions()
    {
        $actionMap = [
            self::STATUS_NEW => [
                self::ACTION_RESPOND,
                self::ACTION_UNDO
            ],
            self::STATUS_WORK => [
                self::ACTION_REFUSE,
                self::ACTION_DONE
            ]
        ];
        return $actionMap[$this->_activeStatus] ?? [];
    }

    public function getNextStatus(string $action, int $statusUser)
    {
        /*
        if (in_array($action, $this->availableActions(), true)) {
            return ($statusUser) ??  ;
        }*/
    }


}

