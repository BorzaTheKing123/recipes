<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePhrasePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phrase:password {value?} {salt?} {num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a password out of slovenian phrases';

    private $values = ['domena1.sbr.com', 'domena2.sbr.com', 'domena3.sbr.com', 'domena4.sbr.com', 'domena5.sbr.com', 'a'];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $value = $this->argument('value');
        $salt = $this->argument('salt');
        $num = intval($this->argument('num'));
        $iterations = '600000';

        if (! $salt) {
            $salt = $this->ask('Enter a salt. Default are random bytes ->', random_bytes(16));
        }

        while (! in_array($value, $this->values)) {
            $value = $this->ask('Enter a value (allowed values are saved in $value. For test you can use a ');
        }

        $f = fopen("slovenske_besede_fran.json", "r");
        $json_array  = json_decode(fread($f, filesize("slovenske_besede_fran.json")), true);
        $elementCount  = count($json_array["besede"]);

        $factor = intval(ceil(log($elementCount, 2) / 4));

        if (! $num) {
            $num = 10;
            $length = $factor*intval($this->ask('Enter desired number of words to use! Default is ->', 10));
        } else {
            $length = $factor*$num;
        }

        if (! $salt) {
            $salt = $this->ask('Enter a salt. It should be at least ' . $length . ' long! Default are 16 random bytes ->', random_bytes(16));
        }

        $hash = hash_pbkdf2("sha256", $value, $salt, $iterations, $length);

        $final = [];

        for ($i = 0; $i < $length; $i += $factor) {
            $temp = "";
            for ($x = 0; $x < $factor; $x++) {
                $temp = $temp . $hash[$i + $x];
            }

            $jump = hexdec($temp);
            while ($jump >= $elementCount) {
                $jump -= $elementCount;
            }
            $final[] = $json_array["besede"][$jump];
        }
        
        $signs = "/!$%&?*+-_.:,;@#()[]{}1234567890<>|";
        $s_len = 35;

        $password = "";
        $hash = hash_pbkdf2("sha256", $value, $salt, 100000, 2*$num);
        for ($x = 0; $x < 2*($num - 1); $x += 2) {
            $value = "";

            for ($y = 0; $y < 2; $y++) {
                $value = $value . $hash[$x + $y];
            }

            $jump = hexdec($value);
            while ($jump >= $s_len) {
                $jump -= $s_len;
            }

            $password = $password . $final[intval($x/2)] . $signs[$jump];
        }

        $password = $password . $final[intval($x/2)];

        dump($password);
    }
}
