<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MelihatReportIndividuTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testReportIndividu()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', '1202174325@mail.com')
            ->type('password', '1202174325')
            ->press('Login')
            ->assertSee('Halo user!')

            ->clickLink('Report Assessment')
            ->assertSee('History Assessment')
            ->assertPathIs('/result')

            ->click('.btnSubmit', '#17')
            ->assertSee('SI 41-08')

            ;
        });
    }
}
