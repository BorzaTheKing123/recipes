<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:generate {value?} {salt?} {length?} {iterations=600000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a password out of a value and a salt.';
    private $values = ['domena1.sbr.com', 'domena2.sbr.com', 'domena3.sbr.com', 'domena4.sbr.com', 'domena5.sbr.com', ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $value = $this->argument('value');
        $salt = $this->argument('salt');
        $length = $this->argument('length');
        $iterations = $this-> argument('iterations');

        if (! $salt) {
            $salt = $this->ask('Enter a salt. It should be at least the length of the generated password. Default is random ->', random_bytes(16));
        }

        while (! in_array($value, $this->values)) {
            $value = $this->ask('Enter a value: ');
        }

        if (! $length) {
            $length = intval($this->ask('Enter desired length of password! Default is ->', 20));
        }

        $hash = hash_pbkdf2("sha256", $value, $salt, $iterations, $length);
        dump($hash);
    }
}
