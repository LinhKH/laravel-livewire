<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{

    public $carts, $totalProcutAmout;
    public $full_name,
        $email,
        $phone_number,
        $pincode,
        $address,
        $payment_mode = '',
        $payment_id = '';

    function rules()
    {
        return [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'pincode' => 'required|numeric',
            'address' => 'required|string',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id, 
            'tracking_no' => 'ORD-' . Str::random(10),
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'product_color_id' => $cart->product_color_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->selling_price,
            ]);
        }

        return $order;
    }

    function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder) 
        {
            Cart::where('user_id', auth()->user()->id)->delete();
            $this->dispatch('cart-added-updated');
            $this->dispatch('alertyfy', [
                'text'=> 'Order Placed Successfully',
                'type' => 'success',
            ]);
            return redirect()->to('/thanks-order');
        } else {
            $this->dispatch('alertyfy', [
                'text'=> 'Something Went Wrong',
                'type' => 'error',
            ]);
        }
    }
    function totalProductAmout()
    {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($this->carts as $cart) {
            $this->totalProcutAmout += $cart->product->selling_price * $cart->quantity;
        }
    }
    public function render()
    {
        $this->totalProductAmout();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProcutAmout' => $this->totalProcutAmout,
        ]);
    }
}
