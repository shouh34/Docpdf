<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Documents;
use App\Notifications\ContractEndingSoon;


#[Signature('app:notify-ending-contracts')]
#[Description('Command description')]
class NotifyEndingContracts extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

           $targetDate = now()->addDays(7)->toDateString();

    Documents::with('user')
        ->whereDate('end_date', $targetDate)
        ->get()
        ->each(function ($document) {
            $document->user?->notify(
                new ContractEndingSoon($document)
            );
        });

    return self::SUCCESS;
    }
}
