<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        @include('layouts.errors-message')
                        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4">
                            @if($lots->isNotEmpty())
                                @foreach($lots as $lot)
                                    <div class="flex flex-col justify-between m-5 p-3 rounded-md shadow-md">
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
                                                        <strong>{{ $lot->short_name }}</strong>
                                                    </a>
                                                </div>
                                                <div class="p-2">{{ $lot->short_description }}</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col ml-2 mt-2">
                                            <div class="flex">
                                                <svg class="w-4 mr-1"
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                                {{ $lot->user->name }}
                                            </div>
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 mr-1" viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                                {{ $lot->category->name }}
                                            </div>
                                            <div class="flex">
                                                <bid-countdown-timer :sale-timestamp="{{ $lot->sale_timestamp }}"></bid-countdown-timer>
                                            </div>
                                            <div class="flex flex-row">
                                                <svg class="w-4 mr-1"
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path
                                                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"/>
                                                </svg>
                                                <unique-bids :lot="{{ $lot->id }}" :bid="{{ $lot->start_price }}" :unique="{{ $lot->number_of_unique_bids }}"></unique-bids>
                                            </div>
                                            <div class="flex">
                                                <svg class="w-4 mr-1"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                <new-bid :lot="{{ $lot->id }}" :bid="{{ $lot->start_price }}"></new-bid>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <div>{{ $lots->links() }}</div>
                        @else
                            <div>No lots found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
