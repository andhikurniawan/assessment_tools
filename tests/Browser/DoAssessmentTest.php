<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DoAssessmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSession()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->clickLink('Login')
            ->click('#email')
            ->type('email', '1202173102@mail.com')
            ->type('password', '1202173102')
            ->press('Login')
            ->assertSee('Halo user!')

            ->clickLink('Sesi Assessment')
            ->assertPathIs('/assessmentUser')
            ->press('View', '#69')
            ->assertPathIs('/assessmentUser/detail')
            ->press('Start')
            ->assertPathIs('/session')

            ->radio('0', '2-2')
            ->radio('1', '3-3')
            ->press('#btnsubmit')
            ->assertSee('Semua Jawaban Berhasil Tersimpan')

            ;
        });
    }
}
