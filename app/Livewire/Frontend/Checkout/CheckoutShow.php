<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\On;
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


    #[On('validationAll')]
    function validationForAll()
    {
        return $this->validate();
    }
    #[On('transaction-completed')]
    function onlineOrder($payment_id)
    {
        $this->payment_id = $payment_id;
        $this->payment_mode = 'Paid By Paypal';
        $onlOrder = $this->placeOrder();
        if($onlOrder) 
        {
            Cart::where('user_id', auth()->user()->id)->delete();
            $this->dispatch('cart-added-updated');
            session()->flash('message','Order Placed Successfully');
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

        foreach ($this->carts as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);

            if($cartItem->product_color_id !== null){
                $cartItem->product_color->where('id', $cartItem->product_color_id)->update([
                    'quantity' => $cartItem->product_color->quantity - (int)$cartItem->quantity,
                ]);
            } else {
                $cartItem->product->where('id', $cartItem->product_id)->update([
                    'quantity' => $cartItem->product->quantity - (int)$cartItem->quantity,
                ]);
            }
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
            session()->flash('message','Order Placed Successfully');
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
        $this->full_name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmout();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProcutAmout' => $this->totalProcutAmout,
        ]);
    }
}
