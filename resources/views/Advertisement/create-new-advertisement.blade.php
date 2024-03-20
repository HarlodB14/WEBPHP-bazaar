<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create new advertisement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('publish') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Title') }}</label>
                            <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray" placeholder="{{ __('Enter title') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Category') }}</label>
                            <select id="category" name="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray">
                                @foreach($categories as $category)
                                    <option value=>{{ $category->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="body" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Body') }}</label>
                            <textarea id="body" name="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray" placeholder="{{ __('Enter body') }}" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image_URL" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Image URL') }}</label>
                            <input type="text" id="image_URL" name="image_URL" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray" placeholder="{{ __('Enter image URL') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('Price') }}</label>
                            <input type="number" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:focus:shadow-outline-gray" placeholder="{{ __('Enter price') }}" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Publish Advertisement') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
