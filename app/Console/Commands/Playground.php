<?php

namespace App\Console\Commands;

use App\Adapters\StripeAdapterInterface;
use Illuminate\Console\Command;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

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

    public function __construct(
        private readonly StripeAdapterInterface $stripeAdapter
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $intent = $this->stripeAdapter->createPaymentIntent(100);
        $method = $this->stripeAdapter->getPaymentMethod();

        dd($intent, $this->stripeAdapter->confirmPaymentIntent($intent, $method));
    }
}
