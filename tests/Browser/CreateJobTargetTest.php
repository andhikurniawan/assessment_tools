<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateJobTargetTest extends DuskTestCase
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
            $browser->clickLink('Buat Job Target');
            $browser->visit('/jobTargets/create');
            $browser->type('job_name', 'Programmer');
            $browser->type('job_code', 'PRO');
            $browser->type('job_code', 'PRG');
            $browser->type('number_position', '3');
            $browser->press('Save');
            $browser->assertPathIs('/jobTargets');
        });
    }
}
