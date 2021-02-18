<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShowReportAssessmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testShowReportAssessment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', 'admin_hr1@mail.com')
            ->type('password', '12345678')
            ->press('Login')
            ->assertSee('Halo, Admin Appraisal')

            ->clickLink('Report Assessment')
            ->assertSee('Assessment Result')
          
            
            ->clickLink('View','#66')
            ->assertSee('ass3')
            ->press('View')
            ->assertPathIs('/result/detail')
            ->press('View')
            ->assertPathIs('/result/detail/laporan')
            ->assertSee('Report Individu')
            ;
        });
    }
}
