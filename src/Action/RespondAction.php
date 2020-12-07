<?php


namespace TaskForce\Action;


class RespondAction extends Action
{
    public function Title(): string
    {
        return 'Откликнуться';
    }

    public function Name(): string
    {
        return 'Respond';
    }

    public function Verification(int $idPerformer, int $clientId, int $idCurrentClient): bool
    {
        return $idPerformer !== $idCurrentClient && $clientId !== $idCurrentClient;
    }
}
