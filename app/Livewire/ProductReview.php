<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Review;

class ProductReview extends Component
{
    public $product;
    public $reviewRating;
    public $reviewComment;

    protected $rules = [
        'reviewRating' => 'required|integer|min:1|max:5',
        'reviewComment' => 'nullable|string|max:255',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function submitReview()
    {
        $this->validate();

        Review::create([
            'product_id' => $this->product->id,
            'rating' => $this->reviewRating,
            'comment' => $this->reviewComment,
        ]);

        // Reset form fields
        $this->reset(['reviewRating', 'reviewComment']);

        // Optionally, refresh the product data to update ratings
        $this->product = $this->product->fresh(); // Refreshes the product to get the latest reviews
    }

    public function render()
    {
        return view('livewire.produphpct-review', [
            'reviews' => $this->product->reviews,
        ]);
    }
}
