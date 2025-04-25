<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Note;

class NotesTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testNotesFeature()
    {
        $this->browse(function (Browser $browser) {
            // Buat user untuk login
            $user = User::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ]);

            // Login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@gmail.com')
                    ->type('password', 'password')
                    ->press('LOG IN')
                    ->assertPathIs('/dashboard')
                    ->assertSee('Catatan');

            // Buat catatan baru
            $browser->visit('/notes/create')
                    ->assertSee('Tambah Catatan')
                    ->type('title', 'Catatan Dusk')
                    ->type('description', 'Ini adalah catatan dari Dusk test.')
                    ->press('SIMPAN')
                    ->assertPathIs('/notes')
                    ->assertSee('Catatan Dusk');

            // Edit catatan
            $note = Note::where('judul', 'Catatan Dusk')->first();

            $browser->visit("/notes/{$note->id}/edit")
                    ->assertSee('Edit Catatan')
                    ->type('title', 'Catatan Dusk Updated')
                    ->type('description', 'Catatan telah diubah lewat Dusk.')
                    ->press('UPDATE')
                    ->assertPathIs('/notes')
                    ->assertSee('Catatan Dusk Updated');

            // Lihat detail
            $browser->visit("/notes/{$note->id}")
                    ->assertSee('Catatan Dusk Updated')
                    ->assertSee('Catatan telah diubah lewat Dusk.');

            // Hapus catatan
            $browser->visit('/notes')
                    ->press("@delete-note-{$note->id}") // pastikan kamu pakai Dusk selector
                    ->assertDontSee('Catatan Dusk Updated');
        });
    }
}
