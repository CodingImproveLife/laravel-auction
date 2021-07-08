@auth
    <div class="mr-2">
        {!! Avatar::create(Auth::user()->name)->toSvg() !!}
    </div>
@endauth
