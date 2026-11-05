<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CaptureDashboardTest extends DuskTestCase
{
    public function test_captures_all_main_pages(): void
    {
        $email = env('DUSK_EMAIL');
        $password = env('DUSK_PASSWORD');
        $product = Product::query()->first();
        $category = Category::query()->first();
        $supplier = Supplier::query()->first();

        $this->assertNotEmpty($email, 'DUSK_EMAIL doit être défini dans .env.dusk.local.');
        $this->assertNotEmpty($password, 'DUSK_PASSWORD doit être défini dans .env.dusk.local.');
        $this->assertNotNull($product, 'Aucun article trouvé. Exécutez php artisan migrate --seed.');
        $this->assertNotNull($category, 'Aucune catégorie trouvée. Exécutez php artisan migrate --seed.');
        $this->assertNotNull($supplier, 'Aucun fournisseur trouvé. Exécutez php artisan migrate --seed.');

        $pages = [
            'dashboard' => route('dashboard', [], false),
            'articles-index' => route('articles.index', [], false),
            'articles-create' => route('articles.create', [], false),
            'article-show' => route('articles.show', $product, false),
            'article-edit' => route('articles.edit', $product, false),
            'categories-index' => route('categories.index', [], false),
            'categories-create' => route('categories.create', [], false),
            'category-edit' => route('categories.edit', $category, false),
            'suppliers-index' => route('fournisseurs.index', [], false),
            'suppliers-create' => route('fournisseurs.create', [], false),
            'supplier-show' => route('fournisseurs.show', $supplier, false),
            'supplier-edit' => route('fournisseurs.edit', $supplier, false),
            'movements-index' => route('mouvements.index', [], false),
            'movements-create' => route('mouvements.create', [], false),
            'reports' => route('rapports', [], false),
        ];

        $this->browse(function (Browser $browser) use ($email, $password, $pages): void {
            $browser->visit('/connexion')
                ->screenshot('connexion')
                ->type('email', $email)
                ->type('password', $password)
                ->press('Se connecter')
                ->assertPathIs('/');

            foreach ($pages as $name => $url) {
                $browser->visit($url)->screenshot($name);
            }
        });
    }
}
