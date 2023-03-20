<?php

namespace App\Console\Commands;

use App\Models\Auth\MagicToken;
use Illuminate\Console\Command;

class clearToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear Expired tokens';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return MagicToken::expired()->delete();
    }
}
