<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(): View { return view('suppliers.index', ['suppliers' => Supplier::withCount('products')->orderBy('name')->paginate(15)]); }
    public function create(): View { return view('suppliers.form', ['supplier' => new Supplier()]); }
    public function store(Request $request): RedirectResponse
    {
        Supplier::create($request->validate(['name' => ['required', 'string', 'max:255'], 'email' => ['nullable', 'email', 'max:255'], 'phone' => ['nullable', 'string', 'max:40'], 'address' => ['nullable', 'string', 'max:255']]));
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté.');
    }
    public function show(Supplier $fournisseur): View { return view('suppliers.show', ['supplier' => $fournisseur->load('products')]); }
    public function edit(Supplier $fournisseur): View { return view('suppliers.form', ['supplier' => $fournisseur]); }
    public function update(Request $request, Supplier $fournisseur): RedirectResponse
    {
        $fournisseur->update($request->validate(['name' => ['required', 'string', 'max:255'], 'email' => ['nullable', 'email', 'max:255'], 'phone' => ['nullable', 'string', 'max:40'], 'address' => ['nullable', 'string', 'max:255']]));
        return redirect()->route('fournisseurs.show', $fournisseur)->with('success', 'Fournisseur mis à jour.');
    }
}
