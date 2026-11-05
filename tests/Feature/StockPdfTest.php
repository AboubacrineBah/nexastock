<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_download_the_stock_pdf(): void
    {
        $this->get(route('rapports.stock.pdf'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_download_a_pdf_containing_the_stock_report(): void
    {
        $this->actingAs(User::factory()->create());

        Product::create([
            'name' => 'Produit test',
            'sku' => 'TEST-001',
            'quantity' => 8,
            'minimum_stock' => 3,
            'unit_cost' => 1250,
            'unit_price' => 1500,
            'unit' => 'pièce',
        ]);

        $this->get(route('rapports.stock.pdf'))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf')
            ->assertHeader('content-disposition', 'attachment; filename=etat-stock-'.now()->format('Y-m-d').'.pdf')
            ->assertSee('%PDF-', false);
    }
}
