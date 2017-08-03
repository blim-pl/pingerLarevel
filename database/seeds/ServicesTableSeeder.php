<?php

use Illuminate\Database\Seeder;
use Pinger\Services\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'title' => 'Sprawdzenie statusu opdowiedzi - kod HTTP',
            'url' => 'http://trojmiasto.pl',
            'is_active' => true,
            'valid_method' => 'checkStatus',
            'expects' => 200
        ]);

        Service::create([
            'title' => 'Sprawdzenie treści strony - konwersja na UTF8',
            'url' => 'http://trojmiasto.pl',
            'is_active' => true,
            'valid_method' => 'checkContent',
            'expects' => 'Wiadomości'
        ]);
    }
}
