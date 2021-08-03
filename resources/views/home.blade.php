<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home page') }}
        </h2>
    </x-slot>

    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        @include('layouts.errors-message')
                        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4">
                            @if($lots->isNotEmpty())
                                @foreach($lots as $lot)
                                    <div class="flex flex-col m-5 p-3 items-center rounded-md shadow-md">
                                        <div class="flex">
                                            <div class="w-28 px-1">
                                                @if($lot->images->isNotEmpty())
                                                    <img class="max-h-24 max-w-24 p-1"
                                                         src="{{ asset('/storage/' . $lot->images[0]->path) }}">
                                                @else
                                                    <x-default-lot-image/>
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="p-2">
                                                    <a class="hover:border-yellow-500 border-b"
                                                       href="{{route('lots.show', $lot->id)}}">
                                                        <strong>{{ Str::limit($lot->name, 20) }}</strong>
                                                    </a>
                                                </div>
                                                <div class="p-2">{{ Str::limit($lot->description, 40) }}</div>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <bid-countdown-timer :sale-timestamp="{{ $lot->sale_timestamp }}"></bid-countdown-timer>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <div>{{$lots->links()}}</div>
                        @else
                            <div>No lots found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
