<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->assertSee('Laravel')
            ->clickLink('Log in')
            ->assertPathIs('/login')
            ->type('email', 'admin@gmail.com')
            ->type('password', 'password')
            ->press('LOG IN')
            ->assertPathIs('/dashboard');
        });
    }
}
