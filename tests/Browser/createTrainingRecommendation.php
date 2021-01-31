<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class createTrainingRecommendation extends DuskTestCase
{
    /**
     * Mengajukan rekomendasi pelatihan
     * @test
     * @group create-training-recommendation
     * @return void
     */
    public function CreateTrainingRecommendation()
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
                ->clickLink('Buat Rekomendasi Pelatihan') // menekan tombol Buat Rekomendasi Pelatiahn
                ->clickLink('Ajukan Rekomendasi Pelatihan', 'a') // menekan tombol Ajukan Rekomendasi Pelatihan dengan selector 'a'
                ->waitFor('select', 5) // menunggu modal keluar
                ->select('trainingDropdown') // memilih dropdown pelatihan
                ->radio('trainingType', 'Opsional') // memilih opsional pada sifat pelatihan
                ->press('Ajukan Kepada Karyawan') // menekan tombol Ajukan Kepada Karyawan pada Modal
                ->assertPathIs('/training/recommendation') // mengecek apakah posisi saat ini sesuai dengan path ini
                ->script('console.log("Done Test : Mengajukan Rekomendasi Pelatihan")') // console log
                ;
        });
    }
}
