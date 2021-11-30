@if( session()->has('success') )
    <div class="alert alert-success alert-dismissible">
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif( $errors->any() )
    {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible">
                                    :message
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></div>'))
    !!}
@endif
