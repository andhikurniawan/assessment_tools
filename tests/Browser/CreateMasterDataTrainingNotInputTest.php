<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateMasterDataTrainingNotInputTest extends DuskTestCase
{
    /**
     * Menmbuat master data pelatihan tanpa mengisi dan menekan tombol submit
     *
     * @test
     * @return void
     */
    public function createMasterDataPelatihanWithoutInput()
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
                ->clickLink('Tambahkan Data Pelatihan') // menekan tombol Tambahkan Data Pelatihan
                ->assertSee('Tambah Data Pelatihan') // mengecek apakah sedang dihalaman ini
                ->press('Simpan') // menekan tombol simpan
                ->assertPathIs('/training/master') // mengecek apakah posisi saat ini sesuai dengan path ini
                // karena tidak ada masukkan, maka kembali ke halaman /training/master/create
                // ->assertPathIs('/training/master/create')
                ->script('console.log("Done Test : Submit Master Data Tanpa Input")') // console log
            ;
        });
    }
}
