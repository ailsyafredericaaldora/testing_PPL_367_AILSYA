<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use function PHPUnit\Framework\callback;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {

            $this->browse(function (Browser $browser) {
                $browser->visit('/register') // Kunjungi halaman registrasi
                        ->type('name', 'Test User') // Isi field nama
                        ->type('email', 'testuser@example.com') // Isi field email
                        ->type('password', 'password') // Isi field password
                        ->type('password_confirmation', 'password') // Isi field konfirmasi password
                        ->press('REGISTER') // Klik tombol "Daftar" (ganti jika teks tombol berbeda)
                        ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard
                        ->assertSee('Test User'); // Pastikan nama pengguna terlihat di halaman
        });
    }
}
