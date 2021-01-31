<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class detailCompetencyGroupTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testdetailCompetencyGroup()
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
            $browser->visit('/competencyGroups/1');
            $browser->assertSee('Daftar Kompetensi');
            $browser->clickLink('Back');
            $browser->visit('/competencyGroups');
            $browser->script('console.log("Done Test : Detail Grup Kompetensi")');
        });
    }
}