<?php

if (!function_exists('make_token')) {
    function make_token($count): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $count; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}

if (!function_exists('randomNumbers')) {
    function randomNumbers($count): string
    {
        $numbers = '123456789';

        $randomNumbers = '';

        for ($i = 0; $i < $count; $i++) {
            $index = rand(0, strlen($numbers) - 1);
            $randomNumbers .= $numbers[$index];
        }

        return $randomNumbers;
    }
}

if (!function_exists('is_dir_empty')) {
    function is_dir_empty($dir): ?bool
    {
        if (!is_readable($dir)) return null;
        return (count(scandir($dir)) == 2);
    }
}

if (!function_exists('my_filter')) {
    function my_filter($values): array
    {
        return array_filter($values, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
    }
}
