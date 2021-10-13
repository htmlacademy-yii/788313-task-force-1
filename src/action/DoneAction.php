<?php


namespace TaskForce\action;


class DoneAction extends Action
{
    public function Title(): string
    {
        return 'Выполнено';
    }

    public function Name(): string
    {
        return 'Done';
    }

    public function Verification(int $performerId, int $clientId, int $currentClientId): bool
    {
        return $clientId === $currentClientId;
    }
}
