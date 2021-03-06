@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')



@section('content')


<div class="container-fluid">
  <div class="container my-5 p-5 shadow">
    <h1 class="text-center mb-3 fw-bold ">Area Messaggi</h1>
    <h4 class="text-center mb-4 fst-italic">Controlla i tuoi messaggi</h4>


    <div class="accordion accordion-flush " id="accordionFlushExample">
      @foreach ($message as $mes)
      
      <div class="accordion-item shadow my-4">
        <h2 class="accordion-header" id="flush-headingOne">
          <button class="accordion-button collapsed d-flex flex-column align-items-start flex-md-row flex-wrap" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$mes->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$mes->id}}">
            
            <div class="mx-4 mb-1 pe-5 text-uppercase fw-bold fs-4 col-12">
             <p style="word-wrap: break-word;">{{$mes->object}}</p> 
            </div>

            <div class="mx-4 mb-3 text-capitalize fw-bold">
              {{$mes->name}}
            </div> 

            <div class="mx-4 mb-3 fw-bold">
              {{$mes->email}}
            </div>
          </button>
        </h2>
        <div id="flush-collapseOne{{$mes->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <p style="word-wrap: break-word;">{{$mes->content}}</p>
            <div class="text-center ">
                   
              <button type="button" class="btn btn-danger btn-sm text-white text mt-4" data-bs-toggle="modal"
                data-bs-target="#exampleModal{{$mes->id}}">
                Elimina Messaggio
              </button>
        
              <!-- Modal -->
              <div class="modal fade" id="exampleModal{{$mes->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$mes->id}}"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark" id="exampleModalLabel{{$mes->id}}">Vuoi Eliminare Il tuo Messaggio?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                      Selezionando Conferma Il tuo Messaggio Verr?? Elimnato.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Annulla</button>
                      <form action="{{ route('admin.message.destroy', $mes->id) }}" method="POST" >
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white">Conferma</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
          
      @endforeach
     
    </div>
</div>
@endsection