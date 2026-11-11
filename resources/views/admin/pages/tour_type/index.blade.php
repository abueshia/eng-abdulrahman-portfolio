@extends('admin.layouts.app')

@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{\App\Helpers\TranslationHelper::translate('Tour Types')}}
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
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Tour Types')}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::search bar-->
{{--                <form class="d-flex mb-0">--}}
{{--                    <div class="input__group mb-25">--}}
{{--                        <input type="search" name="search" autocomplete="name" placeholder="search" class="form-control"--}}
{{--                               required/>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <!--end::search bar-->
                <!--begin::Primary button-->
               @if (auth()->guard('admin')->user()->can('tour_types.create', 'admin'))
                <a href="{{ route('admin.tour_type.create') }}" class="btn btn-sm fw-bold btn-primary">{{\App\Helpers\TranslationHelper::translate('Add Tour Type')}}
                    </a>
                    @endif
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
            <div class="row align-items-end" style="gap: 10px;"> <!-- أضفنا خاصية gap لتقليل المسافة بين الأعمدة -->
                <div class="col-lg-4 col-12">
                    <div class="input__group mb-25 w-100">
                        <label for="search" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Name')}}</label>
                        <input type="search" name="search" style="width: 225px" autocomplete="name" placeholder="{{\App\Helpers\TranslationHelper::translate('search')}}"
                               class="form-control"
                               value="{{request()->search}}"/>
                    </div>
                </div>
                <div class="col-lg-3 col-12" style="width: 170px;">
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
                        @if(isset($tour_types) && $tour_types->count() > 0)

                            <table class="table align-middle table-row-dashed fs-6 gy-5 text-center"
                                   id="kt_table_users">
                                <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>{{\App\Helpers\TranslationHelper::translate('ID')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Name (Ar)')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Name (En)')}}</th>
                                    <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">

                                @foreach ($tour_types as $tour_type)
                                    <tr>
                                        <td>{{$tour_type->id}}</td>
                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{$tour_type->getTranslation('name', 'ar')}}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

                                        <td class="text-center">

                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                {{$tour_type->getTranslation('name', 'en')}}
                                            </div>
                                            <!--begin::User details-->
                                        </td>

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
                                                @if (auth()->guard('admin')->user()->can('tour_types.edit', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.tour_type.edit', $tour_type->id) }}"
                                                       class="menu-link px-3">
                                                        {{\App\Helpers\TranslationHelper::translate('Edit')}}
                                                    </a>
                                                </div>
                                                @endif
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                @if (auth()->guard('admin')->user()->can('tour_types.delete', 'admin'))
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.tour_type.destroy', $tour_type->id) }}"
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
                            {{ $tour_types->appends(request()->query())->links() }}
                        @else
                            <div class="col-lg-12 text-center">
                                <h2 class="mb-4">{{\App\Helpers\TranslationHelper::translate('There is no Data')}}</h2>
                                {{-- <img src="{{asset('end-user/assets/images/not_found.png')}}" alt="not_found"
                                     class="" style="width: 65px"> --}}
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

<script>

</script>
