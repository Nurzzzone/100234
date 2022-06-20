<?php

namespace App\Console\Commands;

use App\Jobs\PriceList\EmailPriceListExport;
use App\Models\Finance\PriceListMailing;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class QueuePriceListExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price-list-export:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue price list export';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $mailings = PriceListMailing::query()->where('mail_at', now())->get();

        foreach($mailings as $mailing) {
            if (! $user = User::query()->find($mailing->user_id)) {
                continue;
            }

            dispatch(new EmailPriceListExport($user->email, $mailing));
        }

        $this->info('ОПЕРАЦИЯ ВЫПОЛНЕНО УСПЕШНО: ОТПРАВКА ПРАЙС ЛИСТОВ');

        return static::SUCCESS;
    }
}
