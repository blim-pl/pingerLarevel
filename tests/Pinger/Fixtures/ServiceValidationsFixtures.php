<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 08.08.2017
 * Time: 12:56
 */

namespace Tests\Pinger\Fixtures;


class ServiceValidationsFixtures
{
    public static $correctUrl = 'http://google.com';
    public static $requestMethod = 'GET';
    public static $expectedCorrectStatus = 200;
    public static $correctServiceData = [
        'title' => 'test 01',
        'is_active' => 1,
        'url' => 'http://google.pl',
        'valid_method' => '', //checkStatus | checkContent
        'expects' => '',
        'emails' => 'blim@go2.pl'
    ];
}