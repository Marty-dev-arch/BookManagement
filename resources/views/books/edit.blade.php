<x-layout title="Edit Book - {{ $book->title }}">
    <div class="min-h-screen py-12 px-4 font-sans antialiased">
        <div class="max-w-2xl mx-auto">
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 bg-gradient-to-r from-yellow-600/20 to-orange-600/20 border-b border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-yellow-500/30 rounded-2xl ring-1 ring-yellow-400/40">
                            <svg class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1.5-3l1 1 3.5-3.5 1 1-3.5 3.5" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white">Edit Book</h1>
                            <p class="text-yellow-200 mt-1">Update details for <strong>{{ $book->title }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="/books/{{ $book->id }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-400 mb-2">Book Title *</label>
                            <input 
                                id="title"
                                name="title" 
                                type="text" 
                                required 
                                value="{{ old('title', $book->title) }}"
                                class="form-input @error('title') border-red-500 ring-2 ring-red-500/20 @enderror"
                                placeholder="Enter book title"
                            />
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div>
                            <label for="author" class="block text-sm font-semibold text-slate-400 mb-2">Author *</label>
                            <input 
                                id="author"
                                name="author" 
                                type="text" 
                                required 
                                value="{{ old('author', $book->author) }}"
                                class="form-input @error('author') border-red-500 ring-2 ring-red-500/20 @enderror"
                                placeholder="Enter author name"
                            />
                            @error('author')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publisher -->
                        <div>
                            <label for="publisher" class="block text-sm font-semibold text-slate-400 mb-2">Publisher *</label>
                            <input 
                                id="publisher"
                                name="publisher" 
                                type="text" 
                                required 
                                value="{{ old('publisher', $book->publisher) }}"
                                class="form-input @error('publisher') border-red-500 ring-2 ring-red-500/20 @enderror"
                                placeholder="Enter publisher"
                            />
                            @error('publisher')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-400 mb-2">Description *</label>
                            <textarea 
                                id="description"
                                name="description" 
                                rows="4"
                                required 
                                class="form-textarea @error('description') border-red-500 ring-2 ring-red-500/20 @enderror"
                                placeholder="Enter book description..."
                            >{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Genre -->
                        <div>
                            <label for="genre" class="block text-sm font-semibold text-slate-400 mb-2">Genre *</label>
                            <select 
                                id="genre"
                                name="genre" 
                                required 
                                class="form-select @error('genre') border-red-500 ring-2 ring-red-500/20 @enderror"
                            >
                                <option value="">Select Genre</option>
                                <option value="Fiction" {{ old('genre', $book->genre) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                <option value="Non-Fiction" {{ old('genre', $book->genre) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                <option value="Mystery" {{ old('genre', $book->genre) == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                                <option value="Sci-Fi" {{ old('genre', $book->genre) == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                                <option value="Romance" {{ old('genre', $book->genre) == 'Romance' ? 'selected' : '' }}>Romance</option>
                                <option value="Biography" {{ old('genre', $book->genre) == 'Biography' ? 'selected' : '' }}>Biography</option>
                            </select>
                            @error('genre')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Year & Pages -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="published_year" class="block text-sm font-semibold text-slate-400 mb-2">Published Year *</label>
                                <input 
                                    id="published_year"
                                    name="published_year" 
                                    type="number" 
                                    min="1800" 
                                    max="{{ date('Y') }}" 
                                    required 
                                    value="{{ old('published_year', $book->published_year) }}"
                                    class="form-input @error('published_year') border-red-500 ring-2 ring-red-500/20 @enderror"
                                />
                                @error('published_year')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="pages" class="block text-sm font-semibold text-slate-400 mb-2">Pages *</label>
                                <input 
                                    id="pages"
                                    name="pages" 
                                    type="number" 
                                    min="1" 
                                    required 
                                    value="{{ old('pages', $book->pages) }}"
                                    class="form-input @error('pages') border-red-500 ring-2 ring-red-500/20 @enderror"
                                />
                                @error('pages')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ISBN & Language -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="isbn" class="block text-sm font-semibold text-slate-400 mb-2">ISBN * (Unique)</label>
                                <input 
                                    id="isbn"
                                    name="isbn" 
                                    type="text" 
                                    required 
                                    value="{{ old('isbn', $book->isbn) }}"
                                    class="form-input @error('isbn') border-red-500 ring-2 ring-red-500/20 @enderror"
                                    placeholder="e.g. 978-3-16-148410-0"
                                />
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="language" class="block text-sm font-semibold text-slate-400 mb-2">Language *</label>
                                <input 
                                    id="language"
                                    name="language" 
                                    type="text" 
                                    required 
                                    value="{{ old('language', $book->language) }}"
                                    class="form-input @error('language') border-red-500 ring-2 ring-red-500/20 @enderror"
                                    placeholder="e.g. English"
                                />
                                @error('language')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-slate-400 mb-2">Price ($) *</label>
                            <input 
                                id="price"
                                name="price" 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                required 
                                value="{{ old('price', $book->price) }}"
                                class="form-input @error('price') border-red-500 ring-2 ring-red-500/20 @enderror"
                                placeholder="0.00"
                            />
                            @error('price')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Availability -->
                        <div class="flex items-center">
                            <input 
                                id="is_available"
                                name="is_available" 
                                type="checkbox" 
                                {{ old('is_available', $book->is_available) ? 'checked' : '' }}
                                class="w-4 h-4 text-emerald-600 bg-slate-800 border-slate-600 rounded focus:ring-emerald-500"
                            >
                            <label for="is_available" class="ml-2 block text-sm font-semibold text-slate-300">Available for borrowing</label>
                        </div>

                        <!-- Current Cover Image -->
                        @if($book->cover_image)
                        <div class="p-4 bg-slate-800/50 rounded-xl border border-slate-700/50">
                            <label class="block text-sm font-semibold text-slate-400 mb-3">Current Cover Image</label>
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current cover" class="w-24 h-32 object-cover rounded-lg shadow-lg mx-auto">
                        </div>
                        @endif

                        <!-- New Cover Image -->
                        <div>
                            <label for="cover_image" class="block text-sm font-semibold text-slate-400 mb-2">New Cover Image (optional - replaces current)</label>
                            <input 
                                id="cover_image"
                                name="cover_image" 
                                type="file" 
                                accept="image/*"
                                class="form-input block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-600/30 file:text-indigo-200 hover:file:bg-indigo-500/50 cursor-pointer"
                            />
                            <p class="mt-1 text-xs text-slate-500">PNG, JPG up to 5MB. Leave empty to keep current.</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button 
                                type="submit"
                                class="flex-1 bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all focus:outline-none focus:ring-4 focus:ring-yellow-500/20"
                            >
                                Update Book
                            </button>
                            <a 
                                href="/books"
                                class="flex-1 text-center bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 font-bold py-4 px-8 rounded-xl border border-slate-600/50 transition-all"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-input, .form-textarea, .form-select {
            @apply w-full bg-slate-950/50 border border-slate-700/50 text-white px-4 py-3 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all text-sm placeholder:text-slate-600;
        }
        .form-textarea {
            @apply min-h-[100px] resize-vertical;
        }
    </style>
</x-layout>

