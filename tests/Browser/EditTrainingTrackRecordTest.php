<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditTrainingTrackRecordTest extends DuskTestCase
{
    /**
     * Melakukan penugbahan data pelatihan pada track record
     * @test
     * @return void
     */
    public function EditTrainingTrackRecord()
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
                ->clickLink('Edit') // menekan tombol Edit
                ->assertSee('Edit Data Pelatihan / Sertifikasi') // mengecek apakah sudah di halaman ini
                ->type('name', 'Pelatihan Laravel Dusk') // mengisi nama pelatihan
                ->type('host', 'Laravel Dusk') // mengisi nama pelaksana
                ->type('duration', '7') // mengisi durasi pelatihan
                ->type('start_date', '2021-01-24') // mengisi tanggal mulai
                ->type('end_date', '2021-02-01') // mengisi tanggal berakhir
                ->type('description', 'Pengubahan dilakukan oleh Laravel Dusk') // mengisi deskripsi
                ->attach('certificate', 'C:\Users\Adhitya K\Documents\assessment2020\public\uploaded_file\373_1610787680.png') // mengunggah file
                ->type('link', 'https://www.example.com') // mengisi link pelatihan
                ->type('reason_associated_work', 'Karena data pelatihan ini diubah otomatis.') // mengisi alasan keterkaitan pelatihan dengan pekerjaan
                ->press('Update') // menekan tombol Update
                ->assertPathIs('/track-record') // mengecek apakah sudah berada di Track Record
                ->script('console.log("Done Test : Edit Data Pelatihan Track Record")') // console log
                ;
        });
    }
}
