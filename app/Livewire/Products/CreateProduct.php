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
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class CreateProduct extends Component
{
    use Toast;


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


    public Collection $categoriesSearchable;

    public function mount()
    {
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




    public function createProduct()
    {
        $data = $this->validate();

        $data['code'] = random_int(99999, 100000);

        Product::create($data);


        $this->toast("Product add", "User successfully added", position: 'toast-bottom');

        return redirect()->to('/products');
    }
    public function render()
    {
        return view('livewire.products.create-product');
    }
}
