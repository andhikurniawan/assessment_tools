<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditAssesseeMapTest extends DuskTestCase
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
            ->press('.detail')
            ->assertSee('Assessor List')
            ->press('.deleteAssessor')
            ->press('Add Assessor')
            ->whenAvailable('#addAssessor', function($modal){

                $modal->assertSee('Add Assessor')
                ->select('assessor')
                ->select('relation')
                ->select('status')
                ->press('Save')                
                ;
            })
            ->assertSee('Assessor List')
            ->press('Save');

        });
    }
}
