<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\productForm;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class EditProduct extends Component
{
    use Toast;

    public ?Product $product;
    public string $name;
    public ?string $category_id = null;

    public string $cost_price;
    public string $sell_price;
    public ?bool $status = false;


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:190',
            'category_id' => 'nullable',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
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
        $this->status = $this->product->status;
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
