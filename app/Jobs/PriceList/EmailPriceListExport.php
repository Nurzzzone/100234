<?php

namespace App\Jobs\PriceList;

use App\Models\Finance\PriceListMailing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EmailPriceListExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timeout = 60;
    private $mailing;
    private $email;
    private $date;

    public function __construct(string $email, $mailing)
    {
        $this->mailing = $mailing;
        $this->email = $email;
        $this->date = now()->format('d-m-Y');
    }

    public function handle()
    {
        Mail::raw("Цены от $this->date", function(Message $message) {
            $message->to($this->email);
            $message->subject('Прайс лист');
            $message->attachData($this->loadExcelBinary(), "ПРАЙС_ЛИСТ_$this->date.xlsx");
        });

        PriceListMailing::query()->where('id', $this->mailing->id)->update([
            'mail_at' => now()->addMinutes($this->mailing->interval)->setTime(9, 0),
            'mailed_at' => now()
        ]);
    }

    protected function loadExcelBinary(): string
    {
        return Excel::raw(unserialize($this->mailing->payload), \Maatwebsite\Excel\Excel::XLSX);
    }
}
