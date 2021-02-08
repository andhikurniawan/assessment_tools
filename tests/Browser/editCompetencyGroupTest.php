<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class editCompetencyGroupTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testeditCompetencyGroup()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', 'pm@mail.com');
            $browser->type('password', '123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Grup Kompetensi');
            $browser->visit('/competencyGroups/1/edit');
            $browser->type('name', 'Komunikasi');
            $browser->press('Save');
            $browser->assertPathIs('/competencyGroups');
            $browser->script('console.log("Done Test : Edit Grup Kompetensi")');
        });
    }
}