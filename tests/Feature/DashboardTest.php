<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_redirect_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
