<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 08.08.2017
 * Time: 13:04
 */

namespace Tests\Pinger\ServiceValidations\Methods;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Pinger\Services\Models\Service;
use Pinger\ServiceValidations\Contracts\ITransport;
use Pinger\ServiceValidations\Methods\CheckStatus;
use Tests\Pinger\Fixtures\ServiceValidationsFixtures;
use Tests\TestCase;
use Mockery;

class CheckStatusTest extends TestCase
{
    use DatabaseTransactions;

    private $correctServiceData;

    public function setUp()
    {
        $this->correctServiceData = ServiceValidationsFixtures::$correctServiceData;
        $this->correctServiceData['valid_method'] = 'checkStatus';
        $this->correctServiceData['expects'] = ServiceValidationsFixtures::$expectedCorrectStatus;
    }

    public function testProcessWithSuccess()
    {
        $service = new Service($this->correctServiceData);

        $transportMock = Mockery::mock(ITransport::class);
        $transportMock->shouldReceive('setUrl')->andReturnSelf();
        $transportMock->shouldReceive('setRequestMethod')->andReturnSelf();
        $transportMock->shouldReceive('getResponseCode')->andReturn(ServiceValidationsFixtures::$expectedCorrectStatus);

        $checkMethod = new CheckStatus($service, $transportMock);
        $result = $checkMethod->process()->result();

        $this->assertTrue($result, sprintf('Prcess result should be true [%s]', $result));
    }
}