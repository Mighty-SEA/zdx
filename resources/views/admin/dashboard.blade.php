@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard Analytics</h2>
                <p class="text-gray-600 mt-1">Pantau statistik dan performa website Anda secara real-time.</p>
            </div>
        </div>
        
        <!-- Alert jika Google Analytics belum dikonfigurasi -->
        <x-analytics-alert />
        
        <!-- Analytics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-[#FFF0E6] p-5 rounded-lg border border-[#FF6000]/20 hover:border-[#FF6000]/40 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-[#E65100] text-sm font-medium">Pengguna</div>
                    <div class="text-[#FF6000]"><i class="fas fa-users"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($totalUsers ?? 0) }}</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> {{ number_format($userGrowthRate ?? 0, 1) }}%
                </div>
            </div>
        
            <div class="bg-[#FFF8E1] p-5 rounded-lg border border-[#FFB300]/20 hover:border-[#FFB300]/40 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-[#FF8F00] text-sm font-medium">Pageviews</div>
                    <div class="text-[#FFB300]"><i class="fas fa-eye"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($pageviews ?? 0) }}</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +{{ number_format($pageviewGrowth ?? 0, 1) }}%
                </div>
            </div>
            
            <div class="bg-[#E8F5E9] p-5 rounded-lg border border-green-200 hover:border-green-300 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-green-800 text-sm font-medium">Bounce Rate</div>
                    <div class="text-green-700"><i class="fas fa-undo"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($bounceRate ?? 0, 1) }}%</div>
                <div class="text-red-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +{{ number_format($bounceRateChange ?? 0, 1) }}%
                </div>
            </div>
        
            <div class="bg-[#FFF3E0] p-5 rounded-lg border border-[#FF9800]/20 hover:border-[#FF9800]/40 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-[#F57C00] text-sm font-medium">Durasi Rata-rata</div>
                    <div class="text-[#FF9800]"><i class="fas fa-clock"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ $avgDuration ?? '0:00' }}</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +{{ number_format($durationGrowth ?? 0, 1) }}%
                </div>
            </div>
        </div>
    
        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Traffic Chart Area (2/3 width on large screens) -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Traffic Website</h2>
                    <div class="flex space-x-2">
                        <button class="text-xs bg-[#FFF0E6] text-[#FF6000] px-2 py-1 rounded-full hover:bg-[#FFCCBC] transition-colors duration-200">
                            7 Hari
                        </button>
                        <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full hover:bg-gray-200 transition-colors duration-200">
                            30 Hari
                        </button>
                        <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full hover:bg-gray-200 transition-colors duration-200">
                            90 Hari
                        </button>
                    </div>
                </div>
            
                <!-- Chart Canvas -->
                <div>
                    <canvas id="trafficChart" class="w-full h-80"></canvas>
                </div>
            
                <!-- Chart Legend -->
                <div class="flex justify-center mt-4 space-x-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-[#FF6000] rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Direct</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-[#FF9800] rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Organic</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-[#4CAF50] rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Referral</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-[#FFB300] rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Social</span>
                    </div>
                </div>
                
                <!-- Riwayat Pengunjung -->
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Riwayat Pengunjung Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Halaman</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perangkat</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($recentVisitors ?? [] as $visitor)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-700">{{ $visitor['ip'] }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-700">
                                        <span class="max-w-xs truncate block">{{ $visitor['page'] }}</span>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-700">
                                        <div class="flex items-center">
                                            <i class="fas fa-{{ $visitor['device'] == 'mobile' ? 'mobile-alt' : ($visitor['device'] == 'tablet' ? 'tablet-alt' : 'desktop') }} text-gray-400 mr-1"></i>
                                            <span>{{ ucfirst($visitor['device']) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-700">{{ $visitor['time'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-6 text-center text-gray-500">Tidak ada data pengunjung</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="#" class="text-[#FF6000] text-xs font-medium hover:text-[#E65100] inline-block transition-colors duration-200">
                            Lihat semua riwayat pengunjung
                        </a>
                    </div>
                </div>
            </div>
        
            <!-- Right Side (1/3 width on large screens) -->
            <div class="space-y-6">
                <!-- Top Pages -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Halaman Terpopuler</h2>
                    
                    <div class="space-y-4">
                        @forelse($topPages ?? [] as $page)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $page['url'] }}</p>
                                <p class="text-xs text-gray-500">{{ $page['name'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ number_format($page['views']) }}</p>
                                <p class="text-xs text-gray-500">views</p>
                            </div>
                        </div>
                        @empty
                        <div class="py-4 text-center text-gray-500">
                            Tidak ada data halaman populer
                        </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                        <a href="#" class="text-[#FF6000] text-sm font-medium hover:text-[#E65100] inline-block transition-colors duration-200">
                            Lihat semua halaman
                        </a>
                    </div>
                </div>
                
                <!-- Traffic Sources -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Sumber Traffic</h2>
                    
                    @forelse($trafficSources ?? [] as $source)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-600">{{ $source['name'] }}</span>
                            <span class="text-sm font-medium text-gray-600">{{ $source['percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-{{ $source['name'] == 'Organic Search' ? '[#FF9800]' : ($source['name'] == 'Direct' ? '[#FF6000]' : ($source['name'] == 'Referral' ? '[#4CAF50]' : '[#FFB300]')) }} h-2 rounded-full" style="width: {{ $source['percentage'] }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="py-4 text-center text-gray-500">
                        Tidak ada data sumber traffic
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Second row -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Status Sistem -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Status Sistem</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-800">Website</span>
                        </div>
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full">Aktif</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-800">Server Database</span>
                        </div>
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full">Aktif</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-800">Cache System</span>
                        </div>
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full">Aktif</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg border border-yellow-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-800">Queue Worker</span>
                        </div>
                        <span class="text-xs font-medium text-yellow-700 bg-yellow-100 px-2 py-1 rounded-full">Perlu Pemeliharaan</span>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Pengunjung -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Statistik Pengunjung</h2>
                
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-center">
                        <div class="text-sm text-gray-500 mb-1">Pengunjung Hari Ini</div>
                        <div class="text-xl font-bold text-gray-800">{{ number_format($todaysVisitors ?? 0) }}</div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-center">
                        <div class="text-sm text-gray-500 mb-1">Pengunjung Baru</div>
                        <div class="text-xl font-bold text-gray-800">{{ number_format($newVisitors ?? 0) }}</div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-center">
                        <div class="text-sm text-gray-500 mb-1">Pengunjung Kembali</div>
                        <div class="text-xl font-bold text-gray-800">{{ number_format($returningVisitors ?? 0) }}</div>
                    </div>
                </div>
                
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Distribusi Perangkat</h3>
                <div class="mb-6">
                    <div class="flex justify-between mb-1">
                        <span class="text-xs text-gray-600">Mobile</span>
                        <span class="text-xs text-gray-600">{{ ($deviceDistribution['mobile'] ?? 0) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-[#FF6000] h-2 rounded-full" style="width: {{ ($deviceDistribution['mobile'] ?? 0) }}%"></div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex justify-between mb-1">
                        <span class="text-xs text-gray-600">Desktop</span>
                        <span class="text-xs text-gray-600">{{ ($deviceDistribution['desktop'] ?? 0) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-[#4CAF50] h-2 rounded-full" style="width: {{ ($deviceDistribution['desktop'] ?? 0) }}%"></div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex justify-between mb-1">
                        <span class="text-xs text-gray-600">Tablet</span>
                        <span class="text-xs text-gray-600">{{ ($deviceDistribution['tablet'] ?? 0) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-[#FFB300] h-2 rounded-full" style="width: {{ ($deviceDistribution['tablet'] ?? 0) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Section -->
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Notifikasi Terbaru</h2>
                    <span class="px-2 py-1 text-xs bg-[#FFF0E6] text-[#FF6000] rounded-full">{{ $unreadNotifications ?? 0 }} belum dibaca</span>
                </div>
                
                @php
                try {
                    $notifications = \App\Models\Notification::latest()->take(5)->get();
                } catch (\Exception $e) {
                    // Buat mock data jika tabel tidak ada
                    $notifications = collect([
                        (object)[
                            'id' => 1,
                            'title' => 'Pengiriman Baru',
                            'message' => 'Pesanan #12345 telah dibuat',
                            'type' => 'info',
                            'icon' => 'fas fa-shipping-fast',
                            'read_at' => null,
                            'created_at' => now()->subMinutes(5)
                        ],
                        (object)[
                            'id' => 2,
                            'title' => 'Pelanggan Baru',
                            'message' => 'John Doe baru saja mendaftar',
                            'type' => 'success',
                            'icon' => 'fas fa-user',
                            'read_at' => now(),
                            'created_at' => now()->subMinutes(30)
                        ]
                    ]);
                }
                @endphp
                
                <div class="space-y-4">
                    @if($notifications->count() > 0)
                        @foreach($notifications as $notification)
                        <div class="flex items-start p-3 {{ $notification->read_at === null ? 'bg-[#FFF8F4]' : 'bg-white' }} rounded-lg border border-gray-100">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-10 h-10 rounded-full bg-[#FFF0E6] flex items-center justify-center text-[#FF6000]">
                                    <i class="fas fa-{{ isset($notification->type) ? ($notification->type === 'success' ? 'check-circle' : ($notification->type === 'warning' ? 'exclamation-triangle' : 'info-circle')) : 'info-circle' }}"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="text-sm font-medium text-gray-800">{{ $notification->title }}</h4>
                                    <span class="text-xs text-gray-500">{{ $notification->created_at instanceof \Carbon\Carbon ? $notification->created_at->diffForHumans() : '5 menit yang lalu' }}</span>
                                </div>
                                <p class="text-xs text-gray-600">{{ $notification->message }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <p>Belum ada notifikasi</p>
                        </div>
                    @endif
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                    <a href="{{ route('admin.notifications') }}" class="text-[#FF6000] text-sm font-medium hover:text-[#E65100] inline-block transition-colors duration-200">
                        Lihat semua notifikasi
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Setup the traffic chart if the canvas element exists
        const ctx = document.getElementById('trafficChart');
        if (ctx) {
            // Default data jika tidak ada data dari server
            const defaultChartData = {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [
                    {
                        label: 'Direct',
                        data: [150, 180, 160, 220, 240, 190, 230],
                        borderColor: '#FF6000',
                        backgroundColor: 'rgba(255, 96, 0, 0.1)',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Organic',
                        data: [100, 120, 140, 130, 160, 150, 170],
                        borderColor: '#FF9800',
                        backgroundColor: 'rgba(255, 152, 0, 0.1)',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Referral',
                        data: [50, 60, 70, 80, 90, 100, 110],
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Social',
                        data: [30, 40, 35, 50, 60, 55, 70],
                        borderColor: '#FFB300',
                        backgroundColor: 'rgba(255, 179, 0, 0.1)',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3
                    }
                ]
            };
            
            // Gunakan data dari server atau data default
            let chartData;
            
            @if(isset($trafficChartData))
                chartData = @json($trafficChartData);
            @else
                chartData = defaultChartData;
            @endif
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: chartData.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#333',
                            bodyColor: '#666',
                            borderColor: '#e2e8f0',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            bodyFont: {
                                size: 13
                            },
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280'
                            }
                        },
                        y: {
                            grid: {
                                borderDash: [2, 4],
                                color: '#e5e7eb'
                            },
                            ticks: {
                                color: '#6b7280'
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }
    });
</script>
@endpush