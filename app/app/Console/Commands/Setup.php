<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To migrate database configuration';

    /**
     * Inline Info
     * @param $string
     * @return void
     */
    public function inlineInfo($string): void
    {
        $this->output->write("\n<info>$string</info>\n");
    }

    /**
     * Execute the console command.
     * @return int
     */
    public function handle(): int
    {
        $progressbar = $this->output->createProgressBar(1);
        $progressbar->start();
        //Create master data Address
//        if (!Schema::hasTable('districts')) :
            Artisan::call('db:seed --class=SqlFileSeeder');
//        endif;

        //Migrate database
        Artisan::call('migrate');

        //Migrate logs table
        if (!Schema::hasTable('logs')) :
            Artisan::call('migrate --path=app/Core/Logger/migrations');
        endif;
//        User::create([
//            'name' => env('USER_NAME'),
//            'email' => env('USER_EMAIL'),
//            'password' => bcrypt(env('USER_PASSWORD')),
//            'role' => 0,
//        ]);
        $progressbar->finish();
        $this->inlineInfo('Application Rental House setup successfully!');

        return CommandAlias::SUCCESS;
    }
}
