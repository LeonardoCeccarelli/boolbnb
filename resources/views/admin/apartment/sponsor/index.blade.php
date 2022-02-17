@extends('layouts.app')

@section('other_meta')
<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
{{-- <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script> --}}

@endsection

@section('content')
<h3 class="text-center my-4">Aggiungi la sponsorizzazione all'appartamento
  <span class="fs-2 fw-bold fst-italic">{{$apartment->title}}</span>
</h3>

<div class="container">
  <div class="row row-cols-3">
    @foreach ($sponsor as $single_sponsor)
    <div class="col d-flex justify-content-center text-center">

      {{-- Single Sponsor Card --}}
      <div class="card" style="width: 18rem;">
        <img src="{{ asset('storage/sponsor_badges/badge_example.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Tipo: {{ $single_sponsor->type }}</h5>
          <p class="card-text">Prezzo: {{ $single_sponsor->price }}</p>
          <p class="card-text">Durata: {{ $single_sponsor->duration }}</p>
        </div>
      </div>

    </div>
    @endforeach
  </div>

  <div class="row row-cols-2 justify-content-center my-3">
    <div class="col">

      {{-- Payment Form --}}
      <form id="payment-form" autocomplete="off" action="{{ route('admin.sponsor.checkout', $apartment) }}"
        method="POST">
        @csrf
        @method('POST')

        <p>card: 4111 1111 1111 1111</p>
        <p>exp: 09/23</p>

        {{-- Select Sponsorship --}}
        <select class="form-select w-50" aria-label="Default select example">
          <option selected disabled="disabled">Seleziona sponsorizzazione</option>
          @foreach ($sponsor as $item)
          <option value="{{ $item->id }}">{{ $item->type }}</option>
          @endforeach
        </select>

        <section>

          {{-- CREDIT CARD --}}
          <div id="dropin-container"></div>

          {{-- Submit Payment Button --}}
          <div class="submit-btn-continer text-center">
            <input class="btn btn-success" type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
          </div>

        </section>

      </form>
      {{-- End Payment Form --}}
    </div>
  </div>

</div>

<script>
  const form = document.querySelector('#payment-form');
  var client_token = '{{ $clientToken }}';
  braintree.dropin.create({
  authorization: client_token,
  container: '#dropin-container',
  // ...plus remaining configuration
  
  }, function (createErr, instance) {
    // Use `dropinInstance` here
    // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
    if (createErr){
      console.log('Create Error', createErr);
      return;
    }   
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      instance.requestPaymentMethod(function (err, payload) {
        if (err) {
          console.log('Request Payment Method Error', err);
          return;
        }
        // Add the nonce to the form and submit
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
      });
    });
  });
</script>

@endsection