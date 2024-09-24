<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Livewire\Forms\productForm;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use Toast;
    use WithFileUploads;

    public ?Product $product;
    public string $name;
    public ?string $category_id = null;
    public ?string $description = "";
    public string $cost_price;
    public string $sell_price;
    public ?string $code = "";
    public ?bool $status = false;

    public Collection $categoriesSearchable;

    public $image;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:190',
            'category_id' => 'nullable',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'description' => 'sometimes|max:6500',
            'status' => 'boolean',
            'image' => Rule::when(stripos($this->image, 'products') === false, 'image|max:2024|mimes:jpeg,png,gif,webp'),
        ];
    }

    public function mount(?Product $product)
    {
        $this->product = $product;
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->cost_price = $this->product->cost_price;
        $this->sell_price = $this->product->sell_price;
        $this->description = $this->product->description;
        $this->code = $this->product->code;
        $this->status = $this->product->status;

        $this->image = $this->product->url ?: url('storage/products/product.jpeg');

        $this->search();
    }


    public function search(string $value = '')
    {
        $this->categoriesSearchable = Category::query()
            ->where('name', 'like', "%$value%")
            ->take(10)
            ->orderBy('name')
            ->get();
    }


    public function editProduct()
    {
        $this->validate();

        $data = $this->only(['category_id', 'name', 'description', 'sell_price', 'cost_price', 'status']);

        $this->product->update($data);

        if ($this->image && stripos($this->image, 'products') === false) {

            $url = $this->image->store('products', 'public');

            $this->product->update([
                'url' => 'storage/' . $url,
            ]);
        }

        $this->reset(['name', 'category_id', 'cost_price', 'sell_price', 'description', 'status']);

        $this->toast("Product edited", "Product with #{$this->product->id} is successfully edited", position: 'toast-bottom');

        $this->redirectRoute('products.index');
    }


    public function render()
    {
        return view('livewire.products.edit-product');
    }
}
