<?php

namespace App\Jobs;


use App\Models\ReceiptTask;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessJobWithReceipt
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ReceiptTask
     */
    public ReceiptTask $receiptTask;

    /**
     * Create a new job instance.
     *
     * @param ReceiptTask $receiptTask
     */
    public function __construct(ReceiptTask $receiptTask)
    {
        $this->receiptTask = $receiptTask;
    }

    /**
     * В зависимости от передеданного объекта в конструкторе выполняем разные задачи
     * @return false|mixed|null
     */
    public function handle(): mixed
    {
        $handlers = [
            'installation' => 'handleInstallationEvent',
            'installation_repositories' => 'handleInstallationUpdateEvent',
            'push' => 'handlePushEvent'
        ];
        return array_key_exists($this->receiptTask->event_name, $handlers) ? call_user_func(
            [
                $this,
                $handlers[$this->receiptTask->event_name]
            ]
        ) : null;
    }
}