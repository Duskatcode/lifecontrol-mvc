<?php

namespace Tests\Feature;

use Tests\TestCase;

class UtilityModulesTest extends TestCase
{
    public function test_tip_calculator_calculates_total(): void
    {
        $response = $this->post('/tip-calculator', [
            'amount' => 100,
            'percentage' => 15,
        ]);

        $response->assertStatus(200);
        $response->assertSee('Resultado');
        $response->assertSee('Total a pagar');
        $response->assertSee('115.00');
    }

    public function test_password_generator_creates_password(): void
    {
        $response = $this->post('/password-generator', [
            'length' => 12,
            'include_uppercase' => 1,
            'include_lowercase' => 1,
            'include_numbers' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertSee('Contraseña generada');
    }
}
