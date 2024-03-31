<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session()->has('message'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4"
                role="alert">
                <span class="block sm:inline">{{ __(session()->get('message')) }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                          clip-rule="evenodd"/>
                </svg>
            </span>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome! set a custom URL for your landing-page here.") }}

                    <div class="text-black dark:text-gray-100">
                        <div class="mt-5"> <!-- Added px-4 class for left padding adjustment -->
                            <form action="{{ route('custom-url.set') }}" method="POST">
                                @csrf
                                <div class="flex">
                                    <input type="text" name="custom_url" placeholder="Enter Custom URL"
                                           class="text-black border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md">Set Custom URL</button>
                                </div>
                                @error('custom_url')
                                <div class="text-red-500 mt-2 ml-2">{{ __($message) }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
