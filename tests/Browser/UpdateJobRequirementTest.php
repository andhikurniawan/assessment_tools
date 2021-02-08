<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateJobRequirementTest extends DuskTestCase
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
            $browser->visit('/jobRequirements?job_target_id=3');
            $browser->visit('/jobRequirements/5921/edit');
            $browser->select('competency_id', '5');
            $browser->type('skill_level', '2');
            $browser->press('Save');
        });
    }
}
