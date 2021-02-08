<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class editKeyBehaviourTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testeditKeyBehaviour()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->type('email', 'pm@mail.com');
            $browser->type('password', '123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Kompetensi');
            $browser->visit('/competencies/44');
            $browser->visit('/keyBehaviours/143/edit');
            $browser->select('competency_id', '44');
            $browser->select('level', '3');
            $browser->press('Save');
            $browser->assertPathIs('/competencies');
            $browser->script('console.log("Done Test : Edit Key Behaviour")');
        });
    }
}