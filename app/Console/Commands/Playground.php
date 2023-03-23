<?php

namespace App\Console\Commands;

use App\Events\CheckoutFinished;
use App\Facades\StripeFacade;
use App\Models\Order;
use Illuminate\Console\Command;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $order = Order::firstOrFail();
        CheckoutFinished::dispatch($order);
    }
}
