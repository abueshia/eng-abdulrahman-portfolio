<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Card;

class  CardService{

    public function createCard($data)
    {
        // dd($data);
        $card = Card::create($data);

        if (isset($data['image'])) {
            $card->storeFile($data['image']);
        }

        if (isset($data['card_video'])) {
            $card->storeFile($data['card_video'], 'card_video');
        }
    }




    public function updateCard($card , $data){
        // dd($data);
        if(isset($data['image'])){
            $card->updateFile($data['image']);
        }

        if (isset($data['card_video'])) {
            $card->storeFile($data['card_video'], 'card_video');
        }
        $card->update($data);
    }



    public function deleteCard($card){
        $card->delete();
    }


   

    public function reorder($card, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($card, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $card)
    {
        return ReorderHelper::saveReorder($all_entries, $card);
    }



}
