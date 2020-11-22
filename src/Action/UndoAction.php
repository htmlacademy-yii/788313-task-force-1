<?php


namespace TaskForce\Action;


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

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient): bool
    {
        return $clientId === $idCurrentClient;
    }
}
