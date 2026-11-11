@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush


@push('styles')
    <style>
        .toggle-checkbox {
            display: none;
        }

        .toggle-label {
            display: inline-block;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 15px;
            position: relative;
            cursor: pointer;
        }

        .toggle-inner {
            position: absolute;
            left: 2px;
            top: 2px;
            width: 26px;
            height: 26px;
            background-color: #fff;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .toggle-switch {
            position: absolute;
            left: 2px;
            top: 2px;
            width: 26px;
            height: 26px;
            background-color: #999;
            border-radius: 50%;
            transition: left 0.3s ease;
        }

        .toggle-checkbox:checked + .toggle-label .toggle-inner {
            transform: translateX(30px);
        }

        .toggle-checkbox:checked + .toggle-label .toggle-switch {
            left: 32px;
            background-color: #4CAF50;
            /* Change the color here */
        }

        .toggle-checkbox:checked + .toggle-label {

            background-color: #88d28b;
            /* Change the color here */
        }
    </style>
@endpush
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{\App\Helpers\TranslationHelper::translate('Users')}}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.index')}}" class="text-muted text-hover-primary">{{\App\Helpers\TranslationHelper::translate('Home')}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Information user')}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
        {{--            <div class="d-flex align-items-center gap-2 gap-lg-3">--}}
        <!--begin::search bar-->
        {{--                <form class="d-flex">--}}
        {{--                    <div class="input__group mb-25">--}}
        {{--                        <input type="search" name="search" autocomplete="name" placeholder="search" class="form-control"--}}
        {{--                            required />--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        <!--end::search bar-->
            <!--begin::Primary button-->
        {{--                <a href="{{ route('dashboard.hotels.create') }}" class="btn btn-sm fw-bold btn-primary">Add Hotel</a>--}}
        <!--end::Primary button-->
        {{--            </div>--}}
        <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <div class="card">
        <div class="card-body">
            <form action="" method="get">
                <div class="row align-items-end">

                    <div class="col-lg-5 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="input__group mb-25 w-100">
                                    <label for="user_id" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('User')}}</label>
                                    <select name="user_id" id="user_id" class="form-select">
                                        <option value="">{{\App\Helpers\TranslationHelper::translate('Choose User')}}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ request()->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-12">
                                <div class="input__group mb-25 w-100">
                                    <label for="programme_id" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Choose Programme')}}</label>
                                    <select name="programme_id" id="programme_id" class="form-select">
                                        <option value=""> All</option>
                                        @foreach ($programmes as $programme)
                                            <option
                                                value="{{ $programme->id }}" {{request()->has('programme_id') && request()->programme_id == $programme->id ? 'selected' : ''}}> {{ $programme->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                                            <div class="col-lg-6 col-12">
                                <div class="input__group mb-25 w-100">
                                    <label for="from_date" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Check in From Date')}}</label>

                                    <input type="date" name="from_date" placeholder="{{\App\Helpers\TranslationHelper::translate('From Date')}}" class="form-control"
                                           value="{{request()->from_date}}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12">
                        <div class="row">
                            {{-- <div class="col-lg-6 col-12">
                                <div class="input__group mb-25 w-100">
                                    <label for="from_date" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Check in From Date')}}</label>

                                    <input type="date" name="from_date" placeholder="{{\App\Helpers\TranslationHelper::translate('From Date')}}" class="form-control"
                                           value="{{request()->from_date}}"/>
                                </div>
                            </div> --}}
                            <div class="col-lg-6 col-12">
                                <div class="input__group mb-25 w-100">
                                    <label for="to_date" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Check in To Date')}}</label>
                                    <input type="date" name="to_date" placeholder="{{\App\Helpers\TranslationHelper::translate('To Date')}}" class="form-control"
                                           value="{{request()->to_date}}"/>
                                </div>


                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="w-100">
                            <button type="submit" class="btn btn-warning w-100">
                                {{\App\Helpers\TranslationHelper::translate('Filter')}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Col-->
                        @if(isset($bookings) && $bookings->count() > 0)
                            <table class="table align-middle table-row-dashed fs-6 gy-5 text-center"
                                   id="kt_table_users">
                                <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>{{\App\Helpers\TranslationHelper::translate('ID')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Name User')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Email')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('phone')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Date')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Total reservations')}}</th>

                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold">

                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $booking->user->name }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $booking->email ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $booking->phone ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $booking->check_in ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        
                      {{-- <td class="text-center">
    <!--begin::User details-->
    <div class="d-flex flex-column">
        {{ $booking->user?->programmebooking?->count() ?? 0 }}
    </div>
    <!--end::User details-->
</td> --}}
<td class="text-center">
{{-- @foreach($users as $user) --}}
     <div class="d-flex flex-column">
        {{-- <p>مستخدم: {{ $user->name }}</p> --}}
        {{ $usersBookingCountMap[$user->id] ?? 0 }}
    </div>
{{-- @endforeach --}}
</td>

{{-- 
                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $booking->check_in ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{\App\Helpers\TranslationHelper::translate('SAR')}}{{ $booking->total ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td> --}}


                                        <td class="text-center">
                                            <a href="#"
                                               class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{\App\Helpers\TranslationHelper::translate('Actions')}}
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div
                                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                @if (auth()->guard('admin')->user()->can('information_user.view_details', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.informationuser.show', $booking->id) }}"
                                                       class="menu-link px-3">
                                                        {{\App\Helpers\TranslationHelper::translate('Show')}}
                                                    </a>
                                                </div>
                                                @endif
                                                @if (auth()->guard('admin')->user()->can('information_user.delete', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.informationuser.destroy', $booking->id) }}"
                                                       class="menu-link px-3" data-kt-users-table-filter="delete_row">
                                                        {{\App\Helpers\TranslationHelper::translate('Delete')}}
                                                    </a>
                                                </div>
                                                @endif
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $bookings->links() }}
                        @else
                            <div class="text-center">
                                <h2>No Data Found</h2>
                            </div>
                    @endif
                    <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            let user_id = $("#user_id");
            user_id.select2();
            let programme_id = $("#programme_id");
            programme_id.select2();
        });
    </script>
@endpush
