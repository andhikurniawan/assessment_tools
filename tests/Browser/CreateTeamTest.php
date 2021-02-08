<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTeamTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', 'superadmin@mail.com');
            $browser->type('password', 'test123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Teams');
            $browser->visit('/teams');
            $browser->clickLink('Buat Team');
            $browser->visit('/teams/create');
            $browser->type('name', 'Team Baru');
            $browser->select('assessment_session_id', '5');
            $browser->press('Save');
            $browser->assertPathIs('/teams');
        });
    }
}
