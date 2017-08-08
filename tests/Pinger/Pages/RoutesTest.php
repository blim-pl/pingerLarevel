<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 08.08.2017
 * Time: 10:36
 */

namespace Tests\Pinger\Pages;


use Illuminate\Support\Facades\Route;
use Pinger\Pages\Models\Page;
use Pinger\Pages\Routes;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    private $routes = [
        'pages.index',
        'pages.show'
    ];

    public function testWebRouteConfig()
    {
        Routes::web();

        foreach ($this->routes as $route) {
            $result = Route::has($route);
            $this->assertTrue($result, sprintf('Route [%s] has been not found.', $route));
        }
    }

    public function testPagesRouteCorrectResult()
    {
        $route = array_shift($this->routes);

        $response = $this->get(route($route));

        $response->assertStatus(200, sprintf($route . ' route failure [%s]', $response->getStatusCode()));
    }

    public function testPageShowByAliasCorrectResult()
    {
        $page = Page::whereNotNull('alias')->first();

        if ($page) {
            $response = $this->get($page->alias);
        }

        if ($page) {
            $response->assertStatus(200, sprintf($page->alias . ' alias failure [%s]', $response->getStatusCode()));
        } else {
            $this->assertNotEmpty($page, 'Page not found');
        }
    }
}