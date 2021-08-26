<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lots') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.success-message')
                    <div class="mb-5 py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500">
                                        Seller
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500">
                                        Category
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500">
                                        Status
                                    </th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($lots as $lot)
                                    <tr>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $lot->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $lot->user->username }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $lot->category->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $lot->status }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <a
                                                href="#"
                                                class="flex justify-center items-center h-10 w-10 mr-2 text-gray-100 transition-colors duration-200
                bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    There is no users
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>{{ $lots->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
