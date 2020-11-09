@if(Session::has('success'))
    <div class="row mr-2 ml-2 alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2"
                        role="alert">
                          <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                          <button id="type-success" type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <strong>{{Session::get('success')}}</strong>
                        </div>
@endif
