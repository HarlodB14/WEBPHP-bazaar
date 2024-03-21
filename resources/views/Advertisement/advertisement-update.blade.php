<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $advertisement->title }} - {{ __('Advertisement Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('advertisements.update', ['advertisement' => $advertisement->id]) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                        <div class="mb-4">
                            <label for="title"
                                   class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Title') }}</label>
                            <input type="text" id="title" name="title" value="{{ $advertisement->title }}"
                                   class="shadow appearance-none border rounded w-72 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray"
                                   required>
                        </div>
                        @error('title')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <label for="category"
                                   class="block text-gray-700 dark:text-gray-300 font-bold mb-4">{{ __('Category') }}</label>
                            <select id="category" name="category"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="body"
                                   class="block text-gray-700 dark:text-gray-300 font-bold mb-4">{{ __('Body') }}</label>
                            <textarea id="body" name="body"
                                      class="shadow appearance-none border rounded w-full h-40 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray"
                                      required>{{ $advertisement->body }}</textarea>
                        </div>
                        @error('body')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <label for="image_URL"
                                   class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Image URL') }}</label>
                            <input type="text" id="image_URL" name="image_URL" value="{{ $advertisement->image_URL }}"
                                   class="shadow appearance-none border rounded w-72 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray"
                                   required></input>
                        </div>
                        @error('image_URL')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <label for="price"
                                   class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Price') }}</label>
                            <input type="number" min="0" step="any" id="price" name="price"
                                   class="shadow appearance-none border rounded w-72 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray"
                                   placeholder="{{ __('Enter price') }}" value="{{$advertisement->price }}" required>
                        </div>
                        @error('price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
