<?php

namespace App\Helpers;

class NutriScoreHelper
{
    /**
     * Hitung Nutri-Score berdasarkan data gizi per 100g
     */
    public static function calculate($energy_kcal, $sugar_g, $fat_g, $sodium_mg, $protein_g)
    {
        // Skor negatif (semakin besar = kurang sehat)
        $neg = 0;
        $neg += ($energy_kcal > 335) ? 2 : ($energy_kcal > 670 ? 4 : 0);
        $neg += ($sugar_g > 10) ? 2 : ($sugar_g > 22.5 ? 4 : 0);
        $neg += ($fat_g > 3) ? 2 : ($fat_g > 17.5 ? 4 : 0);
        $neg += ($sodium_mg > 300) ? 2 : ($sodium_mg > 600 ? 4 : 0);

        // Skor positif (semakin besar = lebih sehat)
        $pos = 0;
        $pos += ($protein_g > 5) ? 2 : ($protein_g > 10 ? 4 : 0);

        $score = $neg - $pos;

        // Konversi ke Nutri-Score
        if ($score <= 0) return 'A';
        if ($score <= 3) return 'B';
        if ($score <= 10) return 'C';
        if ($score <= 18) return 'D';
        return 'E';
    }

    /**
     * Warna berdasarkan huruf Nutri-Score
     */
    public static function color($score)
    {
        return match ($score) {
            'A' => '#00A300', // Hijau
            'B' => '#7CCD00', // Hijau muda
            'C' => '#FFD700', // Kuning
            'D' => '#FF8C00', // Oranye
            'E' => '#FF0000', // Merah
            default => '#999999',
        };
    }
}
