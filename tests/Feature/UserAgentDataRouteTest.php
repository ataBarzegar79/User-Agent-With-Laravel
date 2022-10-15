<?php

namespace Tests\Feature;


use Tests\TestCase;

class UserAgentDataRouteTest extends TestCase
{
    public function testRouteRequestReturns200Response(): void
    {
        $response = $this->getJson(route('user-agent-data'));
        $response->assertOk();
    }

    public function testRouteRequestWillReturnRightCountOfData()
    {
        $itemCount = 10;
        $response = $this->getJson(route('user-agent-data', ['quantity' => $itemCount]));
        $response->assertJsonCount($itemCount, "data");
    }

    public function testRouteRequestWillReturnRightContentOfData()
    {
        $deviceCategory = 'mobile';
        $response = $this->getJson(route('user-agent-data', ['device' => $deviceCategory]));
        $response->assertJsonFragment(["deviceCategory" => "mobile"]);
        $response->assertJsonMissing(["deviceCategory" => "desktop"]);
        $response->assertJsonMissing(["deviceCategory" => "tablet"]);
    }

    public function testSendingWrongRangeOfNumberForQuantityWillReturnError()
    {
        $itemCount = 0;
        $response = $this->getJson(route('user-agent-data', ['quantity' => $itemCount]));
        $response->assertJsonValidationErrorFor("quantity");
    }

    public function testSendingWrongDeviceTypeWillReturnValidationError()
    {
        $deviceCategory = 'moz';
        $response = $this->getJson(route('user-agent-data', ['device' => $deviceCategory]));
        $response->assertJsonValidationErrorFor("device");
    }

}
