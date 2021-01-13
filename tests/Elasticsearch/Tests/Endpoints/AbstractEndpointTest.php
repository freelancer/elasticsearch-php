<?php

namespace Elasticsearch\Tests\Endpoints;

use Elasticsearch\Endpoints\AbstractEndpoint;
use PHPUnit\Framework\TestCase;

class AbstractEndpointTest extends TestCase
{
    private $endpoint;

    public static function invalidParameters()
    {
        return [
            [['invalid' => 10]],
            [['invalid' => 10, 'invalid2' => 'another']],
        ];
    }

    /**
     * @dataProvider invalidParameters
     */
    public function testInvalidParamsCauseErrorsWhenProvidedToSetParams(array $params)
    {
        $this->expectException(\Elasticsearch\Common\Exceptions\UnexpectedValueException::class);
        $this->endpoint->expects($this->once())
            ->method('getParamWhitelist')
            ->willReturn(['one', 'two']);

        $this->endpoint->setParams($params);
    }

    protected function setUp(): void
    {
        $this->endpoint = $this->getMockForAbstractClass(AbstractEndpoint::class);
    }
}
