<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Component') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:flex sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/2">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="max-w-md bg-gray-800">
                    <form method="POST" action="{{ route('components.store') }}">
                        @csrf
                        <input type="hidden" id="advertisement_id" name="advertisement_id">
                        <div class="mt-4">
                            <x-input-label for="types_id" :value="__('Type')"/>
                            <select id="types_id" name="types_id"
                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    style="background-color: #333; color: #fff;">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ ucfirst($type->type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')"/>
                            <textarea id="content" name="content" rows="4"
                                      class="form-textarea mt-1 mb-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                      style="resize: vertical;">{{ old('content') }}</textarea>
                        </div>
                        <div id="image-upload" class="mt-4 hidden">
                            <x-input-label for="image" :value="__('Image')"/>
                            <input type="file" id="image" name="image"
                                   class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                        </div>

                        <x-primary-button>{{ __('Add Component') }}</x-primary-button>
                    </form>

                    <div id="image-form" class="mt-4 hidden">
                        <h1 class="text-center text-3xl font-semibold mb-8">Image Upload</h1>
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
            <div id="advertisement-section"
                 class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/4 ml-2 h-64">
                <form id="add-advertisement-form" method="POST" action="{{ route('add.advertisement') }}">
                    @csrf <!-- CSRF token field -->
                    <label for="advertisement"
                           class="block text-sm font-medium text-gray-300">{{ __("Select Advertisement:") }}</label>
                    <select id="advertisement" name="advertisement"
                            class="block w-full mt-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                        @foreach($featuredAdvertisements as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="advertisement_id" name="advertisement_id">
                    <button id="add-advertisement-button"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">{{ __("Add Advertisement to Component") }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
