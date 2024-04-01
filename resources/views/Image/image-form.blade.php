<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative  max-w-xl mx-auto mb-4"
                 role="alert">
                <strong class="font-bold">{{$message}}</strong>
            </div>
            <div class="m-1">
                <img src="{{ asset('images/'.Session::get('image')) }}" class="mx-auto mb-8"/>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-3xl font-semibold mb-8">Image Upload</h1>
                    <div class="m-1">
                        <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file"
                                   class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4"
                                   name="image"/>

                            <button type="submit"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
