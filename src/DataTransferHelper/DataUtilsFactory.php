<?php declare(strict_types=1);

namespace App\DataTransferHelper;

class DataUtilsFactory
{
    public static function create()
    {
        return new DataUtils();
    }
}
