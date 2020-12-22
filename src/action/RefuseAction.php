<?php


namespace TaskForce\action;


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

    public function Verification(int $performerId, int $clientId, int $currentClientId): bool
    {
        return $performerId === $currentClientId;
    }
}
