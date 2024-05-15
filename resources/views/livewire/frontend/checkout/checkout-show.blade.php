<div class="py-3 py-md-4 checkout">
    <div class="container">
        <h4>Checkout</h4>
        <hr>

        @if ($totalProcutAmout > 0)
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Item Total Amount :
                        <span class="float-end">$ {{ $totalProcutAmout }}</span>
                    </h4>
                    <hr>
                    <small>* Items will be delivered in 3 - 5 days.</small>
                    <br />
                    <small>* Tax and other charges are included ?</small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Basic Information
                    </h4>
                    <hr>

                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" wire:model='full_name' id="full_name" name="full_name" class="form-control"
                                    placeholder="Enter Full Name" />
                                @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="number" wire:model='phone_number' id="phone_number" name="phone_number" class="form-control"
                                    placeholder="Enter Phone Number" />
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" wire:model='email' id="email" name="email" class="form-control"
                                    placeholder="Enter Email Address" />
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pin-code (Zip-code)</label>
                                <input type="number" wire:model='pincode' id="pincode" name="pincode" class="form-control"
                                    placeholder="Enter Pin-code" />
                                @error('pincode') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea name="address" wire:model='address' id="address" class="form-control" rows="2"></textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3" wire:ignore>
                                <label>Select Payment Mode: </label>
                                <div class="d-md-flex align-items-start">
                                    <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button wire:loading.attr='disabled' class="nav-link active fw-bold"
                                            id="cashOnDeliveryTab-tab" data-bs-toggle="pill"
                                            data-bs-target="#cashOnDeliveryTab" type="button" role="tab"
                                            aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on
                                            Delivery</button>
                                        <button wire:loading.attr='disabled' class="nav-link fw-bold"
                                            id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment"
                                            type="button" role="tab" aria-controls="onlinePayment"
                                            aria-selected="false">Online Payment</button>
                                    </div>
                                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                                        <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel"
                                            aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                            <h6>Cash on Delivery Mode</h6>
                                            <hr />
                                            <button wire:click='codOrder' wire:loading.attr='disabled' type="button"
                                                class="btn btn-primary">
                                                <span wire:loading wire:target='codOrder'>Place Order</span>
                                                <span wire:loading.remove wire:target='codOrder'>Place Order (Cash on
                                                    Delivery)</span>

                                            </button>

                                        </div>
                                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                            aria-labelledby="onlinePayment-tab" tabindex="0">
                                            <h6>Online Payment Mode</h6>
                                            <hr />
                                            {{-- <button type="button" class="btn btn-warning">Pay Now (Online
                                                Payment)</button> --}}
                                            <div>
                                                <div id="paypal-button-container"></div>
                                            </div>
                                            <p id="result-message"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        @else
        <div class="card card-body shadow text-center p-md-5">
            <h4 class="text-danger">Your Cart is Empty to Checkout</h4>
            <p>Please add some product to your cart.</p>
            <a href="{{ url('/collections') }}" class="btn btn-warning">Continue Shopping</a>
        </div>
        @endif
    </div>
</div>

@push('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=AWpzMDk9sqaNusWJhw85-p3nNVw3mCYYnpM5mLjxUO2k-v7qwzm-L9wD0vLXnWzrZbQ6RaEMXAiu31HR"></script>

<script>
window.paypal
  .Buttons({
    onInit(data, actions) {
        acttions.disable();
    },
    onClick(data, actions) {
        
        if(!document.getElementById('full_name').value
            ||!document.getElementById('phone_number').value
            ||!document.getElementById('email').value
            ||!document.getElementById('pincode').value
            ||!document.getElementById('address').value
        ) {

            Livewire.dispatch('validationAll');
            return false;
        } else {
            @this.set('full_name',document.getElementById('full_name').value);
            @this.set('phone_number',document.getElementById('phone_number').value);
            @this.set('email',document.getElementById('email').value);
            @this.set('pincode',document.getElementById('pincode').value);
            @this.set('address',document.getElementById('address').value);
        }
    },
    createOrder(data, actions) {
      try {
        return actions.order.create({
            purchase_units: [{
                amount: {
                  currency_code: "USD",
                  value: "0.1",
                },
              }],
            });
      
      } catch (error) {
        console.error(error);
        resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
      }
    },
    onApprove(data, actions) {
      try {
        return actions.order.capture().then(function (orderData) {
                // console.log('Captured Success', orderData, JSON.stringify(orderData, null, 2));
                const result = orderData.purchase_units[0].payments.captures[0];
                if(result.status === 'COMPLETED') {
                    Livewire.dispatch('transaction-completed',  {payment_id: result.id} );
                }
        })
      } catch (error) {
        console.error(error);
        resultMessage(
          `Sorry, your transaction could not be processed...<br><br>${error}`,
        );
      }
    },
  })
  .render("#paypal-button-container");
  
// Example function to show a result to the user. Your site's UI library can be used instead.
function resultMessage(message) {
  const container = document.querySelector("#result-message");
  container.innerHTML = message;
}
</script>
@endpush