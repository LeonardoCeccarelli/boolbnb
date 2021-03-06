@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')

@section('cdn')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
@endsection

@section('content')

@if ($apartment->user_id == $user->id)

<div class="container-fluid">
  <div class="container d-flex flex-column align-items-center position-relative">

    {{-- titolo / info base --}}
    <section class="bg-light col-11 mt-5 p-5 pb-0  rounded-top">
      <div class="row  row-cols-md-2 flex-column flex-md-row">

        <div class="div col-12 col-md-7 ">

          <h3 class="fw-bold pb-3 text-uppercase" style="color: #094679; word-wrap: break-word;">{{ $apartment->title }}
          </h3>
          <div class=" mt-4 ">
            <h4 class="fw-bold">Informazioni Generali</h4>
            <ul class=" d-flex flex-wrap">
              <li class="mx-2 me-4">{{ $apartment->square_metres }} m²</li>
              <li class="mx-2 me-4">Letti: {{ $apartment->beds}}</li>
              <li class="mx-2 me-4">Stanze: {{ $apartment->rooms}}</li>
              <li class="mx-2 me-4">Bagni: {{ $apartment->bathrooms }}</li>
            </ul>
          </div>
        </div>

        <div class="col-12  col-md-5   p-2  ps-lg-5 pt-md-5">
          <div class=" d-flex flex-row flex-md-column ms-lg-5">
            <p class="text-capitalize me-5 me-md-0"><i class="fas fa-map-marker-alt fs-5"></i> <span
                class="fs-5 fw-bold">Posizione: </span> {{ $apartment->city }}</p>
            <p><i class="fas fa-tag fs-5"></i><span class="fs-5 fw-bold"> Prezzo a notte: </span> {{
              $apartment->night_price}} Euro </p>
          </div>
        </div>
      </div>

      <hr>
    </section>


    <section class="infos d-flex justify-content-center col-11  my-4">
      <div class="left col-9  bg-light p-5 pt-3  shadow rounded ">

        {{-- immagini / carosello --}}
      
        <div class="rounded py-4"  style="position: relative;">
          
          <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded border" alt="...">
          @foreach($apartment->sponsor as $sp)
            <button type="button" class="btn btn-warning mb-2 text-uppercase fw-bold" style="position: absolute;top:40px;left:20px;">
              {{$sp->type}}                   
            </button>                                            
          @endforeach
        </div>
        


        <hr>
        {{-- descrizione appartamento --}}
        <h4 class="fw-bold mt-4 mb-4 ">Descrizione</h4>
        <div class="mb-4 ">
          <p style="word-wrap: break-word;">{{ $apartment->description }}</p>

        </div>
        <hr>
        {{-- Servizi --}}
        <h4 class="fw-bold mt-4 mb-4">Servizi</h4>
        <ul class="d-flex  flex-wrap p-0 list-unstyled ">
          @foreach($apartment->services as $service)
          <li class="me-3"><span class="me-1">{!! $service->icon !!}</span>
            {{$service->name}}</li>
          @endforeach
        </ul>

      </div>   
    </section>

    {{-- statistiche --}}
    <section class="bg-light col-11 mb-5 p-5 pt-0 rounded-bottom">
      <hr>
      <h4 class="fw-bold mt-4">Statistiche Del Tuo Annuncio</h4>

      {{-- container to inject the chart js --}}
      <canvas id="myChart"></canvas>

    </section>

    {{-- delete button --}}
    <div class="text-center">
          
      <p class="fw-bold mb-1  me-4"><i class="fas fa-trash fs-3 me-3 mb-3"></i> Vuoi Eliminare il tuo annuncio ?</p>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger btn-sm text-white text mb-4" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Elimina Annuncio
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Vuoi Eliminare Il tuo Annuncio?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
              Selezionando Conferma Il tuo Annuncio Verrà Elimnato.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Annulla</button>
              <form action="{{ route('admin.apartment.destroy', $apartment->id) }}" method="post" {{--
                onsubmit="return confirm('Vuoi Eliminare Il tuo Annuncio ?')" --}}>
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger text-white">Conferma</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    


    <div class="position-fixed icone" style="">
      <ul class="list-unstyled text-center ">
        <li class="mb-4" style="border: 1px solid #ff5a5f; padding: 5px; border-radius: 5px;">
          <a href="{{ route('admin.message.index', $apartment->id) }}"
            class="fw-bold mb-1 text-decoration-none sms text-dark">
            <i class="fas fa-envelope fs-2 mb-2 sms-icon" style="color: #ff5a5f;"></i>
            <p style="color: #001533; margin-bottom: 0;">Messaggi </p>
          </a>
        </li>
        <li  class="mb-4" style="border: 1px solid #ff5a5f; padding: 5px; border-radius: 5px;">
          <a href="{{ route('admin.sponsor.index', $apartment) }}"
                class="fw-bold mb-1  text-decoration-none text-dark ">
                <i class="fas fa-crown fs-2 mb-2" style="color: #ff5a5f;"></i>
                <p style="color: #001533; margin-bottom: 0;">Sponsor</p>                
          </a>
        </li>
        <li  class="mb-4" style="border: 1px solid #ff5a5f; padding: 5px; border-radius: 5px;">
          <a href="{{ route('admin.apartment.edit', $apartment->id) }}"
            class="fw-bold mb-1 text-decoration-none text-dark ">
            <i class="fas fa-pen fs-2 mb-2" style="color: #ff5a5f;"></i>
            <p style="color: #001533; margin-bottom: 0;">Modifica</p>
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</div>


@else

<div class="container">
  <div class="row justify-content-center my-5">
    <div class="col-6">
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8 d-flex align-items-center">
            <div class="card-body text-center">
              <h5 class="card-title mb-2">L'appartamento selezionato non è visualizzabile.</h5>
              <a href="{{ route('admin.home') }}" class="btn btn-primary text-light">I miei appartamenti</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

{{-- Script to style the chart --}}
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [],
          datasets: [{
              label: '# of Visualisations',
              data: [],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              pointStyle: 'circle',
              pointRadius: 5,
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 1
                  }
              }
          }
      }
  });

  var updateChart = function(){
    $.ajax({
      url: "{{ route('api.chart', $apartment->id) }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        myChart.data.labels = data.daysList;
        myChart.data.datasets[0].data = data.dailyViewsCount;
        myChart.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }

  updateChart();

</script>

@endsection