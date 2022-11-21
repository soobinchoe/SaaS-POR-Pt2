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
                    <h3 class="font-bold text-gray-700 text-lg mb-4">{{ __("Edit Book") }}</h3>
                        @if($errors->any())
                        <div class="bg-red-200 text-red-800 p-2 rounded border-red-800 mb-4">
                            <i class="fa fa-triangle-exclamation text-xl pl-2 pr-4"></i>
                            You have errors in your form submission.
                        </div>
                        @enderror
                        <form action="{{ route('books.update', compact(['book'])) }}"
                              class="flex flex-col gap-4"
                              method="post">

                            @csrf
                            @method('patch')
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Title" class="">{{ __("Title") }}</label>
                                <input type="text"
                                       id="Title" name="title"
                                       value="{{ old("title") ?? $book->title }}"
                                       class="p-2 col-span-5">
                                @error('title')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Subtitle" class="">{{ __("Subtitle") }}</label>
                                <input type="text"
                                       id="Subtitle" name="subtitle"
                                       value="{{ old("subtitle") ?? $book->subtitle }}"
                                       class="p-2 col-span-5">
                                @error('subtitle')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-4">
                                <p class="">{{ __("Written by") }}</p>
                                <div class="flex flex-col col-span-5">
                                    <p class="">
                                        {{ $book->authors()->count() }}@if ($book->authors()->count()>0)
                                            , {{ __("including") }}...
                                        @endif
                                    </p>
                                    <ul class="list-circle list-inside pl-4">
                                        @foreach($book->authors as $author)
                                            @if($loop->index<5)
                                                <li>{{$author->given_name}}</li>
                                            @endif
                                        @endforeach
                                        @if($book->authors()->count()>=5)
                                            <li class="text-stone-600">{{ __("and others") }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-4">

                                <span></span>

                                <div class="mt-6 col-span-5 flex flex-row gap-4 -ml-2">
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
                                        <i class="fa fa-trash"></i> {{ __("Save") }}
                                    </button>
                                </div>
                            </div>
                    ...
                        </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
