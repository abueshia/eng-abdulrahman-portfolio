<?php

namespace App\Imports;

use App\Models\HotelCity;
use Maatwebsite\Excel\Concerns\ToModel;

class HotelCitiesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
//        dd($row);
        if ($row[0] != 'id') {
            return new HotelCity([
                'id' => $row[0],
                'code' => $row[1],
                'name' => $row[2],
                'display_name' => $row[3],
                'country_code' => $row[4],
                'country_name' => $row[5]

            ]);
        }

    }
}
