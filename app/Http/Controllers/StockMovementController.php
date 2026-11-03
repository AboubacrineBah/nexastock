<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function index(Request $request): View
    {
        $movements = StockMovement::with(['product', 'user'])->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))->latest('occurred_at')->paginate(15)->withQueryString();

        return view('movements.index', compact('movements'));
    }

    public function create(): View
    {
        return view('movements.form', ['products' => Product::orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['product_id' => ['required', 'exists:products,id'], 'type' => ['required', 'in:entrée,sortie,ajustement'], 'quantity' => ['required', 'integer', 'min:1'], 'reference' => ['nullable', 'string', 'max:255'], 'notes' => ['nullable', 'string'], 'occurred_at' => ['required', 'date']]);
        DB::transaction(function () use ($data, $request) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $next = match ($data['type']) {
                'entrée' => $product->quantity + $data['quantity'],
                'sortie' => $product->quantity - $data['quantity'],
                'ajustement' => $data['quantity'],
            };
            if ($next < 0) {
                throw ValidationException::withMessages(['quantity' => 'La quantité disponible est insuffisante pour cette sortie.']);
            }
            $product->update(['quantity' => $next]);
            $product->movements()->create($data + ['user_id' => $request->user()->id]);
        });

        return redirect()->route('mouvements.index')->with('success', 'Mouvement enregistré et stock mis à jour.');
    }
}
