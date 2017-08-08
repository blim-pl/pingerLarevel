<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 02.08.2017
 * Time: 12:31
 */

namespace Tests\Pinger\ServiceValidations;

use Pinger\ServiceValidations\Transports\CurlGuzzle;
use Tests\Pinger\Fixtures\ServiceValidationsFixtures;
use Tests\TestCase;

class CurlGuzzleTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new CurlGuzzle([
            'url' => ServiceValidationsFixtures::$correctUrl,
            'method' => ServiceValidationsFixtures::$requestMethod
        ]);
    }

    public function testCorrectUrlResponseStatus()
    {
        $response = $this->client->getResponseCode();

        $this->assertEquals(
            ServiceValidationsFixtures::$expectedCorrectStatus,
            $response,
            sprintf('Request to ' . ServiceValidationsFixtures::$correctUrl . ' fails [%s]', $response));
    }

    public function textCorrectUrlResponseContent()
    {
        $response = $this->client->getResponseContent();

        $this->assertNotEmpty($response, Service('Response from url ' . ServiceValidationsFixtures::$correctUrl . ' is empty'));
    }
}