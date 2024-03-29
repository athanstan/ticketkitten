<?php

namespace Tests\Unit;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConcertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_formatted_date()
    {

        $concert =  Concert::factory()->make(
            [
                'date' => Carbon::parse('2016-12-01, 8:00pm'),
            ]);

        $this->assertEquals('December 1, 2016', $concert->formmated_date);
    }

     /** @test */
     public function can_get_formatted_start_time()
     {
        $concert =  Concert::factory()->make(
            [
                'date' => Carbon::parse('2016-12-01, 17:00:00'),
            ]);

        $this->assertEquals('5:00pm', $concert->formmated_start_time);
     }

     /** @test */
     public function can_get_ticket_price_in_dollars()
     {
        $concert =  Concert::factory()->make(
            [
                'ticket_price' => 6750,
            ]);

        $this->assertEquals('67.50', $concert->ticket_price_in_dollars);
     }

     /** @test */
     public function concerts_with_a_published_at_date_are_published()
     {
        $publishedConcertA = Concert::factory()->create(['published_at' => Carbon::parse('-1 week')]);
        $publishedConcertB = Concert::factory()->create(['published_at' => Carbon::parse('-1 week')]);
        $unublishedConcert = Concert::factory()->create(['published_at' => null ]);

        $publishedConcerts = Concert::published()->get();

        $this->assertTrue($publishedConcerts->contains($publishedConcertA));
        $this->assertTrue($publishedConcerts->contains($publishedConcertB));
        $this->assertFalse($publishedConcerts->contains($unublishedConcert));
     }
}