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
                                            <svg class="h-24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="#ccc">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="p-2">
                                                <a class="hover:border-yellow-500 border-b"
                                                   href="{{route('lots.show', $lot->id)}}">
                                                    <strong>{{Str::limit($lot->name, 20)}}</strong>
                                                </a>
                                            </div>
                                            <div class="p-2">{{Str::limit($lot->description, 40)}}</div>
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
