<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Console\Command;

class ApplyOverdueFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:apply-overdue-fines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueBookTransactions = BookTransaction::whereHas('transaction', function ($query) {
            $query->where('expected_return_date', '<', Carbon::now());
        })
        ->whereNull('returned_at')
        ->get();

        foreach ($overdueBookTransactions as $bookTransaction) {
            $daysOverdue = Carbon::now()->diffInDays($bookTransaction->transaction->expected_return_date);
            $fineAmount = $daysOverdue * 5; // Assuming a fine of $5 per day

            $bookTransaction->update([
                'fines' => $fineAmount,
            ]);
        }

        $this->info('Fines applied to overdue books successfully.');

        return 0;
    }
}
