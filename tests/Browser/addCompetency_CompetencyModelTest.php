<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class addCompetency_CompetencyModelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testaddCompetency_CompetencyModel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->click('#email')
                    ->type('email', 'pm@mail.com')
                    ->type('password', '123456')
                    ->press('Login')        
                    ->assertSee('Welcome')
                    ->clickLink('Grup Kompetensi')
                    ->assertSee('Kelola Grup Kompetensi')
                    ->clickLink('Tambah Grup Kompetensi')
                    ->assertSee('Perusahaan')
                    ->type('name', 'Public Speaking')
                    ->type('description', 'Public Speaking adalah kelompok kompetensi 
                    yang berhubungan dengan kemampuan berkomunikasi')
                    ->press('Save')
                    ->script('console.log("Done Test : Membuat Grup Kompetensi")')
            ;
        });
    }
}