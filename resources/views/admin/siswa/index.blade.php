@extends('layouts.admin')

@section('page-title', 'Daftar Siswa')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Daftar Siswa</h2>
            <a href="{{ route('admin.siswa.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Siswa
            </a>
        </div>
        
        <!-- Regular Search Form (No Autocomplete) -->
        <div class="mb-4">
            <form action="{{ route('admin.siswa.index') }}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..." 
                       value="{{ request('search') }}" 
                       class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full md:w-1/3">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('admin.siswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                    Reset
                </a>
                @endif
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            NISN
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tingkat
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sekolah
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($siswa as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->nisn }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->tingkat ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->sekolah->nama_sekolah ?? 'Tidak ada sekolah' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.siswa.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Detail</a>
                            <a href="{{ route('admin.siswa.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                            <form class="inline-block" action="{{ route('admin.siswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Tidak ada data siswa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing autocomplete');
    
    const searchInput = document.getElementById('search-input');
    const autocompleteResults = document.getElementById('autocomplete-results');
    const searchForm = document.getElementById('search-form');
    
    console.log('Search input element:', searchInput);
    console.log('Autocomplete results element:', autocompleteResults);
    console.log('Search form element:', searchForm);
    
    if (!searchInput || !autocompleteResults) {
        console.error('Required elements not found!');
        return;
    }
    
    let debounceTimer;
    
    // Make sure form submits normally
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            console.log('Form submitted');
            // Let the form submit normally
        });
    }
    
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        console.log('Input detected, query:', query);
        
        // Clear previous timer
        clearTimeout(debounceTimer);
        
        // Hide results if empty
        if (query === '') {
            console.log('Empty query, hiding results');
            autocompleteResults.innerHTML = '';
            autocompleteResults.classList.add('hidden');
            return;
        }
        
        // Debounce to avoid too many requests
        debounceTimer = setTimeout(() => {
            console.log('Sending fetch request for:', query);
            
            // Use the full URL to avoid any route issues
            const url = `/admin/siswa/search?query=${encodeURIComponent(query)}`;
            console.log('Request URL:', url);
            
            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    autocompleteResults.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach(item => {
                            console.log('Creating item for:', item.nama);
                            const div = document.createElement('div');
                            div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                            div.textContent = item.nama;
                            
                            div.addEventListener('click', () => {
                                console.log('Item clicked:', item.nama);
                                searchInput.value = item.nama;
                                autocompleteResults.innerHTML = '';
                                autocompleteResults.classList.add('hidden');
                                
                                // Submit the form
                                console.log('Submitting form');
                                document.getElementById('search-form').submit();
                            });
                            
                            autocompleteResults.appendChild(div);
                        });
                        
                        autocompleteResults.classList.remove('hidden');
                    } else {
                        console.log('No results, hiding dropdown');
                        autocompleteResults.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching autocomplete data:', error);
                });
        }, 300); // 300ms delay
    });
    
    // Hide autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
            console.log('Clicked outside, hiding results');
            autocompleteResults.innerHTML = '';
            autocompleteResults.classList.add('hidden');
        }
    });
    
    console.log('Autocomplete initialization complete');
});
</script>
@endpush