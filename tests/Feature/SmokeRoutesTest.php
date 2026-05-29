<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_main_pages_load_successfully(): void
    {
        $routes = [
            '/',
            '/tasks',
            '/tasks/create',
            '/tip-calculator',
            '/password-generator',
            '/expenses',
            '/expenses/create',
            '/reservations',
            '/reservations/create',
            '/notes',
            '/notes/create',
            '/events',
            '/events/create',
            '/recipes',
            '/recipes/create',
            '/memory-game',
            '/surveys',
            '/surveys/create',
            '/stopwatch',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200);
        }
    }
}
