<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 08.08.2017
 * Time: 12:16
 */

namespace Tests\Pinger\Requests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Pinger\Pages\Models\Page;

class PageRequestTest extends TestCase
{
    use DatabaseTransactions;

    private static $storeRoute = 'pages.store';
    private static $lang = '/pl/';

    private function getPageCorrectData(array $localData = [])
    {
        $faker = Factory::create();

        $data = [
            'title' => $faker->colorName(),
            'alias' => $faker->domainWord(),
            'content' => $faker->text(200),
            'in_menu' => 0
        ];

        if (!empty($localData)) {
            $data = array_merge($data, $localData);
        }

        return $data;
    }

    private function storePage(array $data)
    {
        Page::create($data);
    }

    public function testCorrectPageRequestDataPageNotInMenu()
    {
        $route = static::$storeRoute;
        $data = $this->getPageCorrectData();
        $alias = $data['alias'];

        //$responseStore = $this->post(route($route), $data);
        $this->storePage($data);

        $responseByAlias = $this->get(static::$lang . $alias);

        //insert and redirect
//        $responseStore->assertStatus(302,  sprintf($route . ' route failure [%s]', $responseStore->getStatusCode()));
        //try open new page
        $responseByAlias->assertStatus(200, sprintf($alias . ' page alias failure [%s]', $responseByAlias->getStatusCode()));
    }

    public function testCorrectPageRequestDataPageInMenu()
    {
        $route = static::$storeRoute;

        $data = $this->getPageCorrectData(['in_menu' => 1]);
        $alias = $data['alias'];

        //$responseStore = $this->post(route($route), $data);
        $this->storePage($data);

        //try to get page by alias
        $page = (new Page)->getByAlias($alias);

        //insert and redirect
        //$responseStore->assertStatus(302, sprintf($route . ' route failure [%s]', $responseStore->getStatusCode()));

        $this->assertNotEmpty($page, 'Page is not found');
        $this->assertTrue(boolval($page->in_menu), 'Page is not in menu');
    }
}