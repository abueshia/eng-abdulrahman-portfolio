<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AboutSettingRequest;
use App\Http\Requests\Admin\Setting\aboutUsClientsSayRequest;
use App\Http\Requests\Admin\Setting\aboutUsInformationRequest;
use App\Http\Requests\Admin\Setting\aboutUsPopularDestinationsRequest;
use App\Http\Requests\Admin\Setting\AboutUsRequest;
use App\Http\Requests\Admin\Setting\aboutUsSubscribetoGetRequest;
use App\Http\Requests\Admin\Setting\AddUnitRequest;
use App\Http\Requests\Admin\Setting\AppSettingPageRequest;
use App\Http\Requests\Admin\Setting\BestOffersRequest;
use App\Http\Requests\Admin\Setting\BottomBannerRequest;
use App\Http\Requests\Admin\Setting\ContactPageRequest;
use App\Http\Requests\Admin\Setting\EcontractRequest;
use App\Http\Requests\Admin\Setting\FindBestPlacesIndexRequest;
use App\Http\Requests\Admin\Setting\HomecouronnesettingRequest;
use App\Http\Requests\Admin\Setting\HomePageRequest;
use App\Http\Requests\Admin\Setting\homeSliderSettingPageRequest;
use App\Http\Requests\Admin\Setting\JoinUsPageRequest;
use App\Http\Requests\Admin\Setting\MainSettingPageRequest;
use App\Http\Requests\Admin\Setting\OurcardssettingRequest;
use App\Http\Requests\Admin\Setting\PrivacyPolicyRequest;
use App\Http\Requests\Admin\Setting\ServiceBannerRequest;
use App\Http\Requests\Admin\Setting\ServicePolicyRequest;
use App\Http\Requests\Admin\Setting\settingBlogDetailsGetUpdateRequest;
use App\Http\Requests\Admin\Setting\settingIndexRequest;
use App\Http\Requests\Admin\Setting\SettingInfomationRequest;
use App\Http\Requests\Admin\Setting\SettingnewsRequest;
use App\Http\Requests\Admin\Setting\ShomosRequest;
use App\Http\Requests\Admin\Setting\SocialPageRequest;
use App\Http\Requests\Admin\Setting\TaxSettingPageRequest;
use App\Http\Requests\Admin\Setting\TripBestsellerRequest;
use App\Http\Requests\Admin\Setting\TripTitleAdImageRequest;
use App\Http\Requests\Admin\Setting\UseTermsRequest;
use App\Http\Requests\Admin\Setting\WhyChooseIndexRequest;
use App\Http\Requests\Admin\Setting\WhyChoosePageRequest;
use App\Http\Requests\Admin\Setting\YourGatewayToAmazingIndexRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:all_settings.view_all', ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:all_settings.view_all'], ['only' => ['index']]);

        // $this->middleware('permission:about_us.edit', ['only' => ['aboutUsSettingEdit', 'aboutUsSettingUpdate']]);

        $this->middleware(['auth:admin', 'permission:mainSetting.view_details'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:mainSetting.edit'], ['only' => ['edit']]);

        $this->middleware(['auth:admin', 'permission:aboutUsSetting.view_details'], ['only' => ['AboutShowSetting']]);
        $this->middleware(['auth:admin', 'permission:aboutUsSetting.edit'], ['only' =>['aboutUsSettingEdit', 'aboutUsSettingUpdate']]);


        $this->middleware(['auth:admin', 'permission:aboutUs_ClientsSaySetting.view_details'], ['only' => ['aboutUs_ClientsSayShowSetting']]);
        $this->middleware(['auth:admin', 'permission:aboutUs_ClientsSaySetting.edit'], ['only' => ['aboutUs_ClientsSayEdit', 'aboutUs_ClientsSayUpdate']]);

        $this->middleware(['auth:admin', 'permission:aboutUs_Popular_DestinationsSetting.view_details'], ['only' => ['aboutUs_Popular_DestinationsShowSetting']]);
        $this->middleware(['auth:admin', 'permission:aboutUs_Popular_DestinationsSetting.edit'], ['only' => ['aboutUs_Popular_DestinationsEdit', 'aboutUs_Popular_DestinationsUpdate']]);


        $this->middleware(['auth:admin', 'permission:aboutUs_Subscribeto_getSetting.view_details'], ['only' => ['aboutUs_Subscribeto_getShowSetting']]);
        $this->middleware(['auth:admin', 'permission:aboutUs_Subscribeto_getSetting.edit'], ['only' => ['aboutUs_Subscribeto_getEdit', 'aboutUs_Subscribeto_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:aboutUs_information.view_details'], ['only' => ['aboutUs_information']]);
        $this->middleware(['auth:admin', 'permission:aboutUs_information.edit'], ['only' => ['aboutUs_information_getEdit', 'aboutUs_information_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:setting_blog_details.view_details'], ['only' => ['setting_blog_details']]);
        $this->middleware(['auth:admin', 'permission:setting_blog_details.edit'], ['only' => ['setting_blog_details_getEdit', 'setting_blog_details_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:setting_index.view_details'], ['only' => ['setting_index']]);
        $this->middleware(['auth:admin', 'permission:setting_index.edit'], ['only' => ['setting_index_getEdit', 'setting_index_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:Why_Choose_index.view_details'], ['only' => ['Why_Choose_index']]);
        $this->middleware(['auth:admin', 'permission:Why_Choose_index.edit'], ['only' => ['Why_Choose_index_getEdit', 'Why_Choose_index_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:Find_best_places_index.view_details'], ['only' => ['Find_best_places_index']]);
        $this->middleware(['auth:admin', 'permission:Find_best_places_index.edit'], ['only' => ['Find_best_places_index_getEdit', 'Find_best_places_index_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:Your_gateway_to_amazing_index.view_details'], ['only' => ['Your_gateway_to_amazing_index']]);
        $this->middleware(['auth:admin', 'permission:Your_gateway_to_amazing_index.edit'], ['only' => ['Your_gateway_to_amazing_index_getEdit', 'Your_gateway_to_amazing_index_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:trip_bestseller_index.view_details'], ['only' => ['trip_bestseller_index']]);
        $this->middleware(['auth:admin', 'permission:trip_bestseller_index.edit'], ['only' => ['trip_bestseller_getEdit', 'trip_bestseller_getUpdate']]);


        $this->middleware(['auth:admin', 'permission:trip_title_ad_image_index.view_details'], ['only' => ['trip_title_ad_image_index']]);
        $this->middleware(['auth:admin', 'permission:trip_title_ad_image_index.edit'], ['only' => ['trip_title_ad_image_getEdit', 'trip_title_ad_image_getUpdate']]);

        $this->middleware(['auth:admin', 'permission:setting_infomation_index.view_details'], ['only' => ['setting_infomation_index']]);
        $this->middleware(['auth:admin', 'permission:setting_infomation_index.edit'], ['only' => ['setting_infomation_getEdit', 'setting_infomation_getUpdate']]);

        $this->middleware(['auth:admin', 'permission:newsSetting.view_details'], ['only' => ['newsSetting']]);
        $this->middleware(['auth:admin', 'permission:newsSetting.edit'], ['only' => ['newsSettingEdit', 'newsSettingUpdate']]);

         $this->middleware(['auth:admin', 'permission:home_couronne_setting.view_details'], ['only' => ['homecouronneSetting']]);
        $this->middleware(['auth:admin', 'permission:home_couronne_setting.edit'], ['only' => ['homecouronneSettingEdit', 'homecouronneSettingUpdate']]);

        
        $this->middleware(['auth:admin', 'permission:ourcardssetting.view_details'], ['only' => ['ourcardssetting']]);
        $this->middleware(['auth:admin', 'permission:ourcardssetting.edit'], ['only' => ['ourcardssettingEdit', 'ourcardssettingUpdate']]);
    }

    public function all_settings() {
        return view('admin.pages.setting.index');
    }

    /**
     * Start Main Setting Setting
     */
    public function mainSetting()
    {
        return view('admin.pages.setting.main.show');
    }

    public function mainSettingEdit()
    {
        return view('admin.pages.setting.main.edit');
    }

    public function mainSettingUpdate(MainSettingPageRequest $request)
    {
        
//        return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->logo) {
            $this->addStaticImage($request->logo, 'logo');
        }

        if ($request->hasFile('video')) {
            // dd ($request->file('video'));
            $file = $request->file('video'); // الحصول على الملف
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $this->addStaticImage($file, 'video'); // تمرير الملف إلى الدالة
            }
        }

        if ($request->hasFile('image.en')) {
       $this->addStaticImage($request->file('image.en'), 'image');
}

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }
    /**
     * End Main Setting Setting
     */

    //***************************** */  about_setting  // ********************

    public function aboutUsSetting()
    {
        return view('admin.pages.setting.index');
    }

    /**
     * Start Main Setting Setting
     */
    public function AboutShowSetting()
    {
        return view('admin.pages.setting.aboutUs.show');
    }


    public function aboutUsSettingEdit()
    {
        return view('admin.pages.setting.aboutUs.edit');
    }

    public function aboutUsSettingUpdate(AboutSettingRequest $request)
    {
//
            //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        // if ($request->logo) {
        //     $this->addStaticImage($request->logo, 'logo');
        // }
        if ($request->section_one_image_one) {
            $this->addStaticImage($request->section_one_image_one, 'section_one_image_one');
        }
        if ($request->section_one_image_two) {
            $this->addStaticImage($request->section_one_image_two, 'section_one_image_two');
        }
        if ($request->section_tow_image) {
            $this->addStaticImage($request->section_tow_image, 'section_tow_image');
        }
        

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }

    // ********************aboutUs_ClientsSay****************************

    public function aboutUs_ClientsSaySetting()
    {
        return view('admin.pages.setting.index');
    }

    /**
     * Start Main Setting Setting
     */
    public function aboutUs_ClientsSayShowSetting()
    {
        return view('admin.pages.setting.aboutUs_ClientsSay.show');
    }


    public function aboutUs_ClientsSayEdit()
    {
        return view('admin.pages.setting.aboutUs_ClientsSay.edit');
    }

    public function aboutUs_ClientsSayUpdate(aboutUsClientsSayRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->WhatClient_image) {
            $this->addStaticImage($request->WhatClient_image, 'WhatClient_image');
        }
    

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }
    // **********************************aboutUs_Popular_Destinations*************************************

    public function aboutUs_Popular_DestinationsSetting()
    {
        return view('admin.pages.setting.index');
    }

    /**
     * Start Main Setting Setting
     */
    public function aboutUs_Popular_DestinationsShowSetting()
    {
        return view('admin.pages.setting.aboutUs_Popular_Destinations.show');
    }


    public function aboutUs_Popular_DestinationsEdit()
    {
        return view('admin.pages.setting.aboutUs_Popular_Destinations.edit');
    }

    public function aboutUs_Popular_DestinationsUpdate(aboutUsPopularDestinationsRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        // if ($request->WhatClient_image) {
        //     $this->addStaticImage($request->WhatClient_image, 'WhatClient_image');
        // }

        // star
        if ($request->Weekend_Wonders_image) {
            $this->addStaticImage($request->Weekend_Wonders_image, 'Weekend_Wonders_image');
        }

        //  if ($request->Eco_Tours_image) {
        //     $this->addStaticImage($request->Eco_Tours_image, 'Eco_Tours_image');
        // }

        //  if ($request->Beach_Tour_image) {
        //     $this->addStaticImage($request->Beach_Tour_image, 'Beach_Tour_image');
        // }

        // if ($request->Heritage_Tours_image) {
        //     $this->addStaticImage($request->Heritage_Tours_image, 'Heritage_Tours_image');
        // }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();

    }

    // ******************************aboutUs_Subscribeto_get*************************
    public function aboutUs_Subscribeto_getSetting()
    {
        return view('admin.pages.setting.index');
    }

    /**
     * Start Main Setting Setting
     */
    public function aboutUs_Subscribeto_getShowSetting()
    {
        return view('admin.pages.setting.aboutUs_Subscribeto_get.show');
    }

    public function aboutUs_Subscribeto_getEdit()
    {
        return view('admin.pages.setting.aboutUs_Subscribeto_get.edit');
    }

    public function aboutUs_Subscribeto_getUpdate(aboutUsSubscribetoGetRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }


        if ($request->Subscribe_image) {
            $this->addStaticImage($request->Subscribe_image, 'Subscribe_image');
        }
     


        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }


// @@@***************************aboutUs_information*******************************

    public function aboutUs_information()
    {
        return view('admin.pages.setting.aboutUs _information.show');
    }

    public function aboutUs_information_getEdit()
    {
        return view('admin.pages.setting.aboutUs _information.edit');
    }

    public function aboutUs_information_getUpdate(aboutUsInformationRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }


        if ($request->explorer_image) {
            $this->addStaticImage($request->explorer_image, 'explorer_image');
        }

        if ($request->Winning_award_image) {
            $this->addStaticImage($request->Winning_award_image, 'Winning_award_image');
        }

        if ($request->Complete_project_image) {
            $this->addStaticImage($request->Complete_project_image, 'Complete_project_image');
        }

        if ($request->Client_review_image) {
            $this->addStaticImage($request->Client_review_image, 'Client_review_image');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }


   // @@@*******************************setting_blog_details***************************

      public function setting_blog_details()
    {
        return view('admin.pages.setting.setting_blog_details.show');
    }

    public function setting_blog_details_getEdit()
    {
        return view('admin.pages.setting.setting_blog_details.edit');
    }

    public function setting_blog_details_getUpdate(settingBlogDetailsGetUpdateRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        // if ($request->explorer_image) {
        //     $this->addStaticImage($request->explorer_image, 'explorer_image');
        // }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }

    // @@@*******************************setting_index***************************

    public function setting_index()
    {
        return view('admin.pages.setting.setting_index.show');
    }

    public function setting_index_getEdit()
    {
        return view('admin.pages.setting.setting_index.edit');
    }

    public function setting_index_getUpdate(settingIndexRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->image_panarea) {
            $this->addStaticImage($request->image_panarea, 'image_panarea');
        }
        
         if ($request->image_panarea_tow) {
            $this->addStaticImage($request->image_panarea_tow, 'image_panarea_tow');
        }
        
            if ($request->image_panarea_three) {
            $this->addStaticImage($request->image_panarea_three, 'image_panarea_three');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }

     // @@@*******************************Why_Choose_index***************************

    public function Why_Choose_index()
    {
        return view('admin.pages.setting.Why_Choose_index.show');
    }

    public function Why_Choose_index_getEdit()
    {
        return view('admin.pages.setting.Why_Choose_index.edit');
    }

    public function Why_Choose_index_getUpdate(WhyChooseIndexRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        // if ($request->explorer_image) {
        //     $this->addStaticImage($request->explorer_image, 'explorer_image');
        // }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }

    

    // @@@*******************************Find_best_places_index***************************

    public function Find_best_places_index()
    {
        return view('admin.pages.setting.Find_best_places_index.show');
    }

    public function Find_best_places_index_getEdit()
    {
        return view('admin.pages.setting.Find_best_places_index.edit');
    }

    public function Find_best_places_index_getUpdate(FindBestPlacesIndexRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->ourney_Beyond_image) {
            $this->addStaticImage($request->ourney_Beyond_image, 'ourney_Beyond_image');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }



    // @@@*******************************Your_gateway_to_amazing_index***************************

    public function Your_gateway_to_amazing_index()
    {
        return view('admin.pages.setting.Your_gateway_to_amazing_index.show');
    }

    public function Your_gateway_to_amazing_index_getEdit()
    {
        return view('admin.pages.setting.Your_gateway_to_amazing_index.edit');
    }

    public function Your_gateway_to_amazing_index_getUpdate(YourGatewayToAmazingIndexRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->food_image_one) {
            $this->addStaticImage($request->food_image_one, 'food_image_one');
        }

        if ($request->visa_image_tow) {
            $this->addStaticImage($request->visa_image_tow, 'visa_image_tow');
        }

        if ($request->Historical_image_three) {
            $this->addStaticImage($request->Historical_image_three, 'Historical_image_three');
        }

        if ($request->Beach_image_four) {
            $this->addStaticImage($request->Beach_image_four, 'Beach_image_four');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }


    // @@@*******************************trip_bestseller***************************

    public function trip_bestseller_index()
    {
        return view('admin.pages.setting.trip_bestseller.show');
    }

    public function trip_bestseller_getEdit()
    {
        return view('admin.pages.setting.trip_bestseller.edit');
    }

    public function trip_bestseller_getUpdate(TripBestsellerRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

       
        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();

    }



    // @@@*******************************trip_title_ad_image***************************

    public function trip_title_ad_image_index()
    {
        return view('admin.pages.setting.trip_title_ad_image.show');
    }

    public function trip_title_ad_image_getEdit()
    {
        return view('admin.pages.setting.trip_title_ad_image.edit');
    }

    public function trip_title_ad_image_getUpdate(TripTitleAdImageRequest $request)
    {

        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->image_one) {
            $this->addStaticImage($request->image_one, 'image_one');
        }

        if ($request->image_tow) {
            $this->addStaticImage($request->image_tow, 'image_tow');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }




    // @@@*******************************homecouronneSetting***************************

    public function homecouronneSetting()
    {
        return view('admin.pages.setting.homecouronnesetting.show');
    }

    public function homecouronneSettingEdit()
    {
        return view('admin.pages.setting.homecouronnesetting.edit');
    }

    public function homecouronneSettingUpdate(HomecouronnesettingRequest $request)
    {
        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->image_one_home) {
            $this->addStaticImage($request->image_one_home, 'image_one_home');
        }

        if ($request->image_logo) {
            $this->addStaticImage($request->image_logo, 'image_logo');
        }


        if ($request->file_one_home) {
            $this->addStaticImage($request->file_one_home, 'file_one_home');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }





    // @@@*******************************ourcardssetting***************************

    public function ourcardssetting()
    {
        return view('admin.pages.setting.ourcardssetting.show');
    }

    public function ourcardssettingEdit()
    {
        return view('admin.pages.setting.ourcardssetting.edit');
    }

    public function ourcardssettingUpdate(OurcardssettingRequest $request)
    {
        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        // if ($request->image_one_home) {
        //     $this->addStaticImage($request->image_one_home, 'image_one_home');
        // }

        // if ($request->image_tow) {
        //     $this->addStaticImage($request->image_tow, 'image_tow');
        // }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }


    // @@@*******************************news***************************

    public function newsSetting()
    {
        return view('admin.pages.setting.news.show');
    }

    public function newsSettingEdit()
    {
        return view('admin.pages.setting.news.edit');
    }

    public function newsSettingUpdate(SettingnewsRequest $request)
    {
        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }

        if ($request->image_one_news) {
            $this->addStaticImage($request->image_one_news, 'image_one_news');
        }

        if ($request->image_tow) {
            $this->addStaticImage($request->image_tow, 'image_tow');
        }

        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }





















    // @@@*******************************setting_infomation***************************

    public function setting_infomation_index()
    {
        return view('admin.pages.setting.setting_infomation.show');
    }

    public function setting_infomation_getEdit()
    {
        return view('admin.pages.setting.setting_infomation.edit');
    }

    public function setting_infomation_getUpdate(SettingInfomationRequest $request)
    {
        //    return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }
      
        $this->cacheSetting();
        session()->flash('success', TranslationHelper::translate('Setting Updated Successfully'));
        return back();
    }












    /**
     * Start privacyPolicy Setting
     */
    public function privacyPolicySetting()
    {

        return view('admin.pages.setting.privacy-policy.show');
    }

    public function privacyPolicyEdit()
    {
        return view('admin.pages.setting.privacy-policy.edit');
    }

    public function privacyPolicyUpdate(PrivacyPolicyRequest $request)
    {
//        return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }
        $this->cacheSetting();
        session()->flash('success', 'تم التحديث بنجاح');
        return back();
    }
    /**
     * End privacyPolicy Setting
     */


    /**
     * Start useTermsSetting
     */
    public function useTermsSetting()
    {

        return view('admin.pages.setting.use-terms.show');
    }

    public function useTermsEdit()
    {
        return view('admin.pages.setting.use-terms.edit');
    }


    public function useTermsUpdate(UseTermsRequest $request)
    {
//        return $request;
        foreach ($request->validated() as $key => $record) {
            $check = Setting::where('option', $key)->first();
            if ($check) {
                $check->update(['value' => $record]);
            } else {
                Setting::where('option', $key)->create(['option' => $key, 'value' => $record]);
            }
        }
        $this->cacheSetting();
        session()->flash('success', 'تم التحديث بنجاح');
        return back();
    }
    /**
     * End useTermsSetting
     */



    public function addStaticImage($image, $name)
    {
        $record = Setting::where('option', $name)->first();
        $record->deleteFiles();
        $record->storeFile($image);
        $record->update(['value' => ['en' => $record->getFirstMediaUrl('settings')]]);
    }

//     public function addStaticImage($file, $type)
// {
//     // تحقق من أن الملف هو من نوع UploadedFile
//     if ($file instanceof \Illuminate\Http\UploadedFile) {
//         // حفظ الملف (الفيديو) في المجلد المخصص
//         $path = $file->store('videos', 'public'); 
//         Setting::set($type, $path);
//     }
// }

    public function cacheSetting()
    {
        Cache::forget('settings');
        Cache::rememberForever('settings', function () {
            return Setting::get();
        });
    }

}
