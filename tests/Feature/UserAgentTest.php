<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAgentTest extends TestCase
{
    // Fetch All
    public function testFetchAllResponseJsonMustBeInCorrectStructure()
    {
        $response = $this->getJson(route('user-agent'))
            ->assertOk();
        $response->assertJsonStructure(
            [
                "user_agent" => [],
            ]
        );
    }

    public function testFetchAllUserAgentsResponseJsonMustNotBeNull()
    {
        $response = $this->getJson(route('user-agent'));
        $this->assertNotNull($response["user_agent"]);
    }
    // End of Fetch All

    // Device Filter
    // todo: validations test
    // End of Device Filter

    // Quantity Filter
    public function testFetchWithQuantityFilterResponseJsonItemsCountMustBeCorrect()
    {
        $count = rand(1, 100);
        $response = $this->getJson(route('user-agent', ['quantity' => $count]));
        $this->assertCount($count, $response["user_agent"]);
    }
    // todo: validations test 0 , out of range , incorrect type , Minus
    // End of Quantity Filter

    // Both Quantity & Device Filter
    // End of Quantity Filter
}
