<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rentals') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-71 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('rentals.index') }}"
                       class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mb-4">
                        {{ __('Show list of rentals') }}
                    </a>
                    <div id="calendar"></div>
                    <div id="error" class="text-red-500"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
