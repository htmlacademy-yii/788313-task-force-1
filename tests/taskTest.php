<?php

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use TaskForce\Exception\TaskException;
use TaskForce\Task;
use TaskForce\Action\RespondAction;
use TaskForce\Action\UndoAction;
use TaskForce\Action\RefuseAction;
use TaskForce\Action\DoneAction;


class taskTest extends TestCase
{
    private $task;

    protected function setUp(): void
    {
            $this->task = new Task(1, 1, 2);
    }

    protected function tearDown(): void
    {
        $this->task = null;
    }

    /**
     * Метод класса Task, выводит список статусов на русском.
     */
    public function testStatuses(): void
    {
        $arr = [
            'New'    => 'Новое',
            'Cancel' => 'Отменено',
            'Work'   => 'В работе',
            'Ready'  => 'Выполнено',
            'Failed' => 'Провалено'
        ];
        self::assertEquals($arr, $this->task->statuses());
    }

    #[ArrayShape([
        'Action respond (Откликнуться)' => "string[]",
        'Action undo (Отменить)' => "string[]",
        'Action refuse (Отказаться)' => "string[]",
        'Action done (Выполнено)' => "string[]"
    ])]
    public function getNextStatusProvider(): array
    {
        return [
            'Action respond (Откликнуться)' => ['Respond', 'Work'],
            'Action undo (Отменить)'        => ['Undo', 'Cancel'],
            'Action refuse (Отказаться)'    => ['Refuse', 'Failed'],
            'Action done (Выполнено)'       => ['Done', 'Ready']
        ];
    }

    /**
     * Тест метода для получения статуса, в которой он перейдёт после выполнения указанного действия
     * @dataProvider getNextStatusProvider
     * @param $action
     * @param $status
     */
    public function testGetNextStatus($action, $status): void
    {
        self::assertEquals($status, $this->task->getNextStatus($action));
    }

    #[ArrayShape([
        'Respond (Откликнуться)' => "array",
        'Undo (Отменить)' => "array",
        'Refuse (Отказаться)' => "array",
        'Done (Выполнено)' => "array"
    ])]
    public function AvailableActionsProvider(): array
    {
        $Respond = new RespondAction();
        $Undo = new UndoAction();
        $Refuse = new RefuseAction();
        $Done = new DoneAction();

        return [
            'Respond (Откликнуться)'  => [1, 2, 'New', 3, $Respond],
            'Undo (Отменить)'      => [1, 2, 'New', 2, $Undo],
            'Refuse (Отказаться)'    => [1, 2, 'Work', 1, $Refuse],
            'Done (Выполнено)'     => [1, 2, 'Work', 2, $Done]
        ];
    }

    /**
     * Тест метода для получения доступных действий для указанного статуса
     * @dataProvider AvailableActionsProvider
     * @param $perfermerId //Исполнитель
     * @param $clientId //Клиент
     * @param $status //Статус
     * @param $currentClient //Текущий клиент
     * @param $object //Объект действия
     * @throws TaskException
     */
    public function testAvailableActions($perfermerId, $clientId, $status, $currentClient, $object): void
    {
        $this->task = new TaskForce\Task($perfermerId, $clientId, $status);

        self::assertEquals($this->task->availableActions($currentClient), $object);
    }
}
