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
use Pinger\ServiceValidations\Methods\CheckContent;
use Tests\Pinger\Fixtures\ServiceValidationsFixtures;
use Tests\TestCase;
use Mockery;

class CheckContentTest extends TestCase
{
    use DatabaseTransactions;

    private $correctServiceData;

    public function setUp()
    {
        $this->correctServiceData = ServiceValidationsFixtures::$correctServiceData;
        $this->correctServiceData['valid_method'] = 'checkContent';
        $this->correctServiceData['expects'] = ServiceValidationsFixtures::$expectedCorrectContent;
    }

    public function testProcessWithSuccess()
    {
        $service = new Service($this->correctServiceData);

        $transportMock = Mockery::mock(ITransport::class);
        $transportMock->shouldReceive('setUrl')->andReturnSelf();
        $transportMock->shouldReceive('setRequestMethod')->andReturnSelf();
        $transportMock->shouldReceive('getContent')->andReturn('<html>' . ServiceValidationsFixtures::$expectedCorrectContent .'</html>');
        $transportMock->shouldReceive('getHeaders')->andReturnNull();

        $checkMethod = new CheckContent($service, $transportMock);
        $result = $checkMethod->process()->result();

        $this->assertTrue($result, sprintf('Expected phrases has been not found [%s]', ServiceValidationsFixtures::$expectedCorrectContent));
    }
}