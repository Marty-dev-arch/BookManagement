<x-layout title="Users">
    <h1 class="text-2xl font-bold mb-6">Users List</h1>
    
    <div class="mb-6">
        <a href="/users/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New User</a>
    </div>
    
    @if($users->count() > 0)
        <table class="w-full bg-white/10 border border-white/20 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-white/5">
                    <th class="p-4 text-left">First Name</th>
                    <th class="p-4 text-left">Last Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Age</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t border-white/10 hover:bg-white/5">
                    <td class="p-4">{{ $user->first_name }}</td>
                    <td class="p-4">{{ $user->last_name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->age }}</td>
                    <td class="p-4">
                        <a href="/users/{{ $user->id }}/edit" class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">Edit</a>
                        <form method="POST" action="/users/{{ $user->id }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-400">No users yet. <a href="/users/create" class="text-blue-400 hover:underline">Create one</a>.</p>
    @endif
</x-layout>
