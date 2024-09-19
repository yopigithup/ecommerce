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

class EditProduct extends Component
{
    use Toast;

    public ?Product $product;
    public string $name;
    public ?string $category_id = null;
    public ?string $description = "";
    public string $cost_price;
    public string $sell_price;
    public ?bool $status = false;


    public Collection $productsSearchable;


    public function search(string $value = '')
    {
        $this->productsSearchable = Product::query()
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:190',
            'category_id' => 'nullable',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'description' => 'required|max:6500',
            'status' => 'boolean',
        ];
    }

    public function mount(Product $product)
    {

        $this->product = $product;
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->cost_price = $this->product->cost_price;
        $this->sell_price = $this->product->sell_price;
        $this->description = $this->product->description;
        $this->status = $this->product->status;

        $this->search();
    }



    public function editProduct()
    {
        $data = $this->validate();

        $this->product->update($data);

        $this->toast("Product edited", "Product with #{$this->product->id} is successfully edited", position: 'toast-bottom');

        $this->redirectRoute('products.index');
    }
    public function render()
    {
        return view('livewire.products.edit-product');
    }
}
