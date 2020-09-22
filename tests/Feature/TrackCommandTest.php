<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Retailer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackCommandTest extends TestCase
{
    /** @test */
    public function it_tracks_product_stock()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $bestBuy = Retailer::create(['name' => 'Best Buy']);
        $stock = new Stock([
            'price' => '1000',
            'url' => 'foo.com',
            'sku' => '12345',
            'in_stock' => true
        ]);
        $bestBuy->addStock($switch, $stock);

        $this->artisan('track');

        $this->assertTrue($stock->fresh()->in_stock);
    }
}
