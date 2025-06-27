<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articals Edits') }}
            </h2>
            <a href="{{ route('articals.index') }}" class="bg-slate-700 text-white rounded-md px-3 py-2 text-sm hover:bg-slate-600">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action='{{ route('articals.update',['id' => $artical->id]) }}' method='POST'>
                        @csrf @method('PUT')
                        <div>
                            <label for='' class='text-lg font-medium'>Title</label>
                            <div class='my-3'>
                                <input type='text' value='{{ old('title', $artical->title) }}' class='border-gray-300 shadow-sm w-1/2 rounded-lg' name='title' placeholder="title">
                                @error('title')
                                    <p class='text-red-400 font-medium'>{{$message}}</p>
                                @enderror
                            </div>
                            <label for='' class='text-lg font-medium'>Content</label>
                            <div class='my-3'>
                                <textarea class='border-gray-300 shadow-sm w-1/2 rounded-lg' name="text" id="text" cols="20" rows="20" placeholder="Content">{{ old('text',$artical->text) }}</textarea>
                                @error('text')
                                    <p class='text-red-400 font-medium'>{{$message}}</p>
                                @enderror
                            </div>
                            <label for='' class='text-lg font-medium'>author</label>
                            <div class='my-3'>
                                <input type='text' value='{{ old('author',$artical->author) }}' class='border-gray-300 shadow-sm w-1/2 rounded-lg' name='author' placeholder="Author">
                                @error('author')
                                    <p class='text-red-400 font-medium'>{{$message}}</p>
                                @enderror
                            </div>
                            <button class='bg-slate-700 hover:bg-slate-600 text-sm text-white rounded-md px-5 py-3'>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
