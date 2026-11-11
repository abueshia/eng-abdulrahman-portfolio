<?php

use App\Models\Block;
use App\Models\Document;
use App\Models\Order;
use App\Models\ProgrammeWish;
use App\Models\Project;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wish;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;




function convertTags($tags) {
    $tags = explode(',' , $tags);
    return $tags;
}

function getHotelFeaturedCities() {
    $json = json_decode("[
  {
    \"id\": \"76\",
    \"code\": \"211918\",
    \"name\": \"Riyadh\",
    \"display_name\": \"Riyadh, Saudi Arabia\",
    \"country_name\": \"Saudi Arabia\",
    \"country_code\": \"SA\"
  },
  {
    \"id\": \"807\",
    \"code\": \"212101\",
    \"name\": \"Dubai\",
    \"display_name\": \"Dubai, United Arab Emirates\",
    \"country_name\": \"United Arab Emirates\",
    \"country_code\": \"AE\"
  },
  {
    \"id\": \"414\",
    \"code\": \"322239\",
    \"name\": \"Bangkok\",
    \"display_name\": \"Bangkok, Thailand\",
    \"country_name\": \"Thailand\",
    \"country_code\": \"TH\"
  },
  {
    \"id\": \"6\",
    \"code\": \"540025\",
    \"name\": \"London\",
    \"display_name\": \"London, United Kingdom\",
    \"country_name\": \"United Kingdom\",
    \"country_code\": \"GB\"
  },
  {
    \"id\": \"650\",
    \"code\": \"607049\",
    \"name\": \"Paris\",
    \"display_name\": \"Paris, France\",
    \"country_name\": \"France\",
    \"country_code\": \"FR\"
  }
]");
    return $json;
}

function getNationalities() {
        return [
            'SA' => \App\Helpers\TranslationHelper::translate('Saudi Arabia'),
            'KW' => \App\Helpers\TranslationHelper::translate('Kuwait'),
            'BH' => \App\Helpers\TranslationHelper::translate('Bahrain'),
            'OM' => \App\Helpers\TranslationHelper::translate('Oman'),
            'QA' => \App\Helpers\TranslationHelper::translate('Qatar'),
            'EG' => \App\Helpers\TranslationHelper::translate('Egypt'),
            'MA' => \App\Helpers\TranslationHelper::translate('Morocco'),
            'NG' => \App\Helpers\TranslationHelper::translate('Nigeria'),
            'TN' => \App\Helpers\TranslationHelper::translate('Tunisia'),
            'AE' => \App\Helpers\TranslationHelper::translate('United Arab Emirates'),
        ];

}
//SA

function getFeaturedCityCodes() {
    return [
        "AE",
        "EG",
        "AE",
        "GB",
        "NG",
        "US",
        "FR",
        "SA"
    ];
}
function getFeaturedAirCodes() {
    return [
        "AUH",
        "CAI",
        "DXB",
        "RUH",
        "LOS",
        "LON",
        "PAR",
        "NYC"
    ];
}

function getFeaturedAirMasters() {
    $json = json_decode("{
        \"AUH\": {
        \"ac\": \"AUH\",
        \"an\": \"Abu Dhabi International Airport\",
        \"cc\": \"AE\",
        \"cn\": \"United Arab Emirates\",
        \"ct\": \"Abu Dhabi\",
        \"pr\": 0
    },
    \"CAI\": {
        \"ac\": \"CAI\",
        \"an\": \"Cairo International Airport\",
        \"cc\": \"EG\",
        \"cn\": \"Egypt\",
        \"ct\": \"Cairo\",
        \"pr\": 0
    },
    \"DXB\": {
        \"ac\": \"DXB\",
        \"an\": \"Dubai International Airport\",
        \"cc\": \"AE\",
        \"cn\": \"United Arab Emirates\",
        \"ct\": \"Dubai\",
        \"pr\": 0
    },
    \"LON\": {
        \"ac\": \"LON\",
        \"an\": \"London All Airports\",
        \"cc\": \"GB\",
        \"cn\": \"United Kingdom\",
        \"ct\": \"London\",
        \"pr\": 0
    },
    \"LOS\": {
        \"ac\": \"LOS\",
        \"an\": \"Murtala Muhammed International Airport\",
        \"cc\": \"NG\",
        \"cn\": \"Nigeria\",
        \"ct\": \"Lagos\",
        \"pr\": 0
    },
    \"NYC\": {
        \"ac\": \"NYC\",
        \"an\": \"All airports\",
        \"cc\": \"US\",
        \"cn\": \"United States Of America\",
        \"ct\": \"New York\",
        \"pr\": 0
    },
    \"PAR\": {
        \"ac\": \"PAR\",
        \"an\": \"All Airports\",
        \"cc\": \"FR\",
        \"cn\": \"France\",
        \"ct\": \"Paris\",
        \"pr\": 0
    },
    \"RUH\": {
        \"ac\": \"RUH\",
        \"an\": \"King Khalid International Airport\",
        \"cc\": \"SA\",
        \"cn\": \"Saudi Arabia\",
        \"ct\": \"Riyadh\",
        \"pr\": 0
    }
}");
    return $json;
}

