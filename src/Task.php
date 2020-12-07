<?php

namespace TaskForce;

use TaskForce\Action\RespondAction;
use TaskForce\Action\UndoAction;
use TaskForce\Action\RefuseAction;
use TaskForce\Action\DoneAction;

class Task
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
     * Метод возвращает карту статусов на русском.
     * @return string[]
     */
    public function statuses(): array
    {
        return [
            self::STATUS_NEW    => 'Новое',
            self::STATUS_CANCEL => 'Отменено',
            self::STATUS_WORK   => 'В работе',
            self::STATUS_READY  => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
    }

    /**
     * Метод возвращает карту действий.
     * @return array
     */
    public function actions(): array
    {
        return [
            self::ACTION_RESPOND => new RespondAction(),
            self::ACTION_UNDO    => new UndoAction(),
            self::ACTION_REFUSE  => new RefuseAction(),
            self::ACTION_DONE    => new DoneAction()
        ];
    }

    /**
     * Метод для получения доступных действий для указанного статуса
     * @param int $currentClient
     * @return mixed|null
     */
    public function availableActions(int $currentClient)
    {
        $actions = $this->actions();
        if ($this->_activeStatus === self::STATUS_NEW) {
            if ($actions[self::ACTION_RESPOND]->Verification($this->_idPerformer, $this->_clientId, $currentClient)) {
                return $actions[self::ACTION_RESPOND];
            }
            if ($actions[self::ACTION_UNDO]->Verification($this->_idPerformer, $this->_clientId, $currentClient)) {
                return $actions[self::ACTION_UNDO];
            }
        }
        if ($this->_activeStatus === self::STATUS_WORK) {
            if ($actions[self::ACTION_REFUSE]->Verification($this->_idPerformer, $this->_clientId, $currentClient)) {
                return $actions[self::ACTION_REFUSE];
            }
            if ($actions[self::ACTION_DONE]->Verification($this->_idPerformer, $this->_clientId, $currentClient)) {
                return $actions[self::ACTION_DONE];
            }
        }
        return null;
    }

    /**
     * Метод для получения статуса, в которой он перейдёт после выполнения указанного действия
     * @param string $action
     * @return string|null
     */
    public function getNextStatus(string $action): ?string
    {
        switch ($action) {
            case self::ACTION_RESPOND:
                return self::STATUS_WORK;
                break;
            case self::ACTION_UNDO:
                return self::STATUS_CANCEL;
                break;
            case self::ACTION_REFUSE:
                return self::STATUS_FAILED;
                break;
            case self::ACTION_DONE:
                return self::STATUS_READY;
                break;
            default:
                return null;
        }
    }
}

