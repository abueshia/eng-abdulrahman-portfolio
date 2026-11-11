<?php

namespace App\Jobs;

use App\Models\Airport;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchJsonData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $keywords;

    public function __construct(array $keywords)
    {
        $this->keywords = $keywords;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();

        foreach ($this->keywords as $keyword) {
            // Request in English
            $enUrl = "https://adminapi-go.amadeusonlinesuite.com/api//Airport/GetList/en/{$keyword}";
            $arUrl = "https://adminapi-go.amadeusonlinesuite.com/api//Airport/GetList/ar/{$keyword}";

            // Fetch English data
            $enResponse = $client->get($enUrl);
            $enData = json_decode($enResponse->getBody(), true);

            // Fetch Arabic data
            $arResponse = $client->get($arUrl);
            $arData = json_decode($arResponse->getBody(), true);

            // Check if the response is not empty
            if (!empty($enData) && !empty($arData)) {
                // Combine the data from both responses
                foreach ($enData as $key => $enItem) {
                    // Find the corresponding Arabic item using the index
                    $arItem = $arData[$key] ?? null;

                    // Prepare data for storage
                    $name = [
                        'en' => $enItem['an'],
                        'ar' => $arItem['an'],
                    ];
                    $country_name = [
                        'en' => $enItem['cn'],
                        'ar' => $arItem['cn'],
                    ];
                    $city_name = [
                        'en' => $enItem['ct'],
                        'ar' => $arItem['ct'],
                    ];
                    $data = [
                        'air_id' => $enItem['id'],
                        'air_code' => $enItem['ac'],
                        'name' => $name,
                        'city_code' => $enItem['cc'],
                        'country_name' => $country_name,
                        'city_name' => $city_name,
                    ];

                    // Check if the record already exists
                    if (!Airport::where('air_id', $enItem['id'])->exists()) {
                        // Save to your model if it doesn't exist
                        Airport::create($data);
                    }
                }
            }
        }
    }
}
