@if(Session::has('error'))
    <div class="row mr-2 ml-2 alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2"
                        role="alert">
                          <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                          <button id="type-error" type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <strong>{{Session::get('error')}}</strong>
                        </div>
@endif
