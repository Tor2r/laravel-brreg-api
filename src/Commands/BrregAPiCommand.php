<?php

namespace Tor2r\BrregAPi\Commands;

use Illuminate\Console\Command;

class BrregAPiCommand extends Command
{
    public $signature = 'laravel-brreg-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
