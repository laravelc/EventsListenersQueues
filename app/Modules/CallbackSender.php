<?php

namespace App\Modules;

use App\Models\User;

/**
 * Известитель
 */
class CallbackSender
{
    /**
     * Извещение о создании пользователя ему самому и администратору сервиса
     * @param User $user
     * @return void
     */
    public function sendNotifications(User $user)
    {
        //Тут будет сам процесс отправки извещений с применением API и прочее
    }
}
