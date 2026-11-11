<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin =  User::where('is_admin', 1)->first();

        Permission::query()->delete();

        //=============================Super-admin===============================================
        $superAdmin = Role::firstOrCreate([
            'name'          => 'Super admin',
        ]);
//        dd($admin);

        $admin->assignRole($superAdmin);

        $permissions = [
            ['name' => 'roles.view_all'],
            ['name' => 'roles.create'],
            ['name' => 'roles.edit'],
            ['name' => 'roles.delete'],

            
            ['name' => 'admins.view_all'],
            ['name' => 'admins.view_details'],
            ['name' => 'admins.create'],
            ['name' => 'admins.edit'],
            ['name' => 'admins.delete'],

            // ['name' => 'blog_categories.view_all'],
            // ['name' => 'blog_categories.view_details'],
            // ['name' => 'blog_categories.create'],
            // ['name' => 'blog_categories.edit'],
            // ['name' => 'blog_categories.delete'],
            // ['name' => 'blog_categories.sort'],

            // ['name' => 'blogs.view_all'],
            // ['name' => 'blogs.view_details'],
            // ['name' => 'blogs.create'],
            // ['name' => 'blogs.edit'],
            // ['name' => 'blogs.delete'],


            // ['name' => 'categorycolid.view_all'],
            // ['name' => 'categorycolid.view_details'],
            // ['name' => 'categorycolid.create'],
            // ['name' => 'categorycolid.edit'],
            // ['name' => 'categorycolid.delete'],
            
            
            // ['name' => 'blogs.sort'],

            // {{ \App\Helpers\TranslationHelper::translate('admins.view_all') }}
            // {{ \App\Helpers\TranslationHelper::translate('admins.view_details') }}
            // {{ \App\Helpers\TranslationHelper::translate('admins.create') }}
            // {{ \App\Helpers\TranslationHelper::translate('admins.edit') }}
            // {{ \App\Helpers\TranslationHelper::translate('admins.delete') }}

            // ['name' => 'branche.view_all'],
            // ['name' => 'branche.view_details'],
            // ['name' => 'branche.create'],
            // ['name' => 'branche.edit'],
            // ['name' => 'branche.delete'],

            // ['name' => 'branche.sort'],

            ['name' => 'product.view_all'],
            ['name' => 'product.view_details'],
            ['name' => 'product.create'],
            ['name' => 'product.edit'],
            ['name' => 'product.delete'],
            // ['name' => 'product.sort'],

            ['name' => 'productcategory.view_all'],
            ['name' => 'productcategory.view_details'],
            ['name' => 'productcategory.create'],
            ['name' => 'productcategory.edit'],
            ['name' => 'productcategory.delete'],


            //product_code كود المنتج
            // ['name' => 'productcode.view_all'],
            // ['name' => 'productcode.view_details'],
            // ['name' => 'productcode.create'],
            // ['name' => 'productcode.edit'],
            // ['name' => 'productcode.delete'],
            // ['name' => 'productcode.sort'],

            // offer العروض
            // ['name' => 'offer.view_all'],
            // ['name' => 'offer.view_details'],
            // ['name' => 'offer.create'],
            // ['name' => 'offer.edit'],
            // ['name' => 'offer.delete'],
            // ['name' => 'offer.sort'],

            // group  جروب الاكواد
            // ['name' => 'group.view_all'],
            // ['name' => 'group.view_details'],
            // ['name' => 'group.create'],
            // ['name' => 'group.edit'],
            // ['name' => 'group.delete'],
            // ['name' => 'group.sort'],


            // ['name' => 'notification.view_all'],
            // ['name' => 'notification.view_details'],
            // ['name' => 'notification.create'],
            // ['name' => 'notification.edit'],
            // ['name' => 'notification.delete'],
            // ['name' => 'notification.sort'],



            // ['name' => 'paintscategory.view_all'],
            // ['name' => 'paintscategory.view_details'],
            // ['name' => 'paintscategory.create'],
            // ['name' => 'paintscategory.edit'],
            // ['name' => 'paintscategory.delete'],
            // ['name' => 'paintscategory.sort'],


            // coupon  اكواد المنتجات
            // ['name' => 'coupon.view_all'],
            // ['name' => 'coupon.view_details'],
            // ['name' => 'coupon.create'],
            // ['name' => 'coupon.edit'],
            // ['name' => 'coupon.delete'],
            // ['name' => 'coupon.sort'],


            // vouchers page  صفحة عرض بينات كود الخصم
            // ['name' => 'voucherspage.view_all'],
            // ['name' => 'voucherspage.view_details'],
            // ['name' => 'voucherspage.create'],
            // ['name' => 'voucherspage.edit'],
            // ['name' => 'voucherspage.delete'],
            // ['name' => 'voucherspage.sort'],


            // points_setting اعداد النقاط 
            // ['name' => 'pointssetting.view_all'],
            // ['name' => 'pointssetting.view_details'],
            // ['name' => 'pointssetting.create'],
            // ['name' => 'pointssetting.edit'],
            // ['name' => 'pointssetting.delete'],
            // ['name' => 'pointssetting.sort'],


            // Notifications اشعارت
            // ['name' => 'notification.view_all'],
            // ['name' => 'notification.view_details'],
            // ['name' => 'notification.create'],
            // ['name' => 'notification.edit'],
            // ['name' => 'notification.delete'],
            // ['name' => 'notification.sort'],

            // store متجر
            // ['name' => 'shop.view_all'],
            // ['name' => 'shop.view_details'],
            // ['name' => 'shop.create'],
            // ['name' => 'shop.edit'],
            // ['name' => 'shop.delete'],
            // ['name' => 'shop.sort'],


            // banner 
            ['name' => 'banner.view_all'],
            ['name' => 'banner.view_details'],
            ['name' => 'banner.create'],
             ['name' => 'banner.edit'],
            ['name' => 'banner.delete'],
            ['name' => 'banner.sort'],

            // complaint
            // ['name' => 'complaint.view_all'],
            // ['name' => 'complaint.view_details'],
            // ['name' => 'complaint.create'],
            // ['name' => 'complaint.edit'],
            // ['name' => 'complaint.delete'],
            // ['name' => 'complaint.sort'],

            // client
            // ['name' => 'client.view_all'],
            // ['name' => 'client.view_details'],
            // ['name' => 'client.create'],
            // ['name' => 'client.edit'],
            // ['name' => 'client.delete'],
            // ['name' => 'client.sort'],



            //tour_types
            // ['name' => 'tour_types.view_all'],
            // ['name' => 'tour_types.read'],
            // ['name' => 'tour_types.create'],
            // ['name' => 'tour_types.edit'],
            // ['name' => 'tour_types.delete'],
            // ['name' => 'tour_types.sort'],


            // ['name' => 'programmes.view_all'],
            // ['name' => 'programmes.view_details'],
            // ['name' => 'programmes.create'],
            // ['name' => 'programmes.edit'],
            // ['name' => 'programmes.delete'],
            // ['name' => 'programmes.sort'],

            //programmes
            // ['name' => 'programmes.read'],
            // ['name' => 'programmes.create'],
            // ['name' => 'programmes.edit'],
            // ['name' => 'programmes.delete'],


            //programmes_bookings
            // ['name' => 'programmes_bookings.read'],
            // ['name' => 'programmes_bookings.show'],
            // ['name' => 'programmes_bookings.create'],
            // ['name' => 'programmes_bookings.edit'],
            // ['name' => 'programmes_bookings.delete'],



            //programme_rates
            // ['name' => 'programme_rates.read'],
            // ['name' => 'programme_rates.delete'],

            //information_flights
            // ['name' => 'information_flights.view_all'],
            // ['name' => 'information_flights.view_details'],
            // ['name' => 'information_flights.create'],
            // ['name' => 'information_flights.edit'],
            // ['name' => 'information_flights.delete'],
            // ['name' => 'information_flights.sort'],



            //information_hotels
            // ['name' => 'information_hotels.view_all'],
            // ['name' => 'information_hotels.view_details'],
            // ['name' => 'information_hotels.create'],
            //  ['name' => 'information_hotels.edit'],
            // ['name' => 'information_hotels.delete'],
            // ['name' => 'information_hotels.sort'],



            //information_tours
            // ['name' => 'information_tours.view_all'],
            // ['name' => 'information_tours.view_details'],
            // ['name' => 'information_tours.create'],
            // ['name' => 'information_tours.edit'],
            // ['name' => 'information_tours.delete'],
            // ['name' => 'information_tours.sort'],


            //category_gallery
            // ['name' => 'category_gallery.view_all'],
            // ['name' => 'category_gallery.view_details'],
            // ['name' => 'category_gallery.create'],
            // ['name' => 'category_gallery.edit'],
            // ['name' => 'category_gallery.delete'],
            // ['name' => 'category_gallery.sort'],


            ['name' => 'gallery.view_all'],
            ['name' => 'gallery.view_details'],
            ['name' => 'gallery.create'],
            ['name' => 'gallery.edit'],
            ['name' => 'gallery.delete'],
            ['name' => 'gallery.sort'],


            // messages
            ['name' => 'messages.view_all'],
            ['name' => 'messages.view_details'],
            ['name' => 'messages.delete'],


            // information_user
            // ['name' => 'information_user.view_all'],
            // ['name' => 'information_user.view_details'],
            // ['name' => 'information_user.delete'],

            // ['name' => 'countries.view_all'],
            // ['name' => 'countries.read'],
            // ['name' => 'countries.create'],
            // ['name' => 'countries.edit'],
            // ['name' => 'countries.delete'],
            // ['name' => 'countries.sort'],


            // ['name' => 'cities.view_all'],
            // ['name' => 'cities.read'],
            // ['name' => 'cities.create'],
            // ['name' => 'cities.edit'],
            // ['name' => 'cities.delete'],
            // ['name' => 'cities.sort'],


            //regions
            // ['name' => 'regions.read'],
            // ['name' => 'regions.create'],
            // ['name' => 'regions.edit'],
            // ['name' => 'regions.delete'],
            // ['name' => 'regions.sort'],

            // payment_picture
            // ['name' => 'payment_picture.view_all'],
            // ['name' => 'payment_picture.view_details'],
            // ['name' => 'payment_picture.create'],
            // ['name' => 'payment_picture.edit'],
            // ['name' => 'payment_picture.delete'],
            // ['name' => 'payment_picture.sort'],

            // news
            // ['name' => 'news.view_all'],
            // ['name' => 'news.view_details'],
            // ['name' => 'news.create'],
            // ['name' => 'news.edit'],
            // ['name' => 'news.delete'],

            // about_us
            ['name' => 'about_us.view_all'],
            ['name' => 'about_us.view_details'],
            ['name' => 'about_us.create'],
            ['name' => 'about_us.edit'],
            ['name' => 'about_us.delete'],
            // ['name' => 'about_us.sort'],


            //contact
            ['name' => 'contact.view_all'],
            ['name' => 'contact.view_details'],
            ['name' => 'contact.create'],
            ['name' => 'contact.edit'],
            ['name' => 'contact.delete'],

            // card
            // ['name' => 'card.view_all'],
            // ['name' => 'card.view_details'],
            // ['name' => 'card.create'],
            // ['name' => 'card.edit'],
            // ['name' => 'card.delete'],


            // testimonial
            ['name' => 'testimonial.view_all'],
            ['name' => 'testimonial.view_details'],
            ['name' => 'testimonial.create'],
            ['name' => 'testimonial.edit'],
            ['name' => 'testimonial.delete'],
            ['name' => 'testimonial.sort'],



            // privacypolicy
            // ['name' => 'privacypolicy.view_all'],
            // ['name' => 'privacypolicy.view_details'],
            // ['name' => 'privacypolicy.create'],
            // ['name' => 'privacypolicy.edit'],
            // ['name' => 'privacypolicy.delete'],




            // termsandCondition
            // ['name' => 'termsandcondition.view_all'],
            // ['name' => 'termsandcondition.view_details'],
            // ['name' => 'termsandcondition.create'],
            // ['name' => 'termsandcondition.edit'],
            // ['name' => 'termsandcondition.delete'],

            // all_settings
            ['name' => 'all_settings.view_all'],

            ['name' => 'mainSetting.view_details'],
            ['name' => 'mainSetting.edit'],


            // ['name' => 'aboutUsSetting.view_details'],
            // ['name' => 'aboutUsSetting.edit'],


            // ['name' => 'aboutUs_ClientsSaySetting.view_details'],
            // ['name' => 'aboutUs_ClientsSaySetting.edit'],


            // ['name' => 'aboutUs_Popular_DestinationsSetting.view_details'],
            // ['name' => 'aboutUs_Popular_DestinationsSetting.edit'],


            // aboutUs_Subscribeto_getSetting

            // ['name' => 'aboutUs_Subscribeto_getSetting.view_details'],
            // ['name' => 'aboutUs_Subscribeto_getSetting.edit'],

            // aboutUs_information
            // ['name' => 'aboutUs_information.view_details'],
            // ['name' => 'aboutUs_information.edit'],

            // setting_blog_details
            // ['name' => 'setting_blog_details.view_details'],
            // ['name' => 'setting_blog_details.edit'],

            // setting_index
            // ['name' => 'setting_index.view_details'],
            // ['name' => 'setting_index.edit'],

            // Why_Choose_index
            // ['name' => 'Why_Choose_index.view_details'],
            // ['name' => 'Why_Choose_index.edit'],

            // Find_best_places_index
            // ['name' => 'Find_best_places_index.view_details'],
            // ['name' => 'Find_best_places_index.edit'],

            // Your_gateway_to_amazing_index
            // ['name' => 'Your_gateway_to_amazing_index.view_details'],
            // ['name' => 'Your_gateway_to_amazing_index.edit'],

            // trip_bestseller_index
            // ['name' => 'trip_bestseller_index.view_details'],
            // ['name' => 'trip_bestseller_index.edit'],

            // trip_title_ad_image_index
            // ['name' => 'trip_title_ad_image_index.view_details'],
            // ['name' => 'trip_title_ad_image_index.edit'],

            // setting_infomation_index
            // ['name' => 'setting_infomation_index.view_details'],
            // ['name' => 'setting_infomation_index.edit'],

             ['name' => 'home_couronne_setting.view_details'],
            ['name' => 'home_couronne_setting.edit'],

        //     ['name' => 'newsSetting.view_details'],
        //     ['name' => 'newsSetting.edit'],

            

        //   ['name' => 'ourcardssetting.view_details'],
        //     ['name' => 'ourcardssetting.edit'],

            







            


//             ['name' => 'package_requests.view_all'],
//             ['name' => 'package_requests.view_details'],
//             ['name' => 'package_requests.edit'],


//             ['name' => 'user_packages.view_all'],


//             ['name' => 'wallets.view_all'],


//             ['name' => 'documents.view_all'],
//             ['name' => 'documents.view_details'],
//             ['name' => 'documents.create'],
//             ['name' => 'documents.edit'],
//             ['name' => 'documents.delete'],
//             ['name' => 'documents.sort'],


//             ['name' => 'providers.view_all'],
//             ['name' => 'providers.view_details'],
// //            ['name' => 'providers.create'],
// //            ['name' => 'providers.edit'],
//             ['name' => 'providers.delete'],


//             ['name' => 'providers_services.view_all'],
//             ['name' => 'providers_services.view_details'],
// //            ['name' => 'providers_services.create'],
// //            ['name' => 'providers_services.edit'],
//             ['name' => 'providers_services.delete'],


//             ['name' => 'bookings.view_all'],
//             ['name' => 'bookings.view_details'],
// //            ['name' => 'bookings.create'],
// //            ['name' => 'bookings.edit'],
//             ['name' => 'bookings.delete'],


//             ['name' => 'clients.view_all'],
//             ['name' => 'clients.view_details'],
// //            ['name' => 'clients.create'],
// //            ['name' => 'clients.edit'],
//             ['name' => 'clients.delete'],


//             ['name' => 'service_categories.view_all'],
//             ['name' => 'service_categories.view_details'],
//             ['name' => 'service_categories.create'],
//             ['name' => 'service_categories.edit'],
//             ['name' => 'service_categories.delete'],
//             ['name' => 'service_categories.sort'],


//             ['name' => 'service_subCategories.view_all'],
//             ['name' => 'service_subCategories.view_details'],
//             ['name' => 'service_subCategories.create'],
//             ['name' => 'service_subCategories.edit'],
//             ['name' => 'service_subCategories.delete'],
//             ['name' => 'service_subCategories.sort'],


//             ['name' => 'groups.view_all'],
//             ['name' => 'groups.view_details'],
//             ['name' => 'groups.create'],
//             ['name' => 'groups.edit'],
//             ['name' => 'groups.delete'],
//             ['name' => 'groups.sort_fields'],


//             ['name' => 'fields.view_all'],
//             ['name' => 'fields.view_details'],
//             ['name' => 'fields.create'],
//             ['name' => 'fields.edit'],
//             ['name' => 'fields.delete'],

//             ['name' => 'services.view_all'],
//             ['name' => 'services.view_details'],
//             ['name' => 'services.create'],
//             ['name' => 'services.edit'],
//             ['name' => 'services.delete'],
//             ['name' => 'services.sort'],


//             ['name' => 'countries.view_all'],
//             ['name' => 'countries.view_details'],
//             ['name' => 'countries.create'],
//             ['name' => 'countries.edit'],
//             ['name' => 'countries.delete'],
//             ['name' => 'countries.sort'],


//             ['name' => 'cities.view_all'],
//             ['name' => 'cities.view_details'],
//             ['name' => 'cities.create'],
//             ['name' => 'cities.edit'],
//             ['name' => 'cities.delete'],
//             ['name' => 'cities.sort'],


//             ['name' => 'regions.view_all'],
//             ['name' => 'regions.view_details'],
//             ['name' => 'regions.create'],
//             ['name' => 'regions.edit'],
//             ['name' => 'regions.delete'],
//             ['name' => 'regions.sort'],


            // ['name' => 'banners.view_all'],
            // ['name' => 'banners.create'],
            // ['name' => 'banners.edit'],
            // ['name' => 'banners.delete'],



//             ['name' => 'bottom_banners.view_all'],
//             ['name' => 'bottom_banners.create'],
//             ['name' => 'bottom_banners.edit'],
//             ['name' => 'bottom_banners.delete'],


//             ['name' => 'bottom_banner.view_details'],
//             ['name' => 'bottom_banner.edit'],


//             ['name' => 'messages.view_all'],
//             ['name' => 'messages.view_details'],
//             ['name' => 'messages.delete'],


//             ['name' => 'about_us.view_details'],
//             ['name' => 'about_us.edit'],


//             ['name' => 'terms.view_details'],
//             ['name' => 'terms.edit'],


//             ['name' => 'privacy.view_details'],
//             ['name' => 'privacy.edit'],

//             ['name' => 'settings.view_details'],
//             ['name' => 'settings.edit'],
        ];

        foreach ($permissions as $permission) {
            $name = isset($permission['name']) ? $permission['name'] : null;
            $createdPermission = Permission::firstOrCreate([
                'name'          => $name,
                'guard_name' => 'admin'
            ]);
            $superAdmin->givePermissionTo($createdPermission);
        }
    }
}
