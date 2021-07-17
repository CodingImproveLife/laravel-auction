<div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4">
    @forelse($lot->images as $image)
        <div>
            @if($deleteButton ?? '')
                <div class="hover:block">
                    <form method="post" action="{{ route('lot-images.destroy', $image->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="relative">
                            <button type="submit" class="absolute right-2 text-red-500 text-3xl" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
            <a href="{{ asset('/storage/' . $image->path) }}">
                <img
                    src="{{ asset('/storage/' . $image->path) }}"
                    alt="lot image">
            </a>
        </div>
    @empty
        <svg xmlns="http://www.w3.org/2000/svg" class="max-h-24 max-w-24 m-2" fill="none" viewBox="0 0 24 24"
             stroke="#ccc">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    @endforelse
</div>
