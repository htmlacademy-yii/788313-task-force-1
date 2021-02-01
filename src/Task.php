<?php

namespace TaskForce;

use TaskForce\action\RespondAction;
use TaskForce\action\UndoAction;
use TaskForce\action\RefuseAction;
use TaskForce\action\DoneAction;
use TaskForce\Exception\RoleException;
use TaskForce\Exception\TaskException;

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

    private int $_performerId; //Исполнитель, который откликнулся.
    private int $_clientId; //Заказчик, который опубликовал.
    public string $_activeStatus; //Текущий статус задания.

    public function __construct(int $performerId, int $clientId, string $activeStatus)
    {
        $this->_clientId = $clientId;
        $this->_performerId = $performerId;

        $array = [
            self::STATUS_NEW,
            self::STATUS_CANCEL,
            self::STATUS_WORK,
            self::STATUS_READY,
            self::STATUS_FAILED
        ];
        try {
            if (!in_array($activeStatus, $array)) {
                throw new TaskException("Такого статуса несуществует");
            }
        }
        catch (TaskException $e) {
            echo "Неверный статус: " . $e->getMessage();
            exit();
        }
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
        try {
            if ($currentClient !== 0 || $currentClient !== 1) {
                throw new TaskException("Роль пользователя не определена");
            }
        }
        catch (TaskException $e) {
            echo "Ошибка роли: " . $e->getMessage();
            exit();
        }
        $actions = $this->actions();

        $actRespond = $actions[self::ACTION_RESPOND];
        $actUndo = $actions[self::ACTION_UNDO];
        $actRefuse = $actions[self::ACTION_REFUSE];
        $actDone = $actions[self::ACTION_DONE];

        if ($this->_activeStatus === self::STATUS_NEW) {
            if ($actRespond->Verification($this->_performerId, $this->_clientId, $currentClient)) {
                return $actRespond;
            }
            if ($actUndo->Verification($this->_performerId, $this->_clientId, $currentClient)) {
                return $actUndo;
            }
        }
        if ($this->_activeStatus === self::STATUS_WORK) {
            if ($actRefuse->Verification($this->_performerId, $this->_clientId, $currentClient)) {
                return $actRefuse;
            }
            if ($actDone->Verification($this->_performerId, $this->_clientId, $currentClient)) {
                return $actDone;
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

