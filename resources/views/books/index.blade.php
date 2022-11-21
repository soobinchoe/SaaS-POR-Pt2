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
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Authors</th>
                            <th>Genre</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                                <td class="p-2 text-right">{{ $loop->iteration }}</td>
                                <td class="p-2">{{ $book->title }}</td>
                                <td class="p-2">
                                    @foreach($book->authors as $author)
                                        @if($loop->index<5)
                                            <li>{{$author->given_name}}</li>
                                        @endif
                                    @endforeach
                                    @if($book->authors()->count()>=5)
                                        <li class="text-stone-600">{{ __("and others") }}</li>
                                    @endif
                                </td>
                                <td class="p-2">{{ $book->genre }}</td>
                                <td class="p-2">
                                    View
                                    Edit
                                    Delete
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $books->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
