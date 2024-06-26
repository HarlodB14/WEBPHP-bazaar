<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rentals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-71 mx-auto sm:px-6 lg:px-8 flex justify-end mb-4 ml-8 w-1/4">
            <form action="{{ route('rentals.index') }}" method="GET" class="flex w-full">
                <x-text-input
                    class="flex-grow border-gray-800 rounded-l-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Search rentals..." name="query"/>
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
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                          clip-rule="evenodd"/>
                </svg>
            </span>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4">
                <span class="block sm:inline">{{ session()->get('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M9.293 10l-1.147 1.146a1o 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                      clip-rule="evenodd"/>
            </svg>
        </span>
            </div>
        @endif
        <div class="max-w-71 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @role(['Private advertiser','Commercial advertiser'])
                    <a href="{{ route('rentals.create') }}"
                       class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mb-2 mt-2">
                        {{ __('Create a new rental item') }}
                    </a>
                    <a href="{{ route('rentals.agenda') }}"
                       class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mb-2 mt-2">
                        {{ __('Show agenda') }}
                    </a>
                    @endrole
                    @role('Viewer')
                    <a href="{{ route('rentals.agenda') }}"
                       class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mb-2 mt-2">
                        {{ __('Show my current agenda') }}
                    </a>
                    @endrole
                    <table class="table-auto min-w-full divide-y divide-gray-200">
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
                                {{ __('Price') }}
                            </th>
                            @if($user->hasRole('Viewer'))
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Owner') }}
                                </th>
                            @endif
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Published at') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Action') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('QRcode') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-200">
                        @foreach($rentals as $rental)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $rental->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rental->category->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">€{{ $rental->price }}</td>
                                @role('Viewer')
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rental->owner->name }}</td>
                                @endrole
                                <td class="px-6 py-4 whitespace-nowrap">{{$rental->created_at}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @role(['Private advertiser','Commercial advertiser'])
                                    <a href="{{ route('rentals.edit', ['rental' => $rental->id]) }}"
                                       class="inline-flex items-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        {{ __('Edit') }}
                                    </a>
                                    <form
                                        action="{{ route('rentals.delete', ['rental' => $rental->id]) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    @endrole
                                    <a href="{{ route('rentals.show', ['rental' => $rental->id]) }}"
                                       class="inline-flex items-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        {{ __('Details') }}
                                    </a>
                                </td>
                                <td>
                                    {{ ($qrCodes[$rental->id]) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-71 mx-auto sm:px-6 lg:px-8 mt-2">
            {{($rentals->links())}}
        </div>
    </div>
</x-app-layout>
