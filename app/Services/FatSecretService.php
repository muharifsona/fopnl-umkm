<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FatSecretService
{
    protected $clientId;
    protected $clientSecret;
    protected $tokenUrl = 'https://oauth.fatsecret.com/connect/token';
    protected $apiUrl = 'https://platform.fatsecret.com/rest/server.api';

    public function __construct()
    {
        $this->clientId = config('services.fatsecret.client_id') ?? env('FATSECRET_CLIENT_ID');
        $this->clientSecret = config('services.fatsecret.client_secret') ?? env('FATSECRET_CLIENT_SECRET');
    }

    /**
     * Mendapatkan Access Token dari FatSecret
     */
    protected function getAccessToken()
    {
        $token = Cache::get('fatsecret_access_token');
        if ($token) return $token;

        return Cache::remember('fatsecret_access_token', 80000, function () {
            $response = Http::withoutVerifying() // Bypass SSL lokal
                ->asForm()
                ->withBasicAuth($this->clientId, $this->clientSecret)
                ->post($this->tokenUrl, [
                    'grant_type' => 'client_credentials',
                    'scope' => 'basic',
                ]);

            if ($response->successful()) {
                return $response->json()['access_token'];
            }

            dump('GAGAL MENDAPATKAN TOKEN: ' . $response->body());
            \Log::error('FatSecret Token Error: ' . $response->body());
            return null;
        });
    }

    /**
     * Mencari bahan berdasarkan kata kunci
     */
    public function searchIngredients($query)
    {
        $token = $this->getAccessToken();

        if (!$token || empty($query)) {
            dump('GAGAL: Token tidak ditemukan atau query kosong.');
            return [];
        }

        $response = Http::withoutVerifying() // Bypass SSL lokal
            ->withToken($token)
            ->asForm() // WAJIB untuk FatSecret API
            ->post($this->apiUrl, [
            'method' => 'foods.search',
            'search_expression' => $query,
            'format' => 'json',
            'max_results' => 10 // Batasi jumlah hasil agar tidak berat
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Cek jika FatSecret mengembalikan error di dalam JSON (meskipun HTTP 200 OK)
            if (isset($data['error'])) {
                dump('FATSECRET API ERROR: ', $data['error']);
                return [];
            }

            $foods = $data['foods']['food'] ?? [];

            // FatSecret terkadang mengembalikan satu objek (bukan array) jika hasil hanya 1
            if (!empty($foods) && isset($foods['food_id'])) {
                return [$foods];
            }

            return $foods;
        }

        dump('HTTP REQUEST ERROR: ' . $response->body());
        \Log::error('FatSecret Search Error: ' . $response->body());
        return [];
    }

    /**
     * Mengambil detail lengkap makanan (termasuk lemak jenuh, gula, natrium)
     */
    public function getFoodDetails($foodId)
    {
        $token = $this->getAccessToken();

        if (!$token || empty($foodId)) {
            return null;
        }

        $response = Http::withoutVerifying()
            ->withToken($token)
            ->asForm()
            ->post($this->apiUrl, [
                'method' => 'food.get.v2',
                'food_id' => $foodId,
                'format' => 'json',
            ]);

        if ($response->successful()) {
            return $response->json()['food'] ?? null;
        }

        return null;
    }
}
