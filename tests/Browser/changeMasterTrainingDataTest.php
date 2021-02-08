<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class changeMasterTrainingDataTest extends DuskTestCase
{
    /**
     * Mengubah master data pelatihan
     * @test
     * @return void
     */
    public function ChangeMasterTrainingData()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses homepage
                ->clickLink('Login') // menekan tombol Login
                ->click('#email') // menekan element dengan id = email
                ->type('email', 'admintnd@mail.com') // mengisikan email
                ->type('password', '123456') // mengisikan password
                ->press('Login') // menekan tombol Login
                ->assertSee('Halo, Admin Training and Development') // mengecek apakah ada tulisan seperti ini
                ->clickLink('Training Recommendation') // menekan sub menu Training Recommendation
                ->assertSee('Training Recommendation') // mengecek apakah terdapat tulisan ini
                ->clickLink('Buat Master Pelatihan') // menekan tombol Buat Msater Pelatihan
                ->assertSee('Master Data Pelatihan') // mengekcek apakah ada tulisan ini
                ->clickLink('Edit') // menekan tombol Edit pada Data Pelatihan
                ->assertSee('Edit Data Pelatihan') // mengecek apakah sedang dihalaman ini
                ->type('link', 'https://www.example.com')
                ->press('Update') // menekan tombol simpan
                ->assertPathIs('/training/master') // mengecek apakah posisi saat ini sesuai dengan path ini
                ->script('console.log("Done Test : Ubah Master Data")') // console log
            ;
        });
    }
}
