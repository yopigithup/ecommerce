<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Checkout')]
class Checkout extends Component
{
    public ?Order $order;

    public function mount(Order $order)
    {
        $this->order  = $order;
    }

    public function pay()
    {
        // your logic here

        //clear cart
        // CartModel::where('customer_id', auth()->id())->delete(); //  until he/she pay the price
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
