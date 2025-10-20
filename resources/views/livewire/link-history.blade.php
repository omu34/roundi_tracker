<div class="max-w-5xl mx-auto py-10 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500 mr-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            My Link History
        </h1>
    </div>

    <!-- Search and Stats -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="w-full md:w-1/3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by URL or Title..."
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <p class="text-sm text-gray-500">
            Showing {{ $links->count() }} of {{ $links->total() }} recorded clicks.
        </p>
    </div>

    <!-- History Table -->
    <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
        @if ($links->isEmpty())
            <div class="p-8 text-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg font-medium">No Links Found</p>
                <p class="text-sm">Try clicking some tracked links or adjusting your search term.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Clicked At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($links as $link)
                        <tr wire:key="link-{{ $link->id }}">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $link->page_title ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 truncate max-w-xs lg:max-w-lg">
                                {{ $link->url }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $link->created_at->format('M d, Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ $link->url }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                    Visit
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="justify-center items-center mt-6">
            <livewire:track-link-click url="https://github.com" />
            <livewire:track-link-click url="{{ route('dashboard') }}" />
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $links->links() }}
    </div>
</div>
