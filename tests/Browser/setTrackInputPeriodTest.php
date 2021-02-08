<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class setTrackInputPeriodTest extends DuskTestCase
{
    /**
     * Menentukan waktu periode pengisian track record
     * @test
     * @return void
     */
    public function setTrackRecordInputPeriod()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses homepage
            ->clickLink('Login') // menekan tombol Login
            ->click('#email') // menekan element dengan id = email
            ->type('email', 'admintnd@mail.com') // mengisikan email
            ->type('password', '123456') // mengisikan password
            ->press('Login') // menekan tombol Login
            ->assertSee('Halo, Admin Training and Development') // mengecek apakah ada tulisan seperti ini
            ->clickLink('Track Record') // menekan sub menu Track Record
            ->assertSee('Track Record') // mengecek apakah terdapat tulisan ini
            ->press('Ubah') // menekan tombol ubah
            ->waitFor('input[name="start_date"]', '5') // menunggu selector input 5 detik
            ->type('start_date', '2021-01-24') // mengisi tanggal mulai
            ->type('end_date', '2021-02-01') // mengisi tanggal selesai
            ->press('Simpan') // menekan tombol Simpan
            ->assertPathIs('/track-record') // mengecek apakah posisi saat ini sesuai dengan path ini
            ->script('console.log("Done Test : Mengubah Periode Pengisian Track Record")') // console log
            ;
        });
    }
}
