<?php

namespace App\Jobs;

use App\Models\PartnershipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendPartnershipApplicationTo1cJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }


    /**
     * @throws \Exception
     */
    public function handle()
    {
        $response = Http::get('https://api.github.com/users', ['client', $this->client]);

        if ($response->failed()) {
            throw new \Exception('Не получилось отправить заявку');
        }

        PartnershipApplication::where('GUID', $this->client->GUID)
            ->update(['is_sent' => 1]);
    }
}
