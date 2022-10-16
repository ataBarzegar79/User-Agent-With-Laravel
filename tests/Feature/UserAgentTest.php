<?php

namespace Tests\Feature;

use Illuminate\Support\Arr;
use Tests\TestCase;

class UserAgentTest extends TestCase
{
    // Fetch a Single User Agent
    public function testFetchSingleUserAgentResponseStatusMustBeOk()
    {
        $this->getJson(route('user-agent'))->assertOk();
    }

    public function testFetchSingleUserAgentResponseJsonMustBeInCorrectStructure()
    {
        $response = $this->getJson(route('user-agent'));
        $response->assertJsonStructure(
            [
                "user_agent" => [],
            ]
        );
    }

    public function testFetchSingleUserAgentResponseJsonMustNotBeNull()
    {
        $response = $this->getJson(route('user-agent'));
        $this->assertNotNull($response["user_agent"]);
    }
    // End of Fetch a Single User Agent

    // Device Filter
    public function testFetchWithDeviceFilterResponseJsonMustNotBeNull()
    {
        $deviceCategories = ['mobile', 'tablet', 'desktop'];
        $deviceCategory = Arr::random($deviceCategories);
        $response = $this->getJson(route('user-agent', ['device' => $deviceCategory]));
        $response->assertJsonStructure(
            [
                "user_agent" => [],
            ]
        );
        $this->assertNotNull($response["user_agent"]);
    }

    public function testFetchWithDeviceFilterAndIncorrectDevice()
    {
        $deviceCategory = 'random';
        $this->getJson(route('user-agent', ['device' => $deviceCategory]))
            ->assertUnprocessable();
    }

    public function testFetchWithDeviceFilterAndIncorrectDeviceDataType()
    {
        $deviceCategories = [false, 100];
        $deviceCategory = Arr::random($deviceCategories);
        $this->getJson(route('user-agent', ['device' => $deviceCategory]))
            ->assertUnprocessable();
    }
    // End of Device Filter

    // Quantity Filter
    public function testFetchWithQuantityFilterResponseJsonItemsCountMustBeCorrect()
    {
        $count = rand(1, 1000);
        $response = $this->getJson(route('user-agent', ['quantity' => $count]));
        $this->assertCount($count, $response["user_agent"]);
    }

    public function testFetchWithQuantityFilterAndIncorrectQuantity()
    {
        $countArr = [0, -1, 1001];
        $count = Arr::random($countArr);
        $this->getJson(route('user-agent', ['quantity' => $count]))
            ->assertUnprocessable();
    }
    // End of Quantity Filter

    // Both Quantity & Device Filter
    public function testFetchWithBothDeviceAndQuantityFiltersResponseJsonMustBeInCorrectStructureCorrectDataCount()
    {
        $count = rand(1, 1000);
        $deviceCategories = ['mobile', 'tablet', 'desktop'];
        $deviceCategory = Arr::random($deviceCategories);
        $response = $this->getJson(route('user-agent', ['quantity' => $count, 'device' => $deviceCategory]));
        $response->assertJsonStructure(
            [
                "user_agent" => [],
            ]
        );

        $this->assertCount($count, $response["user_agent"]);
    }
    // End of Quantity Filter
}
