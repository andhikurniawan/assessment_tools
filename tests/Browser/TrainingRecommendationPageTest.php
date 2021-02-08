<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TrainingRecommendationPageTest extends DuskTestCase
{
    /**
     * Melihat halaman Training Recommendation
     *
     * @return void
     */
    /** @test */
    public function trainingRecommendation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses home page
                ->clickLink('Login') // menekan tombol Login
                ->click('#email') // menekan selector dengan id = email
                ->type('email', 'admintnd@mail.com') // mengisi email
                ->type('password', '123456') // mengisi password
                ->press('Login') // menekan tombol Login
                ->assertSee('Halo, Admin Training and Development') // mengecek apakah tulisan ini ada
                ->clickLink('Training Recommendation') // menekan menu Training Recommendation
                ->assertSee('Training Recommendation') // mengecek apakah tulisan ini ada
                ->assertPathIsNot('/home') // mengecek apakah path saat ini bukan /home
                ->assertPathIs('/training/recommendation') // mengecek apakah path saat ini /training/recommendation
                ->script('console.log("Done Test : Index TrainingRecommendation")') // console log
            ;
        });
    }
}
