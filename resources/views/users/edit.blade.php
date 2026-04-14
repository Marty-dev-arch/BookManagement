<x-layout title="Edit User">

 <div class="flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Edit User: {{ $user->name }}</h1>
    
    <form method="POST" action="/users/{{ $user->id }}" class="max-w-md bg-white/10 p-6 rounded-lg">
        @csrf
        @method('PATCH')
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" required class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">First Name</label>
            <input type="text" name="first_name" value="{{ $user->first_name }}" required class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Last Name</label>
            <input type="text" name="last_name" value="{{ $user->last_name }}" required class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Middle Name</label>
            <input type="text" name="middle_name" value="{{ $user->middle_name ?? '' }}" class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Nickname</label>
            <input type="text" name="nickname" value="{{ $user->nickname ?? '' }}" class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Age</label>
            <input type="number" name="age" value="{{ $user->age ?? '' }}" class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Address</label>
            <textarea name="address" class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">{{ $user->address ?? '' }}</textarea>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Contact Number</label>
            <input type="text" name="contact_number" value="{{ $user->contact_number ?? '' }}" class="w-full p-3 bg-white/20 border border-white/30 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Update User</button>
            <a href="/users" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
     </div>
    </form>
</x-layout>
