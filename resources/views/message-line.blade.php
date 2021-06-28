<style>
p {
    color: #333333;
}
h3 {
    font-size: 15px;
    font-weight: 500;
}
.base_sent p {
    background: #e674a8;
}
body{
    text-align: left;
}
</style>

@if($message->from_user == \Auth::user()->id)
 
    <div class="row msg_container base_sent" data-message-id="{{ $message->id }}">
        <div class="col-md-10 col-xs-10 col-10">
            <div class="messages msg_sent text-right">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 col-2 avatar px-0">
            @if (auth()->user()->image)
                <img src="{{ asset(auth()->user()->image) }}" style="width: 40px; height: 40px; border-radius: 50%;">
                @else
              <img src="{{ url('images/user-avatar.png') }}" width="40" height="40" class="img-responsive">
             @endif
            
        </div>
    </div>
 
@else
 
    <div class="row msg_container base_receive" data-message-id="{{ $message->id }}">
        <div class="col-md-2 col-xs-2 col-2 avatar px-0">
            @if($message->fromUser->image)
            <img src="{{ asset( $message->fromUser->image) }}" style="width: 40px; height: 40px; border-radius: 50%;">
             @else
             <img src="{{ url('images/user-avatar.png') }}" width="40" height="40" class="img-responsive"> 
             @endif
        </div>
        <div class="col-md-10 col-xs-10 col-10">
            <div class="messages msg_receive text-left">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>
 
@endif