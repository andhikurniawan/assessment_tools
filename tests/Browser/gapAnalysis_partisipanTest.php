<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class gapAnalysis_partisipanTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPartisipan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Login');
            $browser->visit('/login');
            $browser->type('email', 'superadmin@mail.com');
            $browser->type('password', 'test123456');
            $browser->press('Login');
            $browser->assertPathIs('/home');
            $browser->clickLink('Gap Analysis');
            $browser->visit('/gap/company/9');
            $browser->assertSee('Tel-U SI4002');
            $browser->press('View');
            $browser->assertSee('Daftar Partisipan');
            $browser->script('console.log("Done Test : Menampilkan Partisipan Assessment")');
        });
    }
}
