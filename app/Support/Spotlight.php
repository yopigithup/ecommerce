<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

class Spotlight
{
    public function search(Request $request): Collection
    {
        return collect()
            ->merge($this->actions($request->search))
            ->merge($this->products($request->search));
    }

    public function actions(string $search = ''): Collection
    {
        $icon = Blade::render("<x-icon name='o-bolt' class='w-11 h-11 p-2 bg-yellow-50 rounded-full' />");

        return collect([
            [
                'name' => 'View product',
                'description' => 'View product details',
                'icon' => $icon,
                'link' => '/products',
            ],
        ])->filter(function (array $item) use ($search) {
            return str($item['name'] . $item['description'])
                ->lower()
                ->contains(str($search)->lower());
        });
    }

    public function products(string $search = ''): Collection
    {
        return Product::query()
            ->with('category')
            ->where('name', 'like', "%$search%")
            ->orWhereRelation('category', 'name', 'like', "%$search%")
            ->take(5)
            ->get()
            ->map(function (Product $product) {
                return [
                    'name' => $product->name,
                    'description' => $product->category->name,
                    'avatar' => url("storage/{$product->thumbnail}"),
                    'link' => "/products/{$product->id}",
                ];
            });
    }
}
