<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles List') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-slate-700 text-white rounded-md px-3 py-2 text-sm hover:bg-slate-600">
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
                                <th class='px-6 py-3 text-left'>Name</th>
                                <th class='px-6 py-3 text-left'>Permissions</th>
                                <th class='px-6 py-3 text-left' width='180'>Created</th>
                                <th class='px-6 py-3 text-center'width='180'>Action</th>
                            </tr>
                        </tehead>
                        <tbody class='bg-white'>
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <tr class='border-b'>
                                        <td class='px-6 py-3 text-left'>
                                            {{ $role->id }}
                                        </td>
                                        <td class='px-6 py-3 text-left'>
                                            {{ $role->name }}
                                        </td>
                                        <td class='px-6 py-3 text-left'>
                                            {{ $role->permissions->pluck('name')->implode(', ') }}
                                        </td>
                                        <td class='px-6 py-3 text-left'>
                                            {{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}
                                        </td>
                                        <td class='px-6 py-3 text-center'>
                                            <a href="{{ route('roles.edit',$role->id) }}" class="bg-slate-700 text-white rounded-md px-2 py-2 text-sm hover:bg-slate-600">
                                                Edit
                                            </a>

                                            <a href="javascript:void(0);" onclick='deleteRoll({{ $role->id }})' class="bg-red-700 text-white rounded-md ml-2 px-2 py-2 text-sm hover:bg-red-600">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                      </table>
                  <div class='my-3'>{{$roles->links()}}</div>

                </div>
            </div>
        </div>
    </div>
    <x-slot name='script'>
        <script type='text/javascript'>
            function deleteRoll(id) {
                if (confirm('Are you sure you want to delete?')) {
                    $.ajax({
                        url: "{{ route('roles.destroy') }}",
                        type: "DELETE",
                        data: { id: id },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            window.location.href = '{{ route("roles.index") }}';
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
