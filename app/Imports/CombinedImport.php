<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CombinedImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // $rows is a collection of data from your Excel file
        // You can process it as needed, such as inserting into the database

        // foreach ($rows as $row) {
        //     // Example: Insert data into the database using Eloquent models
        //     Registration::create([
        //         // 'id' => $row[0],
        //         'registration_id' => $row[1],
        //         'transaction_amount' => $row[2],
        //         'tansaction_date' => $row[3],
        //         'is_active' => $row[4],
        //     ]);

        // }
        return null;
    }
}
