<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use App\Notifications\OverdueNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue';

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
        $nearDueDate = now()->addDays(3); // Adjust this threshold as needed

        // Query service requests with due dates within 3 days
        $transactions = Transaction::where('expected_return_date', '<=', $nearDueDate)->get();



        $librarians = User::where('role', 1)->get();

        foreach ($librarians as $librarian) {
            foreach ($transactions as $transaction) {
                $dueDate = Carbon::parse($transaction->expected_return_date);

                // Calculate the difference in days between due date and now
                $diffInDays = $dueDate->diffInDays(Carbon::now());

                $notificationMessage = '';

                if ($diffInDays == 0) {
                    $notificationMessage = "Due today";
                } elseif ($diffInDays == 1) {
                    $notificationMessage = "Due tomorrow";
                } else {
                    $notificationMessage = "Due in $diffInDays days";
                }

                $librarian->notify(new OverdueNotification($transaction->user, $notificationMessage));
            }
        }
    }
}
