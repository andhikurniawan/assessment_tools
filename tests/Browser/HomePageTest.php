<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    /**
     * Mengakses Halaman Home Page
     * @test
     * @return void
     */
    public function HomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // mengakses home page
                    ->assertSee('Web Assessment') // mengecek apakah ada tulisan ini
                    ->script('console.log("Done Test : Akses Home Page")') // console log
                    ;
        });
    }
}
