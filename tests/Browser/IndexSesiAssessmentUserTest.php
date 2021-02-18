<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexSesiAssessmentUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testIndexSesiAssessmentUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', '1202174325@mail.com')
            ->type('password', '1202174325')
            ->press('Login')
            ->assertSee('Halo user!')

            ->clickLink('Sesi Assessment')
            ->assertSee('Halo, I KOMANG GEDE ANDHI KURNIAWAN')
            ->assertPathIs('/assessmentUser')

         ;
        });
    }
}
