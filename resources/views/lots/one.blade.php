<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $lot->name }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.success-message')
                    <div class="flex justify-end pb-3 pr-3 text-green-500 text-5xl">
                        ${{ $lot->start_price }}
                    </div>
                    <div class="mb-7">{{ $lot->description }}</div>
                    @include('layouts.lot-images')
                    @if($lot->user_id === Auth::id())
                        <div class="flex">
                            <a
                                href="{{ route('lots.edit', $lot->id) }}"
                                type="submit"
                                class="flex justify-center items-center h-10 w-28 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('lots.destroy', $lot->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="flex justify-center items-center h-10 w-28 px-5 mt-3 text-gray-100 transition-colors duration-200
                    bg-red-500 rounded-lg focus:shadow-outline hover:bg-red-600"
                                        type="submit">Delete
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('bid') }}" method="post" class="mt-5">
                            @csrf
                            <input class="w-14 rounded text-gray-400"
                                   type="text"
                                   name="bid">
                            <button name="lot" value="{{ $lot->id }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    type="submit">
                                Bid
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
