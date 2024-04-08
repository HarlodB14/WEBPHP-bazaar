<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Current Bids') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-71 mx-auto sm:px-6 lg:px-8 flex justify-end mb-4 w-1/4">
            <form action="{{ route('bid.show') }}" method="GET" class="flex w-full">
                @csrf
                <x-text-input
                    class="flex-grow border-gray-800 rounded-l-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Search for a bid..." name="query"/>
                <button type="submit"
                        class="inline-flex items-center rounded-r-md bg-blue-400 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ml-2">
                    {{ __('Search') }}
                </button>
            </form>
        </div>
        @if(session()->has('message'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4"
                role="alert">
                <span class="block sm:inline">{{ session()->get('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('#') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Title') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Category') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Owner') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Price') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('My bid') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Action') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-200">
                        @foreach($bidDetails as $bidDetail)
                            <tr class="text-white">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bidDetail['advertisement_title'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bidDetail['advertisement_category'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bidDetail['advertisement_owner'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">€{{ $bidDetail['advertisement_price'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">€{{ $bidDetail['bid_amount'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('bid.delete', ['bid' => $bidDetail['bid_id']]) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            {{ __('Withdraw') }}
                                        </button>
                                    </form>

                                    <a href="{{ route('advertisements.show', ['advertisement' => $bidDetail['advertisement_id']]) }}"
                                       class="inline-flex items-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ml-2">
                                        {{ __('Details') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
