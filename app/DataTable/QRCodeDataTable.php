<?php

namespace App\DataTable;

use App\Models\QRCode;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AboutMeDataTable
 */
class QRCodeDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $qrCode = QRCode::toBase();

        return $qrCode;
    }
}
