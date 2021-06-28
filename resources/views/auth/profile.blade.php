@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                                            <div class="col-md-6">
                                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                                @if (auth()->user()->image)
                                                    <code>{{ auth()->user()->image }}</code>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            
            <div class="col-md-6 col-sm-6 col-12"  style="border-right:1px solid">
     <h1 class="text-center"  style="border-bottom:1px solid">LOST_ ITEM</h1>
                @foreach ($lostitem as $list)
                <div class="card my-4">
                    <div class="row no-gutters">
                        <div class="col-auto">
                             @if($list->image) 
                            <img src="{{asset('lostimages/'.$list->image) }}" class="img-fluid"  style="height:150px;width:200px" alt="..." >
                            @else
                        <img src="{{asset('lostimages/default.png')}}" class="img-fluid" style="height:150px;width:200px" alt="...">
                            @endif 
                            {{-- <img src="//placehold.it/200" class="img-fluid" alt=""> --}}
                        </div>
                        <div class="col">
                            <div class="card-block px-5 ">
                            <h4 class="card-title">{{$list->Title}}</h4>
                                <p class="card-text">{{$list->Description}}</p>
                                <form action="{{action('profileController@destory',$list['id'])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> DELETE</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer w-100 text-muted">
                        
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-6 col-sm-6 col-12" >
                <h1 class="text-center" style="border-bottom:1px solid">FOUND ITEM</h1>
                @foreach ($founditem as $lists)
                <div class="card my-4">
                    <div class="row no-gutters">
                        <div class="col-auto">
                             @if($lists->image) 
                            <img src="{{asset('foundimages/'.$lists->image) }}" class="img-fluid"  style="height:150px;width:200px" alt="..." >
                            @else
                        <img src="{{asset('foundimages/default.png')}}" class="img-fluid" style="height:150px;width:200px" alt="...">
                            @endif 
                            {{-- <img src="//placehold.it/200" class="img-fluid" alt=""> --}}
                        </div>
                        <div class="col">
                            <div class="card-block px-5">
                            <h4 class="card-title">{{$lists->Title}}</h4>
                                <p class="card-text">{{$lists->Description}}</p>
                            <form action="{{action('profileController@destory2',$lists['id'])}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> DELETE</button>
                                </form>
                                {{-- <a href="#" class="btn btn-primary">BUTTON</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer w-100 text-muted">
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection