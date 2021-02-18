<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChangeCompetencyModelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
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
            ->clickLink('Delete')
            ->select('model')
            ->press('#addModel')
            ->assertSee('Software dev Tel U 1')
            ->press('#saveEdit')
            ->waitFor('.SweatAlert')
            ->press('OK')
            ->assertSee('Assessment Session')
            ->assertPathIs('/assessment');

        });
    }
}
