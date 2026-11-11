<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class HotelCitiesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $uniqueCities = [];

        foreach ($this->data as $row) {
            $citiesData = json_decode($row->data, true);
            if (isset($citiesData['cities'])) {
                foreach ($citiesData['cities'] as $city) {
                    $cityId = $city['city_Id'];
                    if (!isset($uniqueCities[$cityId])) {
                        $uniqueCities[$cityId] = $city; // Store the entire city data for later mapping
                    }
                }
            }
        }

        return new Collection(array_values($uniqueCities)); // Return unique cities as a collection
    }

    public function headings(): array
    {
        return ['id', 'code', 'name', 'display_name', 'country_code', 'country_name'];
    }

    public function map($city): array
    {
        return [
            $city['city_Id'],
            $city['cityCode'],
            $city['cityName'],
            $city['displayName'],
            $city['countryCode'],
            $city['countryName'],
        ];
    }
}
