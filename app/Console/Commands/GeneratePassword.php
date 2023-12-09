<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GeneratePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a random password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = Str::random(8);
        $this->info("Generate password: $password");
    }
}
