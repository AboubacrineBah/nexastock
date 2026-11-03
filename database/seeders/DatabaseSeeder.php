<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(['email' => 'admin@nexastock.test'], ['name' => 'Administrateur NexaStock', 'password' => Hash::make('NexaStock2026!')]);
        $cosmetics = Category::firstOrCreate(['name' => 'Cosmétiques'], ['description' => 'Produits naturels et soins']);
        $textile = Category::firstOrCreate(['name' => 'Textile'], ['description' => 'Textiles et créations locales']);
        $supplier = Supplier::firstOrCreate(['name' => 'Karité & Co'], ['email' => 'contact@karite.test', 'phone' => '+223 70 00 00 00', 'address' => 'Bamako, Mali']);

        $examples = [
            ['name' => 'Beurre de karité bio', 'sku' => 'KAR-001', 'category_id' => $cosmetics->id, 'quantity' => 24, 'minimum_stock' => 8, 'unit_cost' => 2500, 'unit_price' => 4000],
            ['name' => 'Huile de baobab', 'sku' => 'HUI-014', 'category_id' => $cosmetics->id, 'quantity' => 6, 'minimum_stock' => 10, 'unit_cost' => 3000, 'unit_price' => 5000],
            ['name' => 'Foulard bogolan', 'sku' => 'TEX-003', 'category_id' => $textile->id, 'quantity' => 15, 'minimum_stock' => 5, 'unit_cost' => 4500, 'unit_price' => 7500],
        ];
        foreach ($examples as $example) {
            $product = Product::firstOrCreate(['sku' => $example['sku']], $example + ['supplier_id' => $supplier->id, 'unit' => 'unité']);
            if ($product->movements()->doesntExist() && $product->quantity > 0) {
                $product->movements()->create(['user_id' => $user->id, 'type' => 'entrée', 'quantity' => $product->quantity, 'reference' => 'Stock initial de démonstration', 'occurred_at' => now()]);
            }
        }
    }
}
