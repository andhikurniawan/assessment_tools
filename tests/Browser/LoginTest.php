<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->click('#email')
                    ->type('email', 'superadmin@mail.com')
                    ->type('password', 'test123456')
                    ->press('Login')
                    ->assertSee('Welcome, Super Admin !')
                    ->script('console.log("Done Test : Login")');
        });
    }
}
