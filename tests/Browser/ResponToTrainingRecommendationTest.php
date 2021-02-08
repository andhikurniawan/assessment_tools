<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ResponToTrainingRecommendationTest extends DuskTestCase
{
    /**
     * Melakukan respon Terima pada rekomendasi pelatihan
     * @test
     * @return void
     */
    public function respondToTrainingRecommendation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses homepage
                ->clickLink('Login') // menekan tombol Login
                ->click('#email') // menekan element dengan id = email
                ->type('email', '1202170038@mail.com') // mengisikan email
                ->type('password', '1202170038') // mengisikan password
                ->press('Login') // menekan tombol Login
                ->assertSee('Halo user') // mengecek apakah ada tulisan seperti ini
                ->clickLink('Training Recommendation') // menekan sub menu Training Recommendation
                ->assertSee('Training Recommendation') // mengecek apakah terdapat tulisan ini
                ->click('.tr-Menunggu.Respon') // menekan tombol Detail
                ->assertSee('Detail Data Rekomendasi Pelatihan') // mengecek apakah sudah di halaman ini
                ->select('verification', 'Terima') // memilih dropdown verifikasi dan menyetujui
                ->press('Submit') // menekan tombol Submit
                ->assertPathIs('/training/recommendation') // mengecek apakah posisi saat ini sesuai dengan path ini
                ->script('console.log("Done Test : Respon Rekomendasi Pelatihan")') // console log
            ;
        });
    }
}
