<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.index') }}" class="bg-slate-700 text-white rounded-md px-3 py-2 text-sm hover:bg-slate-600">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action='{{ route('roles.store') }}' method='POST'>
                        @csrf
                        <div>
                            <label for='' class='text-lg font-medium'>Name</label>
                            <div class='my-3'>
                                <input type='text' value='{{ old('name') }}' class='border-gray-300 shadow-sm w-1/2 rounded-lg' name='name' placeholder="Roll Name">
                                @error('name')
                                    <p class='text-red-400 font-medium'>{{$message}}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 mb-3">
                                <div class="mt-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <input type="checkbox" class="rounded" id="permission-{{ $permission->id }}" name="permission[]" value="{{ $permission->name }}">
                                            <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <button class='bg-slate-700 hover:bg-slate-600 text-sm text-white rounded-md px-5 py-3'>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
