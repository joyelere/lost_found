@extends('layouts.app')

@section('content')
 <div class="container">
  <div class="input-group mt-2">
    <input type="text" class="form-control" id="myInput" placeholder="Search">
    <div class="input-group-append">
      <button class="btn btn-success" type="submit">Go</button>  
     </div>
  </div>
    {{-- <input class="form-control" id="myInput" type="text" placeholder="Search.."> --}}
  
        <div style="text-align:center">
            <h2>HAVE FOUND SOMETHING ?</h2>
          </div>
  
    {{-- <!-- Actual search box -->
    <div class="form-group has-search">classclass
        <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control" placeholder="Search">
    </div> --}}
    
      <div class="row">
      {{-- <div class="column"> --}}
            @foreach ($founditems as $list)
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="card" style="width: 18rem;">
                     @if($list->image) 
                    <img src="{{asset('foundimages/'.$list->image) }}" class="card-img-top" style="height:150px" alt="..." >
                    @else
                <img src="{{asset('foundimages/default.png')}}" class="card-img-top" alt="..." style="height:150px">
                    @endif
                    <div class="card-body">
                    <div id="title">
                      <h5 class="card-title">{{$list->Title}}</h5>
                      <p class="">{{ date('m/d/Y', strtotime($list->Date)) }}</p>
                      {{-- {{$list->data->format('d/m/Y')}} --}}
                    <p class="card-text">{{$list->Category}}</p>
                    </div>
                  <a href= "{{route('founditem.show',$list->id)}}" class="btn btn-primary">Details</a>
                    </div>
                  </div>
            </div>
            
            @endforeach
    
</div>
{{$founditems->links()}}
{{-- {{ $users->onEachSide(5)->links() }} --}}

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#title *").filter(function() {
        $(this).parent().parent().parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>
@endsection