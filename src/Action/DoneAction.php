<?php


namespace TaskForce\Action;


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

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient): bool
    {
        return $clientId === $idCurrentClient;
    }
}
