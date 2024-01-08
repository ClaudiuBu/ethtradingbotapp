<?php

namespace App\Services\Validation;

use App\Models\Blacklist as BlacklistModel;

class TokenValidation
{
    public static function validateToken(array $token): bool
    {
        //check if name is in json
        self::validateName($token);

        return true;
    }



    private static function validateName(array $token): bool
    {
        //alea 3 checkuri daca contine partial daca contine total si daca contine cuvantul
        $blacklist = json_decode(file_get_contents('blacklist_names.json', true));

        //check if word is one on one match
        if (in_array($token['token_name'], $blacklist->blacklist)) {
            BlacklistModel::blacklistToken($token, 'This token name is blacklisted.(Reason: '.$blacklist->blacklist.')');
            return false;
        }

        //check with preg_match if word is partial match
        foreach ($blacklist->blacklist as $word) {
            if (preg_match("/$word/", $token['token_name'])) {
                BlacklistModel::blacklistToken($token, 'This token name is blacklisted.(Reason: '.$blacklist->blacklist.')');
                return false;
            }
        }

        return true;
    }
}
