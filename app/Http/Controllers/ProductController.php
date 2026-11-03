<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with(['category', 'supplier'])->when($request->filled('q'), fn ($query) => $query->where(fn ($q) => $q->where('name', 'like', '%'.$request->q.'%')->orWhere('sku', 'like', '%'.$request->q.'%')))->latest()->paginate(12)->withQueryString();
        return view('products.index', compact('products'));
    }
    public function create(): View { return view('products.form', ['product' => new Product(), 'categories' => Category::orderBy('name')->get(), 'suppliers' => Supplier::orderBy('name')->get()]); }
    public function store(Request $request): RedirectResponse
    {
        $product = Product::create($this->validated($request));
        if ($product->quantity > 0) {
            $product->movements()->create(['user_id' => $request->user()->id, 'type' => 'entrée', 'quantity' => $product->quantity, 'reference' => 'Stock initial', 'occurred_at' => now()]);
        }
        return redirect()->route('articles.index')->with('success', 'Article ajouté au catalogue.');
    }
    public function show(Product $article): View { return view('products.show', ['product' => $article->load(['category', 'supplier', 'movements.user'])]); }
    public function edit(Product $article): View { return view('products.form', ['product' => $article, 'categories' => Category::orderBy('name')->get(), 'suppliers' => Supplier::orderBy('name')->get()]); }
    public function update(Request $request, Product $article): RedirectResponse
    {
        $data = $this->validated($request, $article);
        unset($data['quantity']);
        $article->update($data);
        return redirect()->route('articles.show', $article)->with('success', 'Article mis à jour.');
    }
    private function validated(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'], 'sku' => ['required', 'string', 'max:255', 'unique:products,sku'.($product ? ','.$product->id : '')],
            'category_id' => ['nullable', 'exists:categories,id'], 'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'quantity' => [$product ? 'sometimes' : 'required', 'integer', 'min:0'], 'minimum_stock' => ['required', 'integer', 'min:0'],
            'unit_cost' => ['required', 'numeric', 'min:0'], 'unit_price' => ['required', 'numeric', 'min:0'],
            'unit' => ['required', 'string', 'max:30'], 'description' => ['nullable', 'string'],
        ]);
    }
}