function TransformText ($text) {
    if (strpos($text, '_')) {
        $text = str_replace('_', ' ', $text);
        $text = ucfirst($text);
    }
    return $text;
}

function getDaysBetweenDates($start, $end)
{
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $interval = new DateInterval('P1D'); // 1 day interval

    $dateRange = new DatePeriod($startDate, $interval, $endDate);

    $days = array();
    foreach ($dateRange as $date) {
        $days[] = $date->format('Y-m-d');
    }

    return $days;
}


function getProgrammePriceIfDiscountInNumbers($programme)
{
    if ($programme->discount_type == 'percent') {
        return $programme->price - (($programme->discount / 100) * $programme->price);
    } else {
        return $programme->price - $programme->discount;
    }
}


function getProgrammeDiscountInNumbers($programme)
{
    if ($programme->discount_type == 'percent') {
        return (($programme->discount / 100) * $programme->price);
    } else {
        return $programme->discount;
    }
}

function getRoomDiscountInNumbers($room)
{
    if ($room->discount_type == 'percent') {
        return (($room->discount / 100) * $room->price);
    } else {
        return $room->discount;
    }
}

function checkProgrammeWish($id)
{
    if (auth()->check()) {
        $check = ProgrammeWish::where('programme_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($check) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 1;
    }
}

// function getProgrammePriceIfDiscount($programme)
// {
//     if ($programme->discount_type == 'percent') {
//         return 'SAR ' . number_format(($programme->price - (($programme->discount / 100) * $programme->price)), 1);
//     } else {
//         return 'SAR ' . number_format(($programme->price - $programme->discount), 1);
//     }
// }

// function getProgrammePriceIfDiscount($programme)
// {
//     $currency = app()->getLocale() === 'ar' ? 'ريال' : 'SAR';
//     $discounted_price = 0;

//     if ($programme->discount_type == 'percent') {
//         $discounted_price = $programme->price - (($programme->discount / 100) * $programme->price);
//     } else {
//         $discounted_price = $programme->price - $programme->discount;
//     }
//     return $currency . ' ' . number_format($discounted_price, 1);
// }

function getProgrammePriceIfDiscount($programme)
{
    $discounted_price = 0;

    if ($programme->discount_type == 'percent') {
        $discounted_price = $programme->price - (($programme->discount / 100) * $programme->price);
    } else {
        $discounted_price = $programme->price - $programme->discount;
    }

    return number_format($discounted_price, 1);
}

function customizeSingleName($name)
{
    $name = str_replace('أ', 'ا', $name);
    $name = str_replace('آ', 'ا', $name);
    $name = str_replace('إ', 'ا', $name);
    $name = str_replace('اّ', 'ا', $name);
    $name = str_replace('ة', 'ه', $name);

    return $name;
}

if (!function_exists('setting')) {

    function setting($value, $lang = null)
    {
        // section_three_title // en - ar
        $lang = $lang == null ? app()->getLocale() : $lang;
        $settings = Cache::get('settings') == null ?
            Cache::rememberForever('settings', function () {
                return Setting::get();
            })
            : Cache::get('settings');

        if ($settings != null) {
            foreach ($settings as $setting) {
                if ($setting->option == $value) {
                    return $setting->getTranslation('value', $lang);
                }
            }
        }
        return '';
    }

}


if (!function_exists('showLink')) {
    function showLink(string $routeName)
    {
        return Route::is("{$routeName}.*") ? 'show' : '';
    }
}


if (!function_exists('activeLink')) {
    function activeLink(string $routeName)
    {
        return Route::is("{$routeName}.*") ? 'here' : '';
    }
}
if (!function_exists('hoverLink')) {
    function hoverLink(string $routeName)
    {
        return Route::is("{$routeName}.*") ? true : false;
    }
}


if (!function_exists('activeSingleLink')) {
    function activeSingleLink(string $routeName)
    {
        return Route::is("{$routeName}") ? 'here' : '';
    }
}


if (!function_exists('getLastKeyRoute')) {
    function getLastKeyRoute(string $routeName)
    {
        $array = explode('.', $routeName);
        return end($array);
    }
}

if (!function_exists('about')) {
    function about()
    {
        return [
            'about' => 'about',
            'home' => 'home',
        ];
    }
}

if (!function_exists('youtubeHandleLink')) {
    function youtubeHandleLink(string $link)
    {
        $array = explode('/', $link);
        $last = end($array);
        return str_replace('watch?v=', '', $last);
    }
}

if (!function_exists('aboutReverseSection')) {
    function aboutReverseSection()
    {
        if (app()->getLocale() == 'ar') {
            return 'style="flex-direction: row !important"';
        } else {
            return 'style="flex-direction: row-reverse !important"';
        }
    }
}
if (!function_exists('aboutReverseSectionTitle')) {
    function aboutReverseSectionTitle()
    {
        if (app()->getLocale() == 'ar') {
            return 'style="text-align:start"';
        } else {
            return 'style="text-align:end"';
        }
    }
}




