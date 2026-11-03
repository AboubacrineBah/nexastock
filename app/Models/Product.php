<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id', 'supplier_id', 'name', 'sku', 'description', 'quantity', 'minimum_stock', 'unit_cost', 'unit_price', 'unit'];
    protected $casts = ['unit_cost' => 'decimal:2', 'unit_price' => 'decimal:2'];
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function supplier(): BelongsTo { return $this->belongsTo(Supplier::class); }
    public function movements(): HasMany { return $this->hasMany(StockMovement::class); }
    public function getIsLowStockAttribute(): bool { return $this->quantity <= $this->minimum_stock; }
}
