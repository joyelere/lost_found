@extends('layouts.app')
 
@section('content')
                    <style>
                        /*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
  background-color: #74EBD5;
  background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);
  line-height: 1.5;

  min-height: 100vh;
}
.content {
    text-align: left;
}



::-webkit-scrollbar {
  width: 5px;
}

::-webkit-scrollbar-track {
  width: 5px;
  background: #f5f5f5;
}

::-webkit-scrollbar-thumb {
  width: 1em;
  background-color: #ddd;
  outline: 1px solid slategrey;
  border-radius: 1rem;
}

.text-small {
  font-size: 0.9rem;
}

.messages-box,
.chat-box {
  height: 510px;
  overflow-y: scroll;
}

.rounded-lg {
  border-radius: 0.5rem;
}

input::placeholder {
  font-size: 0.9rem;
  color: #999;
}

.list-group-item-light.list-group-item-action:focus, .list-group-item-light.list-group-item-action:hover{
    z-index: 0;
}
  </style>
               <div class="container py-5 px-4">
                      
                 <div class="row rounded-lg overflow-hidden shadow">
                          <!-- Users box-->
                          <div class="col-12 px-0">
                            <div class="bg-white">
                      
                              <div class="bg-gray px-4 py-2 bg-light">
                                <p class="h5 mb-0 py-1">Recent</p>
                              </div>
                      
                              <div class="messages-box">
                                <div class="list-group rounded-0">
                                    @if($messages->count() > 0)
                    @php
                        $alreadySeenIds = array();
                    @endphp        
                    @foreach($messages as $message)
                        @if (!in_array($message->from_user, $alreadySeenIds) && !in_array($message->to_user, $alreadySeenIds))
                            @if ($message->from_user == Auth::user()->id)
                            {{-- {{dd($message->toUser->profile_image)}} --}}
                                {{-- <li><a class="btn btn-primary btn-block btn-lg chat-toggle" role="button" href="javascript:void(0);" class="chat-toggle" data-id="{{ $message->to_user }}" data-user="{{ $message->toUser->name }}" >{{ $message->toUser->name }}</a></li> --}}
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat-toggle" data-id="{{ $message->to_user }}" data-user="{{ $message->toUser->name }}">
                                    @if($message->toUser->profile_image)
                                    <div class="media"><img src="{{ asset($message->toUser->profile_image)}}"  style="width: 40px; height: 40px; border-radius: 50%;">
                                        @else
                                        <div class="media"><img src="{{ url('images/user-avatar.png') }}" width="50" class="rounded-circle">
                                       @endif
                                      <div class="media-body ml-4">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                          <h6 class="mb-0">{{ $message->toUser->name }}</h6><small class="small font-weight-bold">{{ $message->created_at->diffForHumans()}}</small>
                                        </div>
                                    <p class="font-italic text-muted mb-0 text-small">{{$message->content}}</p>
                                      </div>
                                    </div>
                                  </a>  
                                @php
                                    $alreadySeenIds[] = $message->to_user;
                                @endphp
                            @else 
                                @if ( $message->to_user == Auth::user()->id)
                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat-toggle" data-id="{{ $message->from_user }}" data-user="{{ $message->fromUser->name }}">
                                            @if($message->fromUser->profile_image)
                                            <div class="media"><img src="{{asset($message->fromUser->profile_image)}}" style="width: 40px; height: 40px; border-radius: 50%;">
                                                @else
                                                <div class="media"><img src="{{ url('images/user-avatar.png') }}" width="50" class="rounded-circle">
                                               @endif
                                          <div class="media-body ml-4">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                              <h6 class="mb-0">{{ $message->fromUser->name }}</h6><small class="small font-weight-bold">{{ $message->created_at->diffForHumans()}}
                                            </small>
                                            </div>
                                            <p class="font-italic text-muted mb-0 text-small">{{$message->content}}</p>
                                          </div>
                                        </div>
                                      </a>  
                                    @php
                                        $alreadySeenIds[] = $message->from_user;
                                    @endphp
                                @endif
                            @endif
                        @endif
                           
                    @endforeach
                @endif                                
                                </div>
                              </div>
                            </div>
                          </div>                      
                          </div>
                        </div>
                      </div>

    
 
  @include('chat-box')

  <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
  <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
  <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
@stop

@section('script')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    {{-- <script src="{{ asset('js/chat_backup.js') }}"></script> --}}


 
@stop

