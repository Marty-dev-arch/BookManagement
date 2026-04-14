<x-layout title="View Book - {{ $book->title }}">
    <div class="min-h-screen py-12 px-4 font-sans antialiased">
        <div class="max-w-4xl mx-auto">
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 bg-gradient-to-r from-purple-600/20 to-violet-600/20 border-b border-white/10">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-bold text-white leading-tight">{{ $book->title }}</h1>
                            <p class="text-2xl text-slate-300 mt-2">{{ $book->author }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <span class="px-4 py-2 bg-purple-500/20 text-purple-300 rounded-xl font-bold border border-purple-400/30">
                                {{ $book->genre }}
                            </span>
                            <span class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-500 text-white font-bold rounded-xl shadow-lg">
                                ${{ number_format($book->price, 2) }}
                            </span>
                            <span class="status-badge px-4 py-2 text-sm {{ $book->is_available ? 'status-available bg-green-500/30 border-green-400/40 text-green-300' : 'status-unavailable bg-red-500/30 border-red-400/40 text-red-300' }}">
                                {{ $book->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                    <!-- Cover Image & Quick Actions -->
                    <div class="lg:sticky lg:top-8 lg:max-h-[500px] lg:overflow-auto">
                        <div class="text-center lg:text-left">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full max-w-md h-96 object-cover rounded-2xl shadow-2xl mx-auto lg:mx-0 mb-6">
                            @else
                                <div class="w-full max-w-md h-96 bg-gradient-to-br from-slate-700 to-slate-900 rounded-2xl flex items-center justify-center mx-auto lg:mx-0 mb-6 shadow-2xl">
                                    <svg class="h-24 w-24 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex flex-wrap gap-3 justify-center lg:justify-start pt-4">
                            <a href="/books/{{ $book->id }}/edit" class="flex-1 sm:flex-none bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white py-3 px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all text-center">
                                ✏️ Edit Book
                            </a>
                            <form method="POST" action="/books/{{ $book->id }}" class="flex-1 sm:flex-none inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white py-3 px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all" onclick="return confirm('Delete {{ $book->title }}? This cannot be undone.')">
                                    🗑️ Delete Book
                                </button>
                            </form>
                            <a href="/books" class="flex items-center justify-center px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 font-bold rounded-xl border border-slate-600/50 transition-all">
                                ← Back to Library
                            </a>
                        </div>
                    </div>

                    <!-- Book Details -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/10 pb-4">Book Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Publisher:</span>
                                    <p class="font-semibold text-white mt-1">{{ $book->publisher }}</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Language:</span>
                                    <p class="font-semibold text-white mt-1">{{ $book->language }}</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Published:</span>
                                    <p class="font-semibold text-white mt-1">{{ $book->published_year }}</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Pages:</span>
                                    <p class="font-semibold text-white mt-1">{{ number_format($book->pages) }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="text-slate-400">ISBN:</span>
                                    <p class="font-mono font-semibold text-white mt-1 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-600/50">{{ $book->isbn }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/10 pb-4">Description</h2>
                            <div class="prose prose-invert max-w-none p-6 bg-slate-900/30 rounded-2xl border border-slate-700/50">
                                <p class="text-lg leading-relaxed text-slate-200">{{ $book->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .status-badge {
            @apply px-2 py-1 rounded-full text-xs font-bold;
        }
    </style>
</x-layout>

