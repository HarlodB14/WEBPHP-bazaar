<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        @if(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4">
                <span class="block sm:inline">{{ session()->get('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                      clip-rule="evenodd"/>
            </svg>
        </span>
            </div>
        @endif
        <a href="{{ route('advertisements.index') }}"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">{{__('Go back')}}</a>
        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden flex">
            <div class="p-4 w-1/3 text-white">
                <h2 class="text-xl font-bold mb-2">{{ __($advertisement->title) }}</h2>
                <div class="flex items-center">
                    <span class="text-gray-400">{{__('Category:')}}</span>
                    <span class="ml-2 text-gray-300">{{ __($advertisement->category->type) }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-400">{{__('Price:')}}</span>
                    <span class="ml-2 text-gray-300">€{{ __($advertisement->price) }}</span>
                </div>
                <div class="mt-4 flex-grow">
                    <img src="{{ $image_url }}" alt="example-image.png"
                         class="w-full">
                </div>
                <div class="mt-10">
                    {!! $qrcode !!}
                </div>
                @role(['Private advertiser','Commercial advertiser'])
                <div class="mt-4">
                    <a href="{{ route('advertisements.edit', ['advertisement' => $advertisement->id]) }}"
                       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Edit')}}</a>
                    <form action="{{ route('advertisements.delete', ['advertisement' => $advertisement->id]) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{__('Delete')}}</button>
                    </form>
                </div>
                @endrole
            </div>
            <div class="w-1/3 flex-grow">
                <p class="text-gray-300 p-5">{{__($advertisement->body) }}</p>
            </div>
            <div class="w-1/3 flex-grow">
                <h3 class="text-white text-xl font-bold mb-4">{{ __('Current Bids') }}</h3>
                <ul class="text-gray-300">
                    @if($currentBids->count() > 0)
                        <ul class="text-gray-300 w-fit">
                            @foreach($currentBids->get() as $currentBid)
                                <li class="flex items-center">
                                    @if ($currentBid->users->isNotEmpty())
                                        @foreach ($currentBid->users as $user)
                                            @if ($advertisement->expired && $currentBid->amount == $highestBid->amount)
                                                <span
                                                    class="text-green-500">{{ __('Winner: ') }} {{ $user->name }} </span>
                                            @else
                                                {{ $user->name }}: €{{ $currentBid->amount }}
                                            @endif
                                        @endforeach
                                    @else
                                        {{ __('Unknown User') }}: €{{ $currentBid->amount }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p style="font-weight: bold;"> {{__('No bid has been placed yet')}}</p>
                    @endif
                    @role('Viewer')
                    <div class="mt-4">
                        <form action="{{ route('bids.place', ['advertisement' => $advertisement->id]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <label for="amount" class="text-gray-400">{{ __('Bid Amount:') }}</label>
                            <input type="number" id="amount" name="amount"
                                   class="w-15 bg-gray-700 border border-gray-600 rounded px-3 py-2 mt-2 text-white"
                                   required>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">{{ __('Place bid') }}</button>
                        </form>
                    </div>
                    @endrole
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
