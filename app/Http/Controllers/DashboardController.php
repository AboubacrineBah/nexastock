<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'productCount' => Product::count(),
            'lowStockCount' => Product::whereColumn('quantity', '<=', 'minimum_stock')->count(),
            'stockValue' => Product::select(DB::raw('COALESCE(SUM(quantity * unit_cost), 0) as total'))->value('total'),
            'supplierCount' => Supplier::count(),
            'movements' => StockMovement::with(['product', 'user'])->latest('occurred_at')->limit(8)->get(),
            'lowStockProducts' => Product::with('category')->whereColumn('quantity', '<=', 'minimum_stock')->orderBy('quantity')->limit(6)->get(),
        ]);
    }

    public function reports(): View
    {
        return view('reports', [
            'products' => Product::with('category')->orderBy('quantity')->get(),
            'movementCount' => StockMovement::count(),
            'stockValue' => Product::select(DB::raw('COALESCE(SUM(quantity * unit_cost), 0) as total'))->value('total'),
        ]);
    }
}
