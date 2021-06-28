@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}" />
    <style>
        #map {
         height: 400px;  /* The height is 400 pixels */
         width: 100%;  /* The width is the width of the web page */
        }
     </style>
</head>
<div class="container">
  <div class="card mt-2 mb-4">
    @if($lostitem->image) 
    <img src="{{asset('lostimages/'.$lostitem->image) }}" class="card-img-top" style="height:550px" alt="..." >
    @else
    <img src="{{asset('lostimages/default.png')}}" class="card-img-top" alt="...">
    @endif
      <div class="card-body">
         <div class="card">
             <div class="card-body">
             <h4 class="card-title">{{$lostitem->Title}} ({{$lostitem->Category}})</h4>
             <p class="card-text">{{$lostitem->Address}}</p>
             <p class="card-text">Posted by: <span class="color">{{$lostitem->author->name}}</span></p>
             </div>
         </div>

         <div class="card my-2">
            <div class="card-body">
            <h4 class="card-title">Detail:</h4>
            <p class="card-text">{{$lostitem->Description}}</p>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>

        <div class="row">
            @if($users->count() > 0)            
                @foreach($users as $user)
                    @if ($user->id != Auth::user()->id)
        <div class="col"><a class="btn btn-primary btn-block btn-lg" href="tel:{{$lostitem->Phone_number}}" role="button"><i class="fas fa-phone"></i>     CALL</a></div>
        <div class="col"><a class="btn btn-primary btn-block btn-lg" href="sms://{{$lostitem->Phone_number}}?body=I%27m%20interested%20in%20your%20product.%20Please%20contact%20me." role="button"><i class="fas fa-sms"></i>     SMS</a></div>
                        <div class="col"><a class="btn btn-primary btn-block btn-lg chat-toggle" role="button" href="javascript:void(0);" class="chat-toggle" data-id="{{ $lostitem->user_id }}" data-user="{{ $user->name }}"><i class="fas fa-envelope"></i>  CHAT</a></div>
                    @endif
                @endforeach
            @endif
        </div>
      </div>
  </div>
</div>
<!-- /.container -->


@include('chat-box')

<input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
<input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
<input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
<input type="text" hidden id="lat">
<input type="text" hidden id="lng">
@stop

@section('script')
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('js/chat.js') }}"></script>

<script>
    var map;
    // Initialize and add the map
function initMap() {
// The location of Uluru
var uluru = {lat:  parseFloat(document.getElementById('lat').value), lng:  parseFloat(document.getElementById('lng').value)};
// The map, centered at Uluru
var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 30, center: uluru});
// The marker, positioned at Uluru
var marker = new google.maps.Marker({position: uluru, map: map});
}
  //   function initMap() {
  //     map = new google.maps.Map(document.getElementById('map'), {
  //       center: {lat: parseFloat(document.getElementById('lat').value), lng: parseFloat(document.getElementById('lng').value)},
  //       zoom: 8
  //     });
  //   }
  </script>
 
  <script>
      
    fetch(encodeURI(`https://maps.googleapis.com/maps/api/geocode/json?address=`+'{{$lostitem->Address}}'+`&key=AIzaSyCe-PA5yn9fQI9EQd3-moDQHMggeTurXIA`))
          .then(response => response.json())
          .then(data => {
              console.log(data.results[0].geometry.location.lat,data.results[0].geometry.location.lng)
              document.getElementById('lat').value = data.results[0].geometry.location.lat;
              document.getElementById('lng').value = data.results[0].geometry.location.lng;

              return initMap()});
          // .then(data => address.value = data.results[0].formatted_address);
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe-PA5yn9fQI9EQd3-moDQHMggeTurXIA&callback=initMap"
  async defer></script>

@stop
