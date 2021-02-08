<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class addKeyBehaviourTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testaddKeyBehaviourTest()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->type('email', 'pm@mail.com');
            $browser->type('password', '123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Kompetensi');
            $browser->visit('/competencies');
            $browser->visit('/competencies/44');
            $browser->clickLink('Tambah Key Behaviour');
            $browser->visit('/keyBehaviours/create');
            $browser->select('competency_id', '44');
            $browser->type('description', 'Karyawan tidak pernah berinsiatif mencari informasi');
            $browser->press('Save');
            $browser->assertPathIs('/competencies');
            $browser->script('console.log("Done Test : Membuat Key Behaviour")');
        });

    }
}