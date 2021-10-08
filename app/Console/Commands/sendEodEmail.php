<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\cronEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    protected $description = 'Send email notification to Admin about the end of day quote';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
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

        $quote = DB::table('quotes')
        ->join('customers', 'quotes.customer_id', 'customers.id')
        ->whereDate('quotes.created_at', Carbon::today())
        ->get();

        Mail::to('admin@admin.com')
        ->send(new cronEmail($quote));
    }
}
