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

        .toggle-checkbox:checked+.toggle-label .toggle-inner {
            transform: translateX(30px);
        }

        .toggle-checkbox:checked+.toggle-label .toggle-switch {
            left: 32px;
            background-color: #4CAF50;
            /* Change the color here */
        }

        .toggle-checkbox:checked+.toggle-label {

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
                    {{ \App\Helpers\TranslationHelper::translate('All Programmes') }}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.index')}}" class="text-muted text-hover-primary">{{ \App\Helpers\TranslationHelper::translate('Home') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted"> {{ \App\Helpers\TranslationHelper::translate('Programmes') }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::search bar-->
                <form class="d-flex">
                    <div class="input__group mb-25">
                        <input type="search" name="search" autocomplete="name" placeholder="{{ \App\Helpers\TranslationHelper::translate('search') }}" class="form-control"
                            required />
                    </div>
                </form>
                <!--end::search bar-->
                <!--begin::Primary button-->
                <a href="{{ route('admin.programme.create') }}" class="btn btn-sm fw-bold btn-primary">{{ \App\Helpers\TranslationHelper::translate('Add Programme') }}</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <div class="card">
        <div class="card-body">
            <form action="" method="get">
                <div class="row align-items-end">
                    <div class="col-lg-2 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="search" class="form-label mb-3">{{ \App\Helpers\TranslationHelper::translate('Programme Name') }}</label>
                            <input type="search" name="search" autocomplete="name" placeholder="{{ \App\Helpers\TranslationHelper::translate('search') }}"
                                   class="form-control"
                                   value="{{request()->search}}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="country_id" class="form-label mb-3">{{ \App\Helpers\TranslationHelper::translate('Country') }}</label>
                            <select name="country_id" id="country_id" class="form-select">
                                <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Country') }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ request()->country_id == $country->id ? 'selected' : '' }}>
                                        {{ $country->getTranslation('name', app()->getLocale()) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="city_id" class="form-label mb-3">{{ \App\Helpers\TranslationHelper::translate('City') }}</label>
                            <select name="city_id" id="city_id" class="form-select">
                                @if(request()->country_id != '')
                                    @php($cities = App\Models\City::where('country_id', request()->country_id)->get())
                                    <option value="">{{ \App\Helpers\TranslationHelper::translate('Select City') }}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request()->city_id == $city->id ? 'selected' : '' }}>
                                            {{ $city->getTranslation('name', app()->getLocale()) }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">{{ \App\Helpers\TranslationHelper::translate('Select City') }}</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="is_featured" class="form-label mb-3">{{ \App\Helpers\TranslationHelper::translate('Is Featured') }}</label>
                            <select name="is_featured" id="is_featured" class="form-select">
                                <option value="">{{ \App\Helpers\TranslationHelper::translate('All') }}</option>
                                <option value="1.00" {{request()->is_featured == '1.00' ? 'selected' : ''}}>{{ \App\Helpers\TranslationHelper::translate('Yes') }}</option>
                                <option value="0.00" {{request()->is_featured == '0.00' ? 'selected' : ''}}>{{ \App\Helpers\TranslationHelper::translate('No') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="status" class="form-label mb-3">{{ \App\Helpers\TranslationHelper::translate('Status') }}</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">{{ \App\Helpers\TranslationHelper::translate('All') }}</option>
                                <option value="1" {{request()->status == '1' ? 'selected' : ''}}>{{ \App\Helpers\TranslationHelper::translate('Active') }}</option>
                                <option value="0" {{request()->status == '0' ? 'selected' : ''}}>{{ \App\Helpers\TranslationHelper::translate('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="w-100">
                            <button type="submit" class="btn btn-warning w-100">
                                {{ \App\Helpers\TranslationHelper::translate('Filter') }}
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


                        <table class="table align-middle table-row-dashed fs-6 gy-5 text-center" id="kt_table_users">
                            <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>{{ \App\Helpers\TranslationHelper::translate('ID') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('Name') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('Country') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('City') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('Rate Avg') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('Is featured') }} </th>
                                    <th class="min-w-125px"> {{ \App\Helpers\TranslationHelper::translate('status') }}</th>
                                    <th class="min-w-125px">{{ \App\Helpers\TranslationHelper::translate('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                            @if(isset($programmes) && $programmes->count() > 0)
                                @foreach ($programmes as $programme)
                                    <tr>
                                        <td>{{$programme->id}}</td>
                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $programme->name }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $programme->country->name ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $programme->city->name ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $programme->avg_rate ?? 0 }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">

                                            <!--begin::User details-->
                                                <input type="checkbox" value="{{ $programme->is_featured }}"
                                                    id="toggle_{{ $programme->id }}" class="toggle-checkbox"
                                                    data-value="{{ $programme->id }}">
                                                <label for="toggle_{{ $programme->id }}" class="toggle-label">
                                                    <div class="toggle-inner"></div>
                                                    <div class="toggle-switch"></div>
                                                </label>
                                            <!--begin::User details-->
                                        </td>


                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{ $programme->getProgrammeStatus() ?? '' }}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ \App\Helpers\TranslationHelper::translate('Actions') }}
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                  @if (auth()->guard('admin')->user()->can('programmes.edit', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.programme.edit', $programme->id) }}"
                                                        class="menu-link px-3">
                                                        {{ \App\Helpers\TranslationHelper::translate('Edit') }}
                                                    </a>
                                                </div>
                                                @endif
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                  @if (auth()->guard('admin')->user()->can('programmes.destroy', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.programme.destroy', $programme->id) }}"
                                                        class="menu-link px-3" data-kt-users-table-filter="delete_row">
                                                        {{ \App\Helpers\TranslationHelper::translate('Delete') }}
                                                    </a>
                                                </div>
                                                @endif
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="7">
                                        <img src="{{asset('assets/media/no-results.png')}}" alt="" width="100px">
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $programmes->appends(request()->query())->links() }}
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
        $(document).ready(function() {
            $('.toggle-checkbox').change(function() {
                var elementId = $(this).data('value');
                var isChecked = $(this).prop('checked');
                console.log('Checkbox with element ID ' + elementId + ' changed to ' + isChecked);
            });
        });

        document.addEventListener("DOMContentLoaded", function() {

            let programmes = {!! $programmes->getCollection()->toJson() !!}

            programmes.forEach(element => {
                var toggle = document.getElementById('toggle_' + element.id);
                if (toggle.value == 1) {
                    toggle.checked = true;
                } else {
                    toggle.checked = false;
                }
            });

        });

        var programmes = {!! $programmes->getCollection()->toJson() !!}

        programmes.forEach(element => {

            $(document).ready(function() {
                $("#toggle_" + element.id).change(function() {
                    console.log(element.id);
                    var isChecked = $(this).prop('checked');

                    if (isChecked) {
                        $.ajax({
                            url: 'admin/programme/update-is-featured/' + 1 + '?id=' + element
                                .id,
                            type: 'GET',
                            contentType: 'application/json',
                        });
                    } else {
                        $.ajax({
                            url: 'admin/programme/update-is-featured/' + 0 +
                                '?id=' + element.id,
                            type: 'GET',
                            contentType: 'application/json',
                        });
                    }
                });
            });
        });
        $(document).ready(function () {
            let country = $("#country_id");
            country.select2();
            let city = $("#city_id");
            city.select2();
            let is_featured = $("#is_featured");
            is_featured.select2();
            let status = $("#status");
            status.select2();


            $('#country_id').change(function () {
                var country = $(this).val();
                if (country) {
                    $.ajax({
                        url: '{{url('admin/cities/getCityByCountry/')}}' + '/' + country,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#city_id').empty();
                            $('#city_id').append('<option value="" selected>Select City</option>');
                            $.each(data, function (id, name) {
                                $('#city_id').append('<option value="' + id + '">' + name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>');
                }
            });
        });
    </script>
@endpush
