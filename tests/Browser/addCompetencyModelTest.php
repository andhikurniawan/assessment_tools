<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class addCompetencyModelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testaddCompetencyModel()
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
            $browser->visit('/competencyModels');
            $browser->clickLink('Tambah Model Kompetensi');
            $browser->visit('/competencyModels/create');
            $browser->type('name', 'Software Developer');
            $browser->type('description', 'Software dev');
            $browser->type('name', 'Software Development');
            $browser->type('description', 'Software Development adalah model 
            kompetensi yang berhubungan dengan pengembangan aplikasi');
            $browser->press('Save');
            $browser->assertPathIs('/competencyModels');
            $browser->script('console.log("Done Test : Membuat Model Kompetensi")');
        });
    }
}