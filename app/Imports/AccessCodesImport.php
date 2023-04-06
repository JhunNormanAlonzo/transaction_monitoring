<?php

namespace App\Imports;

use App\Models\AccessCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AccessCodesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AccessCode([
            "load_type_id" => $row['load_type_id'],
            "wallet_transaction_id" => $row['wallet_transaction_id'],
            "voucher_code" => $row['voucher_code'],
            "down_kbps" => $row['down_kbps'],
            "up_kbps" => $row['up_kbps'],
            "quota_bytes" => $row['quota_bytes'],
            "duration_mins" => $row['duration_mins'],
            "loaded_at" => $row['loaded_at'],
            "status" => $row['status'],
            "notes" => $row['notes'],
            "created_user_id" => $row['created_user_id'],
            "loaded_user_id" => $row['loaded_user_id'],
        ]);
    }
}
