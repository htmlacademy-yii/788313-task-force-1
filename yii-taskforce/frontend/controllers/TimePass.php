<?php


namespace frontend\controllers;

use frontend\controllers\TrueForm;

class TimePass
{
    public object $trueForm;


    /**
     * Выводит колличество времени прошедшего с $date в правильном формате
     * @param string $date Дата события
     */
    public function time(string $date): string
    {
        $this->trueForm = new TrueForm();

        $interval = time() - strtotime($date);
        $diff_time = [
            'days' => floor($interval / 86400),
            'hours' => floor($interval / 3600),
            'minutes' => floor($interval / 60)
        ];
        if ($diff_time['days'] < 1) {
            if ($diff_time['hours'] < 1) {
                if ($diff_time['minutes'] < 1) {
                    return 'только что';
                } else {
                    return $diff_time['minutes'] . ' ' . $this->trueForm->getTrueForm(
                            $diff_time['minutes'],
                            'минута',
                            'минуты',
                            'минут'
                        ) . ' назад';
                }
            } else {
                return $diff_time['hours'] . ' ' . $this->trueForm->getTrueForm(
                        $diff_time['hours'],
                        'час',
                        'часа',
                        'часов'
                    ) . ' назад';
            }
        } else {
            return date('d.m.y', strtotime($date)) . ' в ' . date('H:i', strtotime($date));
        }
    }
}
