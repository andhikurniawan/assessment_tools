<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddSessionAndTeamTest extends DuskTestCase
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
            $browser->clickLink('Job Target');
            $browser->visit('/jobTargets');
            $browser->clickLink('2');
            $browser->clickLink('3');
            $browser->clickLink('4');
            $browser->visit('/jobTargets/235/edit');
            $browser->select('assessment_session_id', '2');
            $browser->press('Save');
            $browser->assertPathIs('/jobTargets');
        });
    }
}
