@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="mb-2 p-3 bg-red-200 text-red-600 rounded" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif
