<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.success-message')
                    <h3 class="mb-4 font-semibold text-lg text-gray-800 leading-tight">You balance:</h3>
                    <div class="text-green-500 text-5xl my-2">${{ Auth::user()->balance }}</div>
                    <h3 class="mb-4 font-semibold text-lg text-gray-800 leading-tight">You purchases:</h3>
                    <user-purchases></user-purchases>
                    <a
                        href="{{ route('profile.edit', Auth::id()) }}"
                        class="flex justify-center items-center h-10 w-32 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">
                        Edit profile
                    </a>
                    <a
                        href="{{ route('profile.addMoney') }}"
                        class="flex justify-center items-center h-10 w-40 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600">
                        Top up balance
                    </a>
                    @can('edit users')
                        <div class="flex">
                            <a
                                href="{{ route('admin.users.index') }}"
                                class="flex justify-center items-center h-10 w-40 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                        bg-gray-500 rounded-lg focus:shadow-outline hover:bg-gray-600">
                                Show all users
                            </a>
                            <a
                                href="{{ route('admin.lots.index') }}"
                                class="flex justify-center items-center h-10 w-40 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                        bg-gray-500 rounded-lg focus:shadow-outline hover:bg-gray-600">
                                Show all lots
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
