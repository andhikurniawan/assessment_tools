<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class addCompetencyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testaddCompetency()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', 'pm');
            $browser->type('email', 'pm@mail.com');
            $browser->type('password', '123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Kompetensi');
            $browser->visit('/competencies');
            $browser->clickLink('Tambah Kompetensi');
            $browser->visit('/competencies/create');
            $browser->type('name', 'Information seeking');
            $browser->type('code', 'IS001');
            $browser->type('description', 'Information seeking adalah kemampuan untuk mencari informasi');
            $browser->select('type','hard_skill');
            $browser->select('competency_group_id', '21');
            $browser->type('question', 'Apa hal yang dilakukan Saudara ketika memiliki keinginan untuk mengetahui lebih banyak informasi tentang berbagai hal, orang atau masalah?');
            $browser->select('status', 'private');
            $browser->press('Save');
            $browser->assertPathIs('/competencies');
            $browser->script('console.log("Done Test : Membuat Kompetensi")')
            ;
        });
    }
}
