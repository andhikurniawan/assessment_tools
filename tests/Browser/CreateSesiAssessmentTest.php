<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateSesiAssessmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateSesiAssessment()
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
            ->type('end_date', '01/26/2021')
            ->select('company_id', 'Developer')
            ->press('#submitButton')
            ->assertSee('Pilih Competency Model');
        });
    }
}
