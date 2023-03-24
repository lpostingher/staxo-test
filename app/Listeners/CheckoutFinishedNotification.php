<?php

namespace App\Listeners;

use App\Events\CheckoutFinished;
use App\Mail\FinishCheckoutMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class CheckoutFinishedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CheckoutFinished $event): void
    {
        Mail::to($event->order->email)->queue(new FinishCheckoutMail($event->order));
    }
}
