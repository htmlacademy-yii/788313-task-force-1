<?php


namespace TaskForce\action;


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

    public function Verification(int $performerId, int $clientId, int $currentClientId): bool
    {
        return $performerId !== $currentClientId && $clientId !== $currentClientId;
    }
}
