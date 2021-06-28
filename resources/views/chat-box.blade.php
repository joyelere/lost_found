
<style>
   .row {
    margin-right: -19px;
    margin-left: 0px;
}
.col-md-12{
    padding-right: 14px;
    padding-left: 0px;


</style>
<div id="chat_box" class="chat_box pull-right" style="display: none">
    <div class="row">
        <div class="col-xs-12 col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h3 class="card-ttle"><span class="fa fa-comment fa-sm"></span> Chat with <i class="chat-user"></i> </h3>
                            </div>
                            <div class="col-2">
                                <span class="fa fa-remove text-center close-chat"></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body chat-area">
 
                    </div>
                    <div class="card-footer">
                        <div class="input-group form-controls">
                            <textarea class="form-control input-sm chat_input" id="myInput" placeholder="Write your message here..."></textarea>
                        </div>

                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm btn-chat" id="myBtn" type="button" style="float: right" data-to-user="" disabled>
                                <i class="fa fa-send"></i>
                                Send</button>
                        </span>
                    </div>
                </div>
        </div>
    </div>
    <input type="hidden" id="to_user_id" value="" />
</div>

<script>
   var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("myBtn").click();
    }
});
</script>