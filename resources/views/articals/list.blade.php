<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articals List') }}
            </h2>
            <a href="{{ route('articals.create') }}" class="bg-slate-700 text-white rounded-md px-3 py-2 text-sm hover:bg-slate-600">
                Create
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-massage></x-massage>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <table class='w-full'>
                    <thead class='bg-gray-50'>
                        <tr class='border-b'>
                            <th class='px-6 py-3 text-left' width='60'>#</th>
                            <th class='px-6 py-3 text-left' width='180'>Title</th>
                            <th class='px-6 py-3 text-left' width='380'>Text</th>
                            <th class='px-6 py-3 text-left' width='200'>Author</th>
                            <th class='px-6 py-3 text-left' width='200'>Created at</th>
                            <th class='px-6 py-3 text-center'width='180'>Action</th>
                        </tr>
                    </tehead>
                    <tbody class='bg-white'>
                        @if ($articals->isNotEmpty())
                            @foreach ($articals as $artical)
                                <tr class='border-b'>
                                    <td class='px-6 py-3 text-left'>
                                        {{ $artical->id }}
                                    </td>
                                    <td class='px-6 py-3 text-left'>
                                        {{ $artical->title }}
                                    </td>
                                    <td class='px-6 py-3 text-left'>
                                        {{ $artical->text }}
                                    </td>
                                    <td class='px-6 py-3 text-left'>
                                        {{ $artical->author }}
                                    </td>
                                    <td class='px-6 py-3 text-left'>
                                        {{ \Carbon\Carbon::parse($artical->created_at)->format('d M, Y') }}
                                    </td>
                                    <td class='px-6 py-3 text-center'>
                                        @can('edit articals')
                                        <a href="{{ route('articals.edit',$artical->id) }}" class="bg-slate-700 text-white rounded-md px-2 py-2 text-sm hover:bg-slate-600">
                                            Edit
                                        </a>
                                        @endcan
                                        @can('delete artical')
                                        <a href="javascript:void(0);" onclick='deleteArtical({{ $artical->id }})' class="bg-red-700 text-white rounded-md ml-2 px-2 py-2 text-sm hover:bg-red-600">
                                            Delete
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                  <div class='my-3'>{{$articals->links()}}</div>

                </div>
            </div>
        </div>
    </div>
    <x-slot name='script'>
        <script type='text/javascript'>
            function deleteArtical(id) {
                if (confirm('Are you sure you want to delete?')) {
                    $.ajax({
                        url: "{{ route('articals.destroy') }}",
                        type: "DELETE",
                        data: { id: id },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            window.location.href = '{{ route("articals.index") }}';
                        },
                        error: function (xhr, status, error) {
                            alert('Error deleting permission.');
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
