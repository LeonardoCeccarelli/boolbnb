@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')



@section('content')


<div class="container-fluid">
  <div class="container my-5 p-5 shadow">
    <h1 class="text-center mb-3">Area Messaggi</h1>
    <h4 class="text-center mb-4">Controlla i tuoi messaggi</h4>
    <div class="accordion rounded" id="accordionPanelsStayOpenExample">
        @foreach ($message as $mes)
        <div class=" accordion accordion-flush  mb-4 " id="accordionFlushExample{{$mes->id}}">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed sms-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$mes->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$mes->id}}">
                    {{$mes->name}} | {{$mes->email}} | {{$mes->object}}
                </button>
              </h2>
              <div id="flush-collapseOne{{$mes->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    {{$mes->content}}

                    <div class="text-center">
          
                      
                      <button type="button" class="btn btn-danger btn-sm text-white text mb-4" data-bs-toggle="modal"
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
                              Selezionando Conferma Il tuo Messaggio Verrà Elimnato.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Annulla</button>
                              <form action="{{ route('admin.message.destroy', $mes->id) }}" method="POST" {{--
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
                </div>

                
               
              </div>
            </div>
           
        </div>
          
        @endforeach
        
        
       
      </div>
  </div>
</div>
@endsection