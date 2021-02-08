<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class addCompetencyGroupTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testaddCompetencyGroup()
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
            $browser->visit('/competencyGroups');
            $browser->clickLink('Tambah Grup Kompetensi');
            $browser->visit('/competencyGroups/create');
            $browser->type('name', 'Personal Quality');
            $browser->type('description', 'Personal Quality adalah kompetensi 
            yang berhubungan dengan kemampuan personal individu');
            $browser->press('Save');
            $browser->assertPathIs('/competencyGroups');
        });

    }
}

