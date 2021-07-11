@if($success = Session::get('success'))
    <div class="mb-2 p-3 bg-green-200 text-green-600 rounded" role="alert">
        {{ $success }}
    </div>
@endif
