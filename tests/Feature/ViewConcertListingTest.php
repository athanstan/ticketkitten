<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Concert;
use Tests\TestCase;
use Carbon\Carbon;

class ViewConcertListing extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_can_view_a_concert_listing()
    {
        // Arrange
        // Create A concert
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13 2016, 8:00pm'),
            'ticket_price' => 3250, 
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane', 
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.',
        ]);

        $view = $this->view('concerts.show', ['concert' => $concert]);

        $view->assertSee('The Red Chord');
        $view->assertSee('with Animosity and Lethargy');
        $view->assertSee('December 13, 2016');
        $view->assertSee('8:00pm');
        $view->assertSee('32.50');
        $view->assertSee('The Mosh Pit');
        $view->assertSee('123 Example Lane');
        $view->assertSee('Laraville, ON 17916');
        $view->assertSee('For tickets, call (555) 555-5555.');
    }
}
