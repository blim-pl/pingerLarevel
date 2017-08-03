<?php

use Illuminate\Database\Seeder;
use Pinger\Pages\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'O produkcie',
            'alias' => 'about',
            'content' => '<p>Aktualny stan</p><ul>
<li>Możlwiość dodawania/edycji stron - podstawowe funkcje</li>
<li>Możliość dodawania/edycji usług monitoringu</li>
<li>Log monitoringu dostępny w widoku usługi</li>
<li>Dostępne 2 metody sprawdzenia: status odpowiedzi, zawieranie fraz w odpowiedzi</li>
<li>Dostępna 1 metoda wykonywania requestu: CURL (Guzzle)</li>
</ul>',
            'in_menu' => true
        ]);
    }
}
