<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InsertTrainingTest extends DuskTestCase
{
    /**
     * Mencoba untuk memasukan data pelatihan
     * @test
     * @group insert-training-data
     * @return void
     */
    public function insertTrainingData()
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
                ->type('name', 'Pelatihan dari Test') // isi nama pelatihan
                ->type('host', 'PHPUnit') // nama pelaksana
                ->type('duration', '7')
                ->type('start_date', '2021-01-24')
                ->type('end_date', '2021-02-1')
                ->type('description', 'Pelatihan dibuat oleh PHPUnit')
                ->press('Simpan')
                ->assertPathIs('/training/master') // mengecek apakah posisi saat ini sesuai dengan path ini
                ->script('console.log("Done Test : Mengisikan Master Data Pelatihan")') // console log
            ;
        });
    }
}
