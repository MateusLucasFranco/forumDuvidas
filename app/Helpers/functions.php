<?php

use App\Enums\SupportStatus;

if(!function_exists('getStatusSupport')) {
    function getStatusSupport(string $status): string {
        return SupportStatus::fromValue($status);
    }
}

if(!function_exists('getInitials')) {
    function getInitials($name) {
        $words = explode(' ', $name);
        $initials = '';

        foreach($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if(strlen($initials) >= 2) {
                break;
            }
        }

        return $initials;
    }
}