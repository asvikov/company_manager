<?php

namespace App\Services;

class PortrayPhoneService {

    public static function portrayForView($phone) {

        $phone = (string)$phone;
        $changed_phone = '';

        if(strlen($phone)) {

            $phone_ar = str_split($phone);
            $changed_phone .= '+';
            $i = 0;

            foreach ($phone_ar as $ch) {
                if($i == 1 || $i == 4 || $i == 7 || $i == 9) {
                    $changed_phone .= ' ';
                }
                $changed_phone .= $ch;
                $i++;
            }
        }
        return $changed_phone;
    }

    public static function portrayForDB($phone) {

        $phone_db = preg_replace('/[^0-9]/', '', $phone);
        if(strlen($phone_db) < 3) {
            return null;
        }
        return (int) $phone_db;
    }
}
