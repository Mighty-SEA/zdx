<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        <i class="fas fa-chart-bar text-[#FF6000] mr-2"></i> Statistik
    </h3>
    
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            <p class="text-blue-700 text-sm">Anda dapat mengedit angka statistik yang ditampilkan pada bagian beranda.</p>
        </div>
    </div>
    
    @php 
        $stats = $metadata['items'] ?? [
            ['number' => '', 'label' => '', 'symbol' => ''],
            ['number' => '', 'label' => '', 'symbol' => ''],
            ['number' => '', 'label' => '', 'symbol' => ''],
            ['number' => '', 'label' => '', 'symbol' => '']
        ];
    @endphp
    
    <div id="stats-container" class="space-y-4">
        @foreach($stats as $index => $stat)
        <div class="stat-item bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between mb-2">
                <h4 class="font-medium text-gray-700">Statistik #{{ $index + 1 }}</h4>
                @if($index > 0)
                <button type="button" class="remove-stat text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
                @endif
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Angka</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                        name="stats[{{ $index }}][number]" value="{{ $stat['number'] ?? '' }}" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                        name="stats[{{ $index }}][label]" value="{{ $stat['label'] ?? '' }}" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Simbol</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                        name="stats[{{ $index }}][symbol]" value="{{ $stat['symbol'] ?? '' }}" placeholder="contoh: +, %, dll">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <button type="button" id="add-stat" class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6000]">
        <i class="fas fa-plus mr-2"></i> Tambah Statistik
    </button>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addStatBtn = document.getElementById('add-stat');
    const statsContainer = document.getElementById('stats-container');
    
    if (addStatBtn && statsContainer) {
        addStatBtn.addEventListener('click', function() {
            const statItems = document.querySelectorAll('.stat-item');
            const newIndex = statItems.length;
            
            const newStatDiv = document.createElement('div');
            newStatDiv.className = 'stat-item bg-gray-50 p-4 rounded-lg';
            newStatDiv.innerHTML = `
                <div class="flex justify-between mb-2">
                    <h4 class="font-medium text-gray-700">Statistik #${newIndex + 1}</h4>
                    <button type="button" class="remove-stat text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Angka</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                            name="stats[${newIndex}][number]" value="" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                            name="stats[${newIndex}][label]" value="" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Simbol</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                            name="stats[${newIndex}][symbol]" value="" placeholder="contoh: +, %, dll">
                    </div>
                </div>
            `;
            
            statsContainer.appendChild(newStatDiv);
            
            // Menambahkan event listener untuk tombol hapus
            const removeBtn = newStatDiv.querySelector('.remove-stat');
            removeBtn.addEventListener('click', function() {
                newStatDiv.remove();
                reindexStats();
            });
        });
        
        // Menambahkan event listener untuk tombol hapus yang sudah ada
        document.querySelectorAll('.remove-stat').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.stat-item').remove();
                reindexStats();
            });
        });
        
        // Fungsi untuk mengindeks ulang statistik
        function reindexStats() {
            const statItems = document.querySelectorAll('.stat-item');
            statItems.forEach((item, index) => {
                item.querySelector('h4').textContent = `Statistik #${index + 1}`;
                
                // Update nama input field
                const inputs = item.querySelectorAll('input');
                inputs[0].name = `stats[${index}][number]`;
                inputs[1].name = `stats[${index}][label]`;
                inputs[2].name = `stats[${index}][symbol]`;
            });
        }
    }
});
</script>
@endpush 