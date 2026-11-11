<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HotelCitiesExport;
use App\Models\CityResult;

class ExportCityResults extends Command
{
    protected $signature = 'export:city-results';
    protected $description = 'Export all city results to an Excel file';

    public function handle()
    {
        $results = CityResult::all(['cityName', 'data']);
        $fileName = 'Hotel_Cities_' . now()->format('Y_m_d_His') . '.xlsx';
        Excel::store(new HotelCitiesExport($results), $fileName, 'public');
        $this->info("Export completed: $fileName");
    }
}
