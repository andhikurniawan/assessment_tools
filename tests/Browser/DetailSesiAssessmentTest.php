<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DetailSesiAssessmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDetailSesiAssessment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', 'admin_hr1@mail.com')
            ->type('password', '12345678')
            ->press('Login')
            ->assertSee('Halo, Admin Appraisal')

            ->clickLink('Detail')
            ->assertSee('Detail Sesi Assessment');

        });
    }
}
