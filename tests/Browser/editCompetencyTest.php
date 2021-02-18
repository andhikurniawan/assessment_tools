<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class editCompetencyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testeditCompetency()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', 'pm');
            $browser->type('email', 'pm@mail.com');
            $browser->type('password', '123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Kompetensi');
            $browser->visit('/competencies/43/edit');
            $browser->select('type', 'soft_skill  ');
            $browser->select('status', 'public');
            $browser->press('Save');
            $browser->assertPathIs('/competencies');
            $browser->script('console.log("Done Test : Edit Kompetensi")')
            ;
        });
    }
}
