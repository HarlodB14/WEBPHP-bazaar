<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Validation Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="list-disc ml-4">{{ __($error) }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('rentals.index') }}"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Go back</a>
        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden flex">
            <div class="p-4 w-1/2 text-white">
                <h2 class="text-xl font-bold mb-2">{{ $rental->title }}</h2>
                <div class="flex items-center">
                    <span class="text-gray-400">Category:</span>
                    <span class="ml-2 text-gray-300">{{ $rental->category->type }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-400">Price:</span>
                    <span class="ml-2 text-gray-300">€{{ $rental->price }}</span>
                </div>
                <div class="mt-4 flex-grow">
                    <img src="{{ $rental->image_URL }}" alt="{{ $rental->title }}" class="w-full">
                </div>
                <div class="mt-10">
                    {!! $qrcode !!}
                </div>
                <div class="mt-10">
                    @role('Viewer')
                    <form action="{{ route('rentals.date.save', ['rental' => $rental->id]) }}" method="POST"
                          class="inline">
                        @csrf
                        <h2 class="text-xl font-bold mb-2">{{ __('Select the date-period for this rental-item') }}</h2>
                        <div class="flex items-center">
                            <label for="start">Start Date:</label>
                            <input type="date" id="start" name="start" lang="en"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5 ml-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Select date start">
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="end">End Date:</label>
                            <input type="date" id="end" name="end" lang="en"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5 ml-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Select date end">
                        </div>
                        <button type="submit"
                                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                            {{__('Save rental period')}}
                        </button>
                    </form>
                    @endrole
                    @role(['Private advertiser','Commercial advertiser'])
                    <div class="mt-4">
                        <a href="{{ route('rentals.edit', ['rental' => $rental->id]) }}"
                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('rentals.delete', ['rental' => $rental->id]) }}" method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endrole
                </div>
            </div>
            <div class="w-1/2 flex-grow">
                <p class="text-gray-300 p-5">{{ $rental->body }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
