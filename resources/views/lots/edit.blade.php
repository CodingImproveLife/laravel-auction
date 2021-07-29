<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit lot: {{$lot->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.errors-message')
                    <form class="flex flex-wrap flex-col mb-5" method="post" enctype="multipart/form-data"
                          action="{{route('lots.update', $lot->id)}}">
                        @csrf
                        @method('PATCH')
                        <label class="block mb-1" for="lot-title">Lot name</label>
                        <input
                            id="lot-title"
                            name="title"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                            type="text"
                            value="{{ $lot->name }}"/>
                        <label class="block mb-1" for="lot-description">Lot description</label>
                        <textarea
                            id="lot-description"
                            name="description"
                            class="form-textarea my-2 block w-full rounded-lg text-gray-700"
                            rows="3">{{ $lot->description }}</textarea>
                        <label for="category" class="mt-2">Select category</label>
                        <select id="category" name="category"
                                class="w-full h-10 mb-2 mt-1 pl-3 pr-5 placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Regular input">--}}
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    @if($category->id === $lot->category->id)
                                        selected
                                    @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <label class="block mb-1" for="lot-price">Start price</label>
                        <input
                            id="lot-price"
                            name="price"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 placeholder-gray-400 border rounded-lg focus:shadow-outline"
                            type="number"
                            min="0"
                            value="{{ $lot->start_price }}"/>
                        <label class="block mb-1" for="lot-image">Lot image</label>
                        <input
                            id="lot-image"
                            name="image[]"
                            class="w-full h-10 my-2 text-base text-gray-700 focus:shadow-outline"
                            type="file"
                            multiple
                        />
                        <div class="w-full">
                            <input
                                id="sale-lot"
                                name="for_sale"
                                class="form-checkbox h-5 w-5 text-gray-600 focus:ring-transparent"
                                type="checkbox"
                                @if($lot->status === 'On sale')
                                    checked
                                @endif
                            />
                            <label for="sale-lot" class="inline-flex items-center">Put up for sale</label>
                        </div>
                        <button
                            type="submit"
                            class="h-10 w-24 px-5 mt-3 text-gray-100 transition-colors duration-200
                bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">
                            Update
                        </button>
                    </form>
                    @include('layouts.lot-images', ['deleteButton' => true])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
