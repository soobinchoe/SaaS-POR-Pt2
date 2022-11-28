<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-bold text-gray-700 text-lg mb-4">{{ __("Delete Book") }}</h3>
                    <div class="grid grid-cols-4">
                        <p class="">{{ __("Title") }}</p>
                        <p class="p-2 col-span-3">{{ $book->title }}</p>
                        <p class="">{{ __("Subtitle") }}</p>
                        <p class="p-2 col-span-3">{{ $book->subtitle ?  : "N/A"}}</p>
                        <p class="">{{ __("Year published") }}</p>
                        <p class="p-2 col-span-3">{{ $book->year_published ? :"N/A"}}</p>
                        <p class="">{{ __("Edition") }}</p>
                        <p class="p-2 col-span-3">{{ $book->edition ? :"N/A" }}</p>
                        <p class="">{{ __("isbn 10") }}</p>
                        <p class="p-2 col-span-3">{{ $book->isbn_10 ? :"N/A" }}</p>
                        <p class="">{{ __("isbn 13") }}</p>
                        <p class="p-2 col-span-3">{{ $book->isbn_13 ? :"N/A" }}</p>
                        <p class="">{{ __("Height") }}</p>
                        <p class="p-2 col-span-3">{{ $book->height ? :"N/A" }}</p>
                        <p class="">{{ __("Genre") }}</p>
                        <p class="p-2 col-span-3">{{ $book->genre ? :"N/A" }}</p>
                        <p class="">{{ __("Sub Genre") }}</p>
                        <p class="p-2 col-span-3">{{ $book->sub_genre ?  : "N/A"}}</p>
                        <p class="">{{ __("Author") }}</p>
                        <div class="flex flex-col p-2 col-span-3">
                            <p class="">
                                {{ $book->authors()->count() }}@if ($book->authors()->count()>0)
                                    , {{ __("including") }}...
                                @endif
                            </p>
                            <ul class="list-circle list-inside pl-4">
                                @foreach($book->authors as $author)
                                    @if($loop->index<5)
                                        <li>{{$author->given_name}} {{$author->family_name}}</li>
                                    @endif
                                @endforeach
                                @if($book->authors()->count()>=5)
                                    <li class="text-stone-600">{{ __("and others") }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class=""></div>

                    <form action="{{ route('books.destroy', compact(['book'])) }}"
                          method="POST"
                          class="mt-6 col-span-3 flex flex-row gap-4">
                        @csrf
                        @method('delete')
                        <a href="{{ route('books.index') }}"
                           class="py-2 px-4 mx-2 w-1/6 text-center
                              rounded border border-stone-600
                              hover:bg-stone-600
                              text-stone-600 hover:text-white
                              transition duration-500">
                            <i class="fa fa-circle-left"></i> {{ __("Back") }}
                        </a>
                        <button type="submit"
                                class="py-2 px-4 mx-2 w-1/6 text-center
                                       rounded border border-red-600
                                       hover:bg-red-600
                                       text-red-600 hover:text-white
                                       transition duration-500">
                            <i class="fa fa-trash"></i> {{ __("Confirm Delete") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
