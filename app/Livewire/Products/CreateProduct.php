<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class CreateProduct extends Component
{
    use Toast;
    use WithFileUploads;

    public string $name;
    public ?string $category_id = null;
    public ?string $description = "";
    public string $cost_price;
    public string $sell_price;
    public ?bool $status = false;

    public Collection $categoriesSearchable;

    public $image;

    public function mount()
    {
        $this->search();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:190',
            'category_id' => 'nullable',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'description' => 'sometimes|max:6500',
            'status' => 'boolean',
            'image' => 'image|max:2024|mimes:jpeg,png,gif,webp'
        ];
    }

    public function search(string $value = '')
    {
        $this->categoriesSearchable = Product::query()
            ->where('name', 'like', "%$value%")
            ->take(10)
            ->orderBy('name')
            ->get();
    }

    public function createProduct()
    {
        $this->validate();

        $data = $this->except(['image', 'categoriesSearchable']);

        $data['code'] = random_int(100000, 999999); // reference number

        $product = Product::create($data);

        if ($this->image) {
            $url = $this->image->store('products', 'public');

            $product->update([
                'url' => 'storage/' . $url,
            ]);
        }

        $this->reset(['name', 'category_id', 'cost_price', 'sell_price', 'description', 'status']);

        $this->toast("Product add", "User successfully added", position: 'toast-bottom');

        return redirect()->to('/products');
    }

    public function render()
    {
        return view('livewire.products.create-product');
    }
}
