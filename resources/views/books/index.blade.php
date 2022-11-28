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
                    <a href="{{ route('books.create') }}"
                       class="rounded mb-6 p-2 bg-sky-500 text-white text-center w-1/5 min-w-64">Add new Book</a>
                    @empty($books)
                        <p>sorry no books.</p>
                    @else
                    <table class="table w-full">
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
                                        @if($loop->index<1)
                                            <p>{{$author->given_name}} {{$author->family_name}}</p>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="p-2">{{ $book->genre }}</td>
                                <td class="p-2">
                                        <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">View</a>
                                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                                        <a class="btn btn-primary" href="{{ route('books.delete',$book->id) }}">Delete</a>
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
                    @endempty
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
