<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexReportUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testIndexReportUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', '1202174325@mail.com');
            $browser->type('password', '1202174325');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Report Assessment');
            $browser->visit('/result');
        });
    }
}
