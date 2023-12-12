<?php
namespace App\Helpers;

use App\Models\CosCumparaturi;

class Helpers
{
    public static function getTotalBileteInCos($user_id)
    {
        return CosCumparaturi::where('user_id', $user_id)->sum('nr_bilete_selectate');
    }
}
