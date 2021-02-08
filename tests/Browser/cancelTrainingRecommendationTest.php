<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class cancelTrainingRecommendationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function cancelTrainingRecommendation()
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
                    ->clickLink('Edit') // menekan tombol Edit
                    ->assertSee('Edit Data Rekomendasi Pelatihan') // mengekcek apakah ada tulisan ini
                    ->radio('cancelTraining', 'Ya') // memilih opsi Ya
                    ->press('Update') // menekan tombol update
                    ->assertPathIs('/training/recommendation') // mengecek apakah posisi saat ini sesuai dengan path ini
                    ->script('console.log("Done Test : Batalkan Training Recommendation")') // console log
                    ;
        });
    }
}
