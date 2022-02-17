<?php

namespace App\Jobs;

use App\Models\User;
use App\Modules\CallbackSender;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LogicException;

class SendUserCallback implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    /**
     * Наименование очререди по которому будут обрабатываться очереди
     */
    public const QUEUE_NAME = 'job_send_user_callback';

    /**
     * @var string|mixed Идентификатор пользователя
     */
    private string $user_id;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->user_id = $data['user_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     *
     */
    public function handle(CallbackSender $sender)
    {
        # получаем все данные по заказу
        /** @var User $user * */
        $user = User::find($this->user_id);

        if (!$user) {
            throw new LogicException(
                sprintf('Нет данных о пользователе [%s]', $this->user_id)
            );
        }

        $sender->sendNotifications($user);
    }

}
