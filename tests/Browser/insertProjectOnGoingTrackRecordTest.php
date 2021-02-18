<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class insertProjectOnGoingTrackRecordTest extends DuskTestCase
{
    /**
     * Mengisi Data Project Sedang Berlangsung pada Track Record
     * @test
     * @return void
     */
    public function insertProjectOnGoingTrackRecord()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses homepage
                ->clickLink('Login') // menekan tombol Login
                ->click('#email') // menekan element dengan id = email
                ->type('email', '1202170038@mail.com') // mengisikan email
                ->type('password', '1202170038') // mengisikan password
                ->press('Login') // menekan tombol Login
                ->assertSee('Halo user') // mengecek apakah ada tulisan seperti ini
                ->clickLink('Track Record') // mengakses Track Record
                ->assertSee('Track Record') // mengecek apakah sudah di halaman ini
                ->clickLink('Tambah Data Project') // menekan tombol Tambah Data Pelatihan
                ->assertSee('Tambah Data Project') // mengecek apakah sudah di halaman ini
                ->type('project_name', 'Project dari Laravel Dusk') // mengisi nama project
                ->type('platform', 'Laravel Web App') // mengisi nama platform
                ->type('position', 'Tester') // mengisi posisi
                ->select('status', 'Sedang Berlangsung') // menekan pilihan Sedang Berlangsung
                ->type('start_date', '2021-01-24') // mengisi tanggal mulai
                ->type('description', 'Pengisian dilakukan oleh Laravel Dusk') // mengisi deskripsi
                ->press('Tambahkan') // menekan tombol Tambahkan
                ->assertPathIs('/track-record') // mengecek apakah sudah berada di Track Record
                ->script('console.log("Done Test : Mengisikan Project Sedang Berjalan pada Track Record")') // console log
            ;
        });
    }
}
