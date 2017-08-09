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
        $user = \App\User::first();

        Service::create([
            'title' => 'Sprawdzenie statusu opdowiedzi - kod HTTP',
            'url' => 'http://trojmiasto.pl',
            'is_active' => true,
            'valid_method' => 'checkStatus',
            'expects' => 200,
            'emails' => 'blim@go2.pl',
            'user_id' => $user->id
        ]);

        Service::create([
            'title' => 'Sprawdzenie treści strony - konwersja na UTF8',
            'url' => 'http://trojmiasto.pl',
            'is_active' => true,
            'valid_method' => 'checkContent',
            'expects' => 'Wiadomości',
            'emails' => 'blim@o2.pl',
            'user_id' => $user->id
        ]);
    }
}
