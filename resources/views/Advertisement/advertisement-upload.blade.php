<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Advertisement') }}
        </h2>
    </x-slot>
    <div class="max-w-4xl mx-auto px-4 py-8">
        @if(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4">
                <span class="block sm:inline">{{ session()->get('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
            </div>
        @endif
        <a href="{{ route('advertisements.index') }}"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">{{__('Go back')}}</a>
        <form method="POST" action="{{ route('advertisements.store.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden flex">
                <div class="p-4 w-1/2 text-white">
                    <label for="advertisement" class="block mb-1">Select a file to upload as an advertisement:</label>
                    <input type="file" id="csv_file" name="csv_file" accept=".csv">


                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">{{__('Upload')}}</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
