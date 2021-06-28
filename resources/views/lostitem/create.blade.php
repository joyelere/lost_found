@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header">{{ __('Lost&Found') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('lostitem.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="Title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="Title" type="text" class="form-control @error('Title') is-invalid @enderror" name="Title" value="{{ old('Title') }}">

                                @error('Title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="Phone_number" type="text" class="form-control @error('Phone_number') is-invalid @enderror" name="Phone_number" value="{{ old('Phone_number') }}">

                                @error('Phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                         <div class="col-md-6">
                            <input id="Address" type="text" class="form-control @error('Address') is-invalid @enderror" name="Address" value="{{old('Address')}}">
                            <input type="text" hidden id='lat'>
                              <input type="text" hidden id='lng'>
                                <div class="text-left">
                                  <button type="button" class="btn btn-primary btn-sm" onclick="getLocation()">Choose Location</button>
                                </div>
                                @error('Address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                               <select name="Category" id="Category" class="form-control @error('Category') is-invalid @enderror" >
                                {{ old('Category') }}
                                <option> {{ old('Category') }}</option>
                                   {{-- <option value="Category">Category</option> --}}
                                   <option value="PHONE">PHONE</option>
                                   <option value="LAPTOP">LAPTOP</option>
                                   <option value="KEY">KEY</option>
                                   <option value="ANIMAL">ANIMAL</option>
                                   <option value="ID-CARD">ID-CARD</option>
                                   <option value="ATM-CARD">ATM-CARD</option>
                                   <option value="OTHER">OTHER</option>
            
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="Date" type="date" class="form-control @error('Date') is-invalid @enderror" name="Date" value="{{ old('Date') }}" >

                                @error('Date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                            <textarea id="Description"  class="form-control @error('Description') is-invalid @enderror" name="Description">{{old('Description')}}</textarea>

                                @error('Description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file" aria-describedby="fileHelp">
                            {{-- <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small> --}}
                            @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        </div>
           <div class="field is-grouped">
            <div class="control">
          <button class="button is-link" type="submit">Submit</button>
            </div>
        </div>
    </form>
    @if(Session::has('msg'))
    {{Session::get('msg')}}
    @endif
    </div>
</div>
        </div>
    </div>
</div>
<script>
    var x = document.getElementById("lat");
    var y = document.getElementById("lng");
    var address = document.getElementById("Address");

    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
      x.value =  position.coords.latitude  
      y.value= position.coords.longitude;
      fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${parseFloat(x.value)},${parseFloat(y.value)}&key=AIzaSyCe-PA5yn9fQI9EQd3-moDQHMggeTurXIA`)
            .then(response => response.json())
            .then(data => address.value = data.results[0].formatted_address);
    //   initMap(x.value,y.value)
    }
    </script>

<script>
    // Initialize and add the map
    function initMap(x,y) {
      // The location of Uluru
      console.log(x,y)
      var uluru = {lat: parseFloat(x), lng: parseFloat(y)};
      // The map, centered at Uluruhidden
      var map = new google.maps.Map(
          document.getElementById('map'), {zoom: 4, center: uluru});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: uluru, map: map});
    }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe-PA5yn9fQI9EQd3-moDQHMggeTurXIA&callback=initMap">
        </script>
@endsection
