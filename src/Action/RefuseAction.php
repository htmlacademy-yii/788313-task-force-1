<?php


namespace TaskForce\Action;


class RefuseAction extends Action
{
    public function Title(): string
    {
        return 'Отказаться';
    }

    public function Name(): string
    {
        return 'Refuse';
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient): bool
    {
        return $idPerformer === $idCurrentClient;
    }
}
