<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditSesiAssessmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEditSesiAssessmentTest ()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', 'admin_hr1@mail.com')
            ->type('password', '12345678')
            ->press('Login')
            ->assertSee('Halo, Admin Appraisal')

            ->clickLink('Edit')
            ->assertSee('Edit Sesi Assessment')
            ->type('name', 'Assessment Tes')
            ->select('category', 'development')
            ->press('#saveEdit')
            ->waitFor('.SweatAlert')
            ->press('OK')
            ->assertSee('Assessment Session')
            ->assertPathIs('/assessment');
        });
    }
}
