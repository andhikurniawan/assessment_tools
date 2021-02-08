<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * Menguji Login
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->click('#email')
                    ->type('email', 'pm@mail.com')
                    ->type('password', '123456')
                    ->press('Login')        
                    ->assertSee('Welcome')
                    ->script('console.log("Done Test : Akses Login")')
                    ;
        });
    } }
