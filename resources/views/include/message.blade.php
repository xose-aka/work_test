@if( session()->has('success') )
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@elseif( $errors->any() )
    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
@endif
