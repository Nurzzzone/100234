<?php

namespace App\Jobs\PriceList;

use App\Exports\PriceListExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EmailPriceListExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timeout = 60;

    /**
     * @var PriceListExport
     */
    private $export;

    /**
     * @var string
     */
    private $email;

    public function __construct(string $email, PriceListExport $export)
    {
        $this->export = $export;
        $this->email = $email;
    }

    public function handle()
    {
        Mail::raw('', function(Message $message) {
            $file = Excel::raw($this->export, \Maatwebsite\Excel\Excel::XLSX);
            $message->to($this->email);
            $message->subject('Прайс лист');
            $message->attachData($file, sprintf('ПРАЙС_ЛИСТ_%s.xlsx', now()->format('dmY')));
        });
    }
}
