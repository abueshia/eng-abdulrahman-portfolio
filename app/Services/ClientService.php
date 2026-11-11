<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Client;
use Illuminate\Support\Str; // Import Str class
class  ClientService
{

   
    public function createClient($data)
    {
        // التحقق من المفاتيح وتعريف القيم الافتراضية
        $data['region_id'] = $data['region_id'] ?? null;
        $data['city_id'] = $data['city_id'] ?? null;
        $data['country_id'] = $data['country_id'] ?? null;
        $data['points'] = $data['points'] ?? null;

        // إنشاء رمز فريد للعميل
        do {
            // توليد رمز عشوائي مكون من 8 أرقام وحروف
            $clientCode = Str::random(8);
        } while (Client::where('code_for_client', $clientCode)->exists()); // تأكد من أن الرمز غير موجود مسبقًا

        $client = Client::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'card' => $data['card'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'category' => $data['category'],
            'city_id' => $data['city_id'],
            'country_id' => $data['country_id'],
            'region_id' => $data['region_id'],
            'points' => $data['points'],
         'code_for_client' => $clientCode, 
        ]);

        $this->storeFiles($client, $data);
    }



    public function updateClient(Client $client, array $data)
    {
        $password = isset($data['password']) ? bcrypt($data['password']) : $client->password;

        $client->update([
            'name' => $data['name'] ?? $client->name,
            'phone' => $data['phone'] ?? $client->phone,
            'username' => $data['username'] ?? $client->username,
            'password' => $password, // إذا كانت كلمة المرور جديدة، يتم تشفيرها وتحديثها
            'category' => $data['category'] ?? $client->category,
            'city_id' => $data['city_id'] ?? $client->city_id,
            'region_id' => $data['region_id'] ?? $client->region_id,
            'points' => $data['points'] ?? $client->points,
            'country_id' => $data['country_id'] ?? $client->country_id,
        ]);

        $this->updateFiles($client, $data);
    }



    public function deleteClient(Client $client)
    {
        $client->delete();
    }


    private function storeFiles(Client $client, array $data)
    {
        if (isset($data['image'])) {
            $client->storeFile($data['image'], '_image');
        }
     
    }

  
    private function updateFiles(Client $client, array $data)
    {
        if (isset($data['image'])) {
            $client->updateFile($data['image'], '_image');
        }
      
    }


    public function reorder($client, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($client, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $client)
    {
        return ReorderHelper::saveReorder($all_entries, $client);
    }

}
