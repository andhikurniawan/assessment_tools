<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VerifiedTrackRecordTest extends DuskTestCase
{
    /**
     * Melakukan verifikasi terhadap data pelatihan pada track record karyawan
     * @test
     * @return void
     */
    public function VerifiedTrackRecordTest()
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
            ->clickLink('Detail') // menekan tombol Detail
            ->assertSee('Daftar Pelatihan dan Sertifikasi Yang Pernah Diikuti') // memastikan berada di halaman ini
            ->click('.tr-Menunggu') // menekan tombol Lihat
            ->assertSee('Detail Data Pelatihan/Sertifikasi') // memastika sudah berada di halaman ini
            ->select('verification', 'Verifikasi') // memilih Verifikasi
            ->press('Submit') // menekan tombol Submit
            ->assertSee('Daftar Pelatihan dan Sertifikasi Yang Pernah Diikuti') // memastikan berada di halaman ini
            ->script('console.log("Done Test : Verifikasi Track Record")') // console log
            ;
        });
    }
}
