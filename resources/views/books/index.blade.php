<x-layout title="Books Management">
    <style>
        /* Existing glassmorphism from posts */
        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .status-badge {
            @apply px-2 py-1 rounded-full text-xs font-bold;
        }
        .status-available { @apply bg-green-500/20 text-green-400 border-green-400/30; }
        .status-unavailable { @apply bg-red-500/20 text-red-400 border-red-400/30; }
    </style>

    <div class="min-h-screen py-12 px-4 font-sans antialiased">
        <div class="max-w-7xl mx-auto">
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden mb-8">
                <div class="p-8 bg-gradient-to-r from-indigo-600/20 to-blue-600/20 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-white">📚 Books Library</h1>
                            <p class="text-indigo-200">Manage your book collection</p>
                        </div>
                        <a href="/books/create" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                            + Add New Book
                        </a>
                    </div>
                </div>
                
                <!-- Search & Filter -->
                <div class="p-8 border-b border-white/5">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-400 mb-2">Search Title/Author</label>
                            <input 
                                type="text" 
                                id="searchInput" 
                                placeholder="Search books..." 
                                class="w-full bg-slate-950/50 border border-slate-700/50 text-white px-4 py-3 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-400 mb-2">Filter by Genre</label>
                            <select id="genreFilter" class="w-full bg-slate-950/50 border border-slate-700/50 text-white px-4 py-3 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                                <option value="">All Genres</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Non-Fiction">Non-Fiction</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Sci-Fi">Sci-Fi</option>
                                <option value="Romance">Romance</option>
                                <option value="Biography">Biography</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <span class="text-sm text-slate-400">Found: <span id="foundCount" class="font-bold text-white">0</span> books</span>
                        </div>
                    </div>
                </div>

                <!-- Books Table -->
                <div class="overflow-x-auto">
                    @if($books->count() > 0)
                        <table class="w-full">
                            <thead>
                                <tr class="bg-white/5 text-slate-300 uppercase text-xs font-bold tracking-wider">
                                    <th class="p-6 text-left w-12">Cover</th>
                                    <th class="p-6 text-left">Title</th>
                                    <th class="p-6 text-left">Author</th>
                                    <th class="p-6 text-left">Genre</th>
                                    <th class="p-6 text-right">Price</th>
                                    <th class="p-6 text-center">Available</th>
                                    <th class="p-6 text-left w-32">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($books as $book)
                                <tr class="book-row hover:bg-white/5 transition-colors group" data-genre="{{ $book->genre }}" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}">
                                    <td class="p-6">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="w-12 h-16 object-cover rounded-lg shadow-md">
                                        @else
                                            <div class="w-12 h-16 bg-gradient-to-br from-slate-700 to-slate-800 rounded-lg flex items-center justify-center text-slate-500 text-sm font-bold">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-6 font-semibold text-white max-w-md">{{ Str::limit($book->title, 50) }}</td>
                                    <td class="p-6 text-slate-300">{{ Str::limit($book->author, 30) }}</td>
                                    <td class="p-6">
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-bold border border-blue-400/30">
                                            {{ $book->genre }}
                                        </span>
                                    </td>
                                    <td class="p-6 text-right font-mono text-lg font-bold text-emerald-400">
                                        ${{ number_format($book->price, 2) }}
                                    </td>
                                    <td class="p-6 text-center">
                                        <span class="status-badge {{ $book->is_available ? 'status-available' : 'status-unavailable' }}">
                                            {{ $book->is_available ? '✅ Available' : '❌ Unavailable' }}
                                        </span>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-all">
                                            <a href="/books/{{ $book->id }}" class="p-2 text-blue-400 hover:text-blue-300 hover:bg-blue-500/20 rounded-lg transition-all" title="View">
                                                👁️
                                            </a>
                                            <a href="/books/{{ $book->id }}/edit" class="p-2 text-emerald-400 hover:text-emerald-300 hover:bg-emerald-500/20 rounded-lg transition-all" title="Edit">
                                                ✏️
                                            </a>
                                            <form method="POST" action="/books/{{ $book->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-400 hover:text-red-300 hover:bg-red-500/20 rounded-lg transition-all" title="Delete" onclick="return confirm('Delete this book?')">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-12 text-center">
                            <svg class="h-16 w-16 text-slate-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h3 class="text-xl font-bold text-slate-300 mb-2">No books found</h3>
                            <p class="text-slate-500 mb-6">Get started by adding your first book.</p>
                            <a href="/books/create" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg">
                                Add First Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterBooks() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const genre = document.getElementById('genreFilter').value;
            const rows = document.querySelectorAll('.book-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const title = row.dataset.title;
                const author = row.dataset.author;
                const rowGenre = row.dataset.genre;

                const matchesSearch = title.includes(search) || author.includes(search);
                const matchesGenre = !genre || rowGenre === genre;

                if (matchesSearch && matchesGenre) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('foundCount').textContent = visibleCount;
        }

        document.getElementById('searchInput').addEventListener('keyup', filterBooks);
        document.getElementById('genreFilter').addEventListener('change', filterBooks);
    </script>
</x-layout>

