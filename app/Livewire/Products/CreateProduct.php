<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class createProduct extends Component
{
    use Toast;


    public string $name;

    public string $cost_price;
    public string $sell_price;
    public ?string $status;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:190',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'status' => 'boolean',
        ];
    }


    public function mount() {}

    public function createProduct()
    {
        $this->validate();
        $password = Str::password();

        Product::create(
            [
                'name' => $this->name,
                'cost_price' => $this->cost_price,
                'sell_price' => $this->sell_price,
                'status' => $this->status,

            ]
        );

        // channels (sms, email, slack, ....)

        $this->toast("Product add", "User successfully added", position: 'toast-bottom');

        return redirect()->to('/Products');
    }
    public function render()
    {
        return view('livewire.products.create-product');
    }
}
