<?php

namespace App\Services;

use App\Models\Rate;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class BusinessStatsService
{
    /**
     * Cache time in minutes
     */
    protected int $cacheTime = 60; // 1 jam

    /**
     * Mendapatkan statistik tarif populer berdasarkan views
     */
    public function getPopularRates(int $limit = 5): Collection
    {
        return Cache::remember('business_popular_rates', $this->cacheTime, function () use ($limit) {
            return Rate::orderBy('views', 'desc')
                ->take($limit)
                ->get();
        });
    }

    /**
     * Mendapatkan statistik tarif berdasarkan kota
     */
    public function getRatesByCity(): Collection
    {
        return Cache::remember('business_rates_by_city', $this->cacheTime, function () {
            return Rate::select('kota_kab', DB::raw('count(*) as total'))
                ->groupBy('kota_kab')
                ->orderBy('total', 'desc')
                ->take(10)
                ->get();
        });
    }

    /**
     * Mendapatkan statistik tarif berdasarkan provinsi
     */
    public function getRatesByProvince(): Collection
    {
        return Cache::remember('business_rates_by_province', $this->cacheTime, function () {
            return Rate::select('provinsi', DB::raw('count(*) as total'))
                ->groupBy('provinsi')
                ->orderBy('total', 'desc')
                ->take(10)
                ->get();
        });
    }

    /**
     * Mendapatkan statistik tarif berdasarkan pulau
     */
    public function getRatesByIsland(): Collection
    {
        return Cache::remember('business_rates_by_island', $this->cacheTime, function () {
            return Rate::select('pulau', DB::raw('count(*) as total'))
                ->groupBy('pulau')
                ->orderBy('total', 'desc')
                ->get();
        });
    }

    /**
     * Mendapatkan jumlah tarif
     */
    public function getTotalRates(): int
    {
        return Cache::remember('business_total_rates', $this->cacheTime, function () {
            return Rate::count();
        });
    }

    /**
     * Mendapatkan rata-rata harga
     */
    public function getAverageRate(): float
    {
        return Cache::remember('business_average_rate', $this->cacheTime, function () {
            return Rate::avg('harga_satuan') ?? 0;
        });
    }

    /**
     * Mendapatkan statistik pertumbuhan user
     */
    public function getUserGrowthStats(): array
    {
        return Cache::remember('business_user_growth', $this->cacheTime, function () {
            $now = Carbon::now();
            $totalUsers = User::count();
            $newUsersToday = User::whereDate('created_at', $now->toDateString())->count();
            $newUsersThisWeek = User::whereBetween('created_at', [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()])->count();
            $newUsersThisMonth = User::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
            
            // Hitung pertumbuhan
            $lastMonth = $now->copy()->subMonth();
            $usersLastMonth = User::whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)->count();
            $growthRate = $usersLastMonth > 0 ? (($newUsersThisMonth - $usersLastMonth) / $usersLastMonth) * 100 : 0;
            
            return [
                'total' => $totalUsers,
                'today' => $newUsersToday,
                'this_week' => $newUsersThisWeek,
                'this_month' => $newUsersThisMonth,
                'growth_rate' => round($growthRate, 1)
            ];
        });
    }

    /**
     * Mendapatkan notifikasi terbaru
     */
    public function getLatestNotifications(int $limit = 5): Collection
    {
        return Cache::remember('business_latest_notifications', $this->cacheTime, function () use ($limit) {
            return Notification::latest()->take($limit)->get();
        });
    }

    /**
     * Mendapatkan jumlah notifikasi yang belum dibaca
     */
    public function getUnreadNotificationsCount(): int
    {
        return Cache::remember('business_unread_notifications', $this->cacheTime, function () {
            return Notification::whereNull('read_at')->count();
        });
    }

    /**
     * Mendapatkan data untuk chart tarif per pulau
     */
    public function getRatesByIslandChartData(): array
    {
        return Cache::remember('business_rates_by_island_chart', $this->cacheTime, function () {
            $data = $this->getRatesByIsland();
            
            return [
                'labels' => $data->pluck('pulau')->toArray(),
                'datasets' => [
                    [
                        'data' => $data->pluck('total')->toArray(),
                        'backgroundColor' => [
                            '#FF6000',
                            '#FF9800',
                            '#4CAF50',
                            '#FFB300',
                            '#673AB7',
                            '#2196F3',
                            '#E91E63'
                        ]
                    ]
                ]
            ];
        });
    }

    /**
     * Mendapatkan tren tarif popular per hari dalam seminggu terakhir
     */
    public function getPopularRatesTrend(int $days = 7): array
    {
        return Cache::remember('business_popular_rates_trend', $this->cacheTime, function () use ($days) {
            // Simulasi data tren
            $rates = $this->getPopularRates(3);
            $labels = [];
            $datasets = [];
            
            // Buat label hari
            $dateFormat = [
                1 => 'Sen',
                2 => 'Sel',
                3 => 'Rab',
                4 => 'Kam',
                5 => 'Jum',
                6 => 'Sab',
                0 => 'Min'
            ];
            
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $labels[] = $dateFormat[$date->dayOfWeek];
            }
            
            // Simulasikan data view untuk setiap tarif populer
            $colors = ['#FF6000', '#FF9800', '#4CAF50', '#2196F3', '#E91E63', '#673AB7', '#FFB300'];
            
            foreach ($rates as $index => $rate) {
                $baseViews = rand(50, 200);
                $data = [];
                
                for ($i = 0; $i < $days; $i++) {
                    $data[] = $baseViews + rand(-20, 50);
                }
                
                // Periksa apakah indeks tersedia pada array colors dan gunakan color wheel jika melebihi jumlah warna
                $colorIndex = $index % count($colors);
                $color = $colors[$colorIndex];
                
                $datasets[] = [
                    'label' => $rate->kota_kab,
                    'data' => $data,
                    'borderColor' => $color,
                    'backgroundColor' => 'rgba(' . $this->hexToRgb($color) . ', 0.1)',
                    'tension' => 0.4,
                    'borderWidth' => 2,
                    'pointRadius' => 3
                ];
            }
            
            return [
                'labels' => $labels,
                'datasets' => $datasets
            ];
        });
    }

    /**
     * Mengkonversi warna hex ke rgb
     */
    private function hexToRgb($hex): string
    {
        $hex = str_replace('#', '', $hex);
        
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        
        return $r . ',' . $g . ',' . $b;
    }
} 