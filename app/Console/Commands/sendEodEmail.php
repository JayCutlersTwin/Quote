<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Quote;
use Illuminate\Console\Command;

class sendEodEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EodReminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user about the end of day quote';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, Quote $quotes)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

    }
}
