<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Jobs\ProcessJobWithReceipt;
use App\Models\ReceiptTask;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Тут происходит вызов Job с заданием ReceiptTask
 */
class WebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $receipt = ReceiptTask::create([
        ]);
        ProcessJobWithReceipt::dispatch($receipt);
        return new Response('Good', 200);
    }
}