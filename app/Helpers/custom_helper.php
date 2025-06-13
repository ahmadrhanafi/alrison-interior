<?php

if (!function_exists('timeAgo')) {
    function timeAgo($time)
    {
        $time = strtotime($time);
        $now = time();
        $diff = $now - $time;

        if ($diff < 60) {
            return $diff . ' detik yang lalu';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' menit yang lalu';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' jam yang lalu';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return $days . ' hari yang lalu';
        } elseif ($diff < 2419200) {
            $weeks = floor($diff / 604800);
            return $weeks . ' minggu yang lalu';
        } else {
            $months = floor($diff / 2419200);
            return $months . ' bulan yang lalu';
        }
    }
}
