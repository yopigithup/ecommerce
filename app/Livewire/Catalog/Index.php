<?php

namespace App\Livewire\Catalog;

use App\Models\Category;
use App\Models\Product;
use App\Models\WhishList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.guest')]
#[Title('Product lists')]
class Index extends Component
{
    use Toast;

    #[Url]
    public string $search = '';
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    #[Url]
    public array $categories_id = [];

    public int $page = 1;
    public int $perPage = 5;


    public bool $loading = false;

    public function mount($categoryId = null): void
    {
        //        if ($categoryId) {
        //            $this->categories_id[] = $categoryId;
        //        }
    }

    public function whishList($product)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        WhishList::firstORCreate(
            ['user_id' => auth()->id(), 'product_id' => $product],
            ['user_id' => auth()->id(), 'product_id' => $product],
        );


        $this->toast("Whish list updated.", "Whish list updated.", position: 'toast-bottom');
    }

    public function clearFilters(): void
    {
        $this->categories_id = [];
        $this->search = '';
        $this->loading = false;

        $this->products;
    }

    #[Computed]
    public function getProductsProperty(): LengthAwarePaginator
    {
        return Product::query()
            ->published()
            ->active()
            ->with(['category:name,id'])
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->when($this->categories_id, fn(Builder $q) => $q->whereRelation('category', fn(Builder $query) => $query->whereIn('id', $this->categories_id)))
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage, ['*'], 'product-feed', $this->page);
    }

    public function loadMore(): void
    {
        $this->loading = true;
        sleep(1);
        $this->perPage += 5;
        if ($this->total()->count() <= $this->perPage) {
            $this->loading = false;
        }
    }

    #[Computed]
    public function total(): Builder
    {
        return Product::query()->published()->active()
            ->where('name', 'like', "%$this->search%");
    }

    public function render(): View
    {
        return view('livewire.catalogs.index', [
            'categories' => $this->categories(),
            'products' => $this->products,
        ]);
    }

    protected function categories(): Collection
    {
        return Category::query()
            // ->whereNotNull('parent_id')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('name')
            ->get();
    }

    public function show($product)
    {
        $this->redirectRoute('product.show', ['product' => $product]);
    }
}
