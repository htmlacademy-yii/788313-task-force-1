<?php


namespace TaskForce\action;


class UndoAction extends Action
{
    public function Title(): string
    {
        return 'Отменить';
    }

    public function Name(): string
    {
        return 'Undo';
    }

    public function Verification(int $performerId, int $clientId, int $currentClientId): bool
    {
        return $clientId === $currentClientId;
    }
}
