<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class detailCompetencyModelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDetailCompetencyModel()
    {
            $this->browse(function (Browser $browser) {
                $browser->visit('/');
                $browser->clickLink('Login');
                $browser->visit('/login');
                $browser->type('email', 'pm@mail.com');
                $browser->type('password', '123456');
                $browser->press('Login');
                $browser->assertPathIs('/home');
                $browser->clickLink('Model Kompetensi');
                $browser->visit('/competencyModels/22');
                $browser->assertSee('Tambah Kompetensi');
                $browser->script('console.log("Done Test : Detail Model Kompetensi")');
        });
    }
}
