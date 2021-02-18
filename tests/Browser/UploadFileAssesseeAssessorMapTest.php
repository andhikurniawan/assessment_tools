<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UploadFileAssesseeAssessorMapTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUnggahBerkas()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', 'admin_hr1@mail.com')
            ->type('password', '12345678')
            ->press('Login')
            ->assertSee('Halo, Admin Appraisal')

            ->clickLink('Add Session')
            ->assertSee('Tambah Sesi Assessment')
            ->type('name', 'Assessment Tes')
            ->select('category', 'development')
            ->select('status', 'not_started')
            ->select('expired', 'one_year')
            ->type('start_date', '01/27/2021')
            ->type('end_date', '01/28/2021')
            ->select('company_id', 'Developer')
            ->press('#submitButton')
            ->assertSee('Pilih Competency Model')
            ->assertPathIs('/competencyModel/create')

            ->select('#model', 'information')
            ->press('Add')
            ->assertSee('information')
            ->press('#submitButton')
            ->assertSee('Mapping Participants')
            ->assertPathIs('/participant')

            ->press('#download')
            ->waitForDialog(1)
            ->acceptDialog()
            ->attach('file','D:\Document\template_participants (9).xlsx')
            ->waitForDialog(1)
            ->acceptDialog()
            ->assertSee('Assesse')
            ->assertPathIs('/participant/detail');

        });
    }
}
