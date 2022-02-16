@extends('layouts.app')

@section('other_meta')
<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
@endsection

@section('content')
<h1 class="text-center">sezione sponsor</h1>

<h3>seleziona l'appartamento da sponsorizzare</h3>

<div class="container">
  <div class="row row-cols-3">
    @foreach ($sponsor as $single_sponsor)
    <div class="col d-flex justify-content-center text-center">

      {{-- Single Sponsor Card --}}
      <div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Tipo: {{ $single_sponsor->type }}</h5>
          <p class="card-text">Prezzo: {{ $single_sponsor->price }}</p>
          <p class="card-text">Durata: {{ $single_sponsor->duration }}</p>

          <a href="#" class="btn btn-primary">Buy</a>
        </div>
      </div>

    </div>
    @endforeach
  </div>

  {{-- Payment --}}
  <form method="post" id="payment-form" autocomplete="off" action="{{ route('admin.sponsor.checkout', $apartment) }}">
    @csrf
    @method('POST')

    {{-- CREDIT CARD --}}
    <div id="dropin-card"></div>

    {{-- Submit Button --}}
    <input type="submit" />
    <input type="hidden" id="nonce" name="payment_method_nonce" />

  </form>

  {{-- End Payment --}}

</div>

<script>
  const form = document.querySelector('#payment-form');
  var client_token = '{{ $clientToken }}';

  braintree.dropin.create({
  authorization: client_token,
  container: '#dropin-card',
  // ...plus remaining configuration
}, (error, dropinInstance) => {
  // Use `dropinInstance` here
  // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
  if (error){
    console.log(error);
    return
  }   
  form.addEventListener('submit', event => {
    event.preventDefault();

    dropinInstance.requestPaymentMethod((error, payload) => {
      if (error){
        console.log(error);
        return
      } 

      // payment method nonce added to form submit
      document.getElementById('nonce').value = payload.nonce;
      form.submit();
    });
  });
});
</script>

@endsection