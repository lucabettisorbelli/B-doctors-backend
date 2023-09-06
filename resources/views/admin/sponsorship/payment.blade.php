@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-2">Effettua il pagamento</h1>
        <div class="row">
            <div class="col-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Hai selezionato il pacchetto: {{ $selectedPackage->hours }} ore </h5>
                        <p class="card-text">{{ $selectedPackage->price }} €</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- Form per il pagamento -->
                <form id="payment-form" action="{{ route('admin.sponsorship.processpayment') }}" method="POST">
                    @csrf
                    <!-- Elemento per il modulo di pagamento di Braintree -->
                    <div id="bt-dropin"></div>
                    <input type="hidden" name="selected_package" id="selected_package" value="{{ $selectedPackage->id }}">
                    <button class="btn btn-warning" type="submit">Effettua il pagamento</button>
                </form>
            </div>

        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>

    <!-- Il tuo script personalizzato per gestire il pagamento -->
    <script>
        let form = document.querySelector('#payment-form');
        let submitButton = form.querySelector('button[type="submit"]');

        let clientToken = "{{ $clientToken }}";

        braintree.dropin.create({
            authorization: clientToken,
            container: '#bt-dropin'
        }, function(createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                    if (requestPaymentMethodErr) {
                        console.error(requestPaymentMethodErr);
                        return;
                    }

                    let nonceInput = document.createElement('input');
                    nonceInput.setAttribute('type', 'hidden');
                    nonceInput.setAttribute('name', 'payment_method_nonce');
                    nonceInput.setAttribute('value', payload.nonce);
                    form.appendChild(nonceInput);
                    form.submit();
                });
            });
        });
    </script>
@endsection