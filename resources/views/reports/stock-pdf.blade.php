<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>État du stock - NexaStock</title>
    <style>
        @page {
            margin: 24px;
        }

        body {
            color: #1f2937;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        h1 {
            color: #173b68;
            font-size: 22px;
            margin: 0 0 4px;
        }

        .subtitle,
        .date {
            color: #64748b;
        }

        .summary {
            background: #f1f5f9;
            border: 1px solid #dbe3ec;
            margin: 18px 0;
            padding: 10px 12px;
        }

        .summary span {
            display: inline-block;
            margin-right: 32px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background: #173b68;
            color: #fff;
            font-size: 8px;
            text-align: left;
            text-transform: uppercase;
        }

        th,
        td {
            border: 1px solid #dbe3ec;
            padding: 7px 6px;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .number {
            text-align: right;
            white-space: nowrap;
        }

        .low-stock {
            color: #b45309;
            font-weight: bold;
        }

        .in-stock {
            color: #047857;
        }
    </style>
</head>

<body>
    <h1>État du stock</h1>
    <div class="subtitle">NexaStock — Inventaire des produits</div>
    <div class="date">Généré le {{ now()->locale('fr')->translatedFormat('d F Y à H:i') }}</div>

    <div class="summary">
        <span><strong>Articles :</strong> {{ $products->count() }}</span>
        <span><strong>Unités en stock :</strong> {{ number_format($products->sum('quantity'), 0, ',', ' ') }}</span>
        <span><strong>Valeur au coût :</strong> {{ number_format((float) $stockValue, 0, ',', ' ') }} F CFA</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Article</th>
                <th>Catégorie</th>
                <th class="number">Stock</th>
                <th class="number">Seuil minimum</th>
                <th class="number">Coût unitaire</th>
                <th class="number">Valeur du stock</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name ?? '—' }}</td>
                    <td class="number">{{ number_format($product->quantity, 0, ',', ' ') }} {{ $product->unit }}</td>
                    <td class="number">{{ number_format($product->minimum_stock, 0, ',', ' ') }}</td>
                    <td class="number">{{ number_format((float) $product->unit_cost, 0, ',', ' ') }} F CFA</td>
                    <td class="number">{{ number_format($product->quantity * (float) $product->unit_cost, 0, ',', ' ') }} F CFA</td>
                    <td class="{{ $product->is_low_stock ? 'low-stock' : 'in-stock' }}">
                        {{ $product->is_low_stock ? 'Stock faible' : 'En stock' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Aucun produit enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
