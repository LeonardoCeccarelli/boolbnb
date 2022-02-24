@extends('layouts.app')

@section('page_title', 'Visualizza | BoolBnB')



@section('content')


<div class="container-fluid">
  <div class="container border">
    <h1>sezione messaggi</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        @foreach ($message as $mes)
        <div class="accordion accordion-flush" id="accordionFlushExample{{$mes->id}}">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$mes->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$mes->id}}">
                    {{$mes->name}} | {{$mes->email}} | {{$mes->object}}
                </button>
              </h2>
              <div id="flush-collapseOne{{$mes->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    {{$mes->content}}
                </div>
              </div>
            </div>
           
        </div>
          
        @endforeach
        
        
       
      </div>
  </div>
</div>
@endsection