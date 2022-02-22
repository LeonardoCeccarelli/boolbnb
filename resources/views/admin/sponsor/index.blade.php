@extends('layouts.app')
@section('page_title', 'Sponsor | BoolBnB')
@section('other_meta')
<script src='https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js'></script>
@endsection
@section('content')

<div class="container-fluid p-5"
  style="background: rgb(2,0,36);background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(9,70,121,1) 35%, rgba(161,232,246,1) 100%);">
  <div class="container my-5 p-5 bg-light rounded">

    @if ($end_date < $now)

    <div class="  row text-center my-4">
      <h1 class='mb-4 fw-bold' style="word-wrap: break-word;">SPONSORIZZA IL TUO ANNUNCIO </h1>
      <p style="word-wrap: break-word;" class="fs-3 fw-bold">{{ $apartment->title }}</p>
    </div>

    <div class=' row row-cols-1 row-col-lg-3 justify-content-around text-center py-4 '>

      @foreach ($sponsor as $single_sponsor)
    
      {{-- Single Sponsor Card --}}
      <div class='card shadow rounded mb-5' style='width:300px;  background-image: linear-gradient( 112.1deg,  rgba(32,38,57,1) 11.4%, rgba(63,76,119,1) 70.2% );'>
        
        <div class='card-body text-white my-3'>
          
          <h3 class='card-title text-uppercase fw-bold mb-4'>{{ $single_sponsor->type }}</h3>
          <p class='card-text fs-1'>{{ $single_sponsor->price }} &#8364;</p>
          <p class='card-text fs-3' > {{ $single_sponsor->duration }}/<span class="fs-5">hr</span></p>
          <hr>
          <ul class="list-unstyled">
            <li class="mb-2">Annuncio in homepage</li>
            <li class="mb-2">Annuncio posizionato in testa alle ricerche</li>
            <li class="mb-2">Annuncio consigliato per città</li>
          </ul>
        </div>
      </div>
      
      @endforeach
      
    </div>

    <div class='row row-cols-2 justify-content-center my-3'>
      <div class='col'>

        {{-- Payment Form --}}
        <form class="" id='payment-form' autocomplete='off' action='{{ route('admin.sponsor.checkout', $apartment) }}'
          method='POST'>
          @csrf
          @method('POST')
      
          {{-- Select Sponsorship --}}
          <section class="col-12 d-flex flex-column align-items-center mb-5">
            <h2 class="fw-bold mb-4">Seleziona Un Piano</h2>
            <select class='form-select form-select-lg' id='sponsor_select' name='sponsor_select' >
              

              <option selected disabled='disabled'>Seleziona sponsorizzazione</option>
              @foreach ($sponsor as $item)
              <option value='{{ $item->id }}'>{{ $item->type }}</option>
              @endforeach

            </select>
          </section>
          <hr>

          {{-- payment --}}
          <section class="col-12">

            {{-- CREDIT CARD --}}
            <div id='dropin-container'></div>

            {{-- Submit Payment Button --}}
            <div class='submit-btn-continer text-center'>
              <input class='btn btn-dark w-100' type='submit' />
              <input id='nonce' name='payment_method_nonce' type='hidden' />
            </div>
          </section>
          
        </form>
        {{-- End Payment Form --}}
      </div>
    </div>


    @else
    <div class="col-12 text-center">
      <h1 class="text-center fw-bold text-uppercase">sei già sponsorizzato</h1>
      <a href="{{ route('admin.home') }}">Torna Nella Tua Dashboard</a>

    </div>

    @endif

    <script>
      const form = document.querySelector('#payment-form');
            var client_token = '{{ $clientToken }}';
            braintree.dropin.create({
                authorization: client_token,
                container: '#dropin-container',
                // ...plus remaining configuration
            }, function(createErr, instance) {
                // Use `dropinInstance` here
                // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }
                        // Add the nonce to the form and submit
                        document.getElementById('nonce').value = payload.nonce;
                        console.log('console log', nonce);
                        form.submit();
                    });
                });
            });
    </script>
  </div>
</div> 

@endsection