<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Lots
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($lots->isNotEmpty())
                        <div class="container mx-auto">
                            @include('layouts.success-message')
                            <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4">
                                @foreach($lots as $lot)
                                    <div class="md:flex m-5 p-3 items-center rounded-md shadow-md">
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
                                @endforeach
                            </div>
                            <div>{{$lots->links()}}</div>
                        </div>
                    @else
                        <p>You have not uploaded any lot.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
