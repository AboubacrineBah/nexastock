<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CaptureDashboardTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_captures_dashboard(): void
    {
        $this->browse(function (Browser $browser) {
            $email = env('DUSK_EMAIL');
            $password = env('DUSK_PASSWORD');

            $this->assertNotEmpty($email, 'DUSK_EMAIL doit etre defiini dans .env.dusk.local.');
            $this->assertNotEmpty($password, 'DUSK_PASSWORD doit etre defini dans .env.dusk.local.');

            $this->browse(function (Browser $browser) use ($email, $password): void {
                $browser->visit('/connexion')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Se connecter')
                    ->assertPathIs('/')
                    ->screenshot('dashboard');
            });

        });
    }
}
