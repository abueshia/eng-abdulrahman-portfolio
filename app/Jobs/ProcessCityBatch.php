<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\CityResult;

class ProcessCityBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $keywords;

    public function __construct(array $keywords)
    {
        $this->keywords = $keywords;
    }

    public function handle()
    {
        $url = 'https://adminapi-go.amadeusonlinesuite.com/api/Hotel/GetHotelCities';
        $headers = [
            'accept' => 'application/json, text/plain, */*',
            'content-type' => 'application/json; charset=UTF-8',
            'origin' => 'https://www.flyaram.com',
            'referer' => 'https://www.flyaram.com/',
            'token' => 'UtbRto+/S8i3bZ/bRR0TGsBr6A7oUEKV/G294tfRtjGtljxZCmEAXDhyZNxTBylLIVfhf5GRtVTLoaqA+7yK/KQ350fTSiP4Dfm/b9YgTu+D11Xg8FvdUPBkjlq5gkp6rugdkWMHCnCV2M7XasSSg6CJ9d3sI50BZfVQrifQu4dXTny+MApAM4GqBDL8JsAkbfo5JKLy3xkMYvOYh3BF21rJpPXAHtuAzbs4ivr/ny0sYuITEJBTEpstF9fGkxnaIkt9loh1huAb8EUrXTUHbpbcOT5OXbf2dZ982/HrLM47gu23WomFVkUkd1/+psbh5COG4P8Rn2mLayhrNNE+MF8vlIeAmbYGseTgxh0f94SZpEgYM9PAB5kuLamOuDhyR/bWgdTknc1DdMPsVRH6xAt8FCZXzY5y5OsFu0UzSrbL+L7nFsafJh7+TYDQEkRdXD3gbJQ80+stF6HBUKhofJKOC5BK/1Rr4GycE5sv4Nszfyal0HDet6YFFq/aSL77/gJOpt1YVNFhAJ71RObFZRqTiF9dEWTIZPr+HfbCtO7q//oWjpPoMtpvSL6Xh58Mj7jINJNUJmAZujx7eEsWoPXHauM+S8OwSV12c9Rq3i8LErUDVSVdSb5McelM1o8tu3zmskBrtzFw1MFj4GGRxh0BOk3OeP5o5EaOBA71Rcg=',
        ];

        foreach ($this->keywords as $keyword) {
            $data = [
                'cityName' => $keyword,
                'languageCode' => 'en',
                'lattitude' => '30.0588',
                'longitude' => '31.2268',
            ];

            $response = Http::withHeaders($headers)->post($url, $data);

            if ($response->successful()) {
                // Save each successful result to the CityResult table
                $cityResultData = [
                    'cityName' => 'abc',
                    'data' => json_encode($response->json()), // Convert array to JSON
                    'updated_at' => now(),
                    'created_at' => now(),
                ];

                CityResult::create($cityResultData);
            }
        }
    }
}


