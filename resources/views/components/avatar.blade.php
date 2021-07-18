@auth
    <div class="mr-2">
        @isset(Auth::user()->photo)
            <img class="w-10 h-10 rounded-full object-cover"
                 src="{{ asset('/storage/' . Auth::user()->photo) }}">
        @else
            {!! Avatar::create(Auth::user()->name)->toSvg() !!}
        @endisset
    </div>
@endauth
