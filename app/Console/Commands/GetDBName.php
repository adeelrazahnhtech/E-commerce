<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class GetDBName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to know the current database name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $DB_name = DB::getDatabaseName();
       $this->info("Database Name: $DB_name");

    }
}
