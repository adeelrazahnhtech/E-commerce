<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchDataFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the data from an external API and store in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $response =  Http::get('');
       $data = $response->json();
       User::create($data);
       $this->info("Data fetched and stored successfully! ");
    }
}
