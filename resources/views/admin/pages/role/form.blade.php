@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Role'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Role'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Roles'),'link'=>route('admin.role.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Roles'),'link'=>route('admin.role.index')]">
    </x-bread-crumb>

@endsection

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="p-5">
                            <!--begin::Form-->
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$role->id}}">

                            @endif
                            <!--begin::Input group-->


                                {{-- <div class="fv-row mb-10">
                                    <div class="row">
                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{\App\Helpers\TranslationHelper::translate('Name')}}:
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   value="{{ old('name') ?? $role->name}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Name')}}" name="name"/>
                                            @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <h3 class="mb-5">
                                            {{\App\Helpers\TranslationHelper::translate('Choose Permissions')}}
                                            <input type="checkbox" name="all_perm" id="all_perm"
                                                   class="form-check-input ms-5 me-3"
                                                   onchange="changeAllPerm(this)">
                                            <label for="all_perm" class="">{{\App\Helpers\TranslationHelper::translate('Check All')}}</label>
                                        </h3>
                                        @if($method == 'PUT')
                                            @foreach($permissions_grouped as $group => $permissions)
                                                <div class=" col-lg-4 col-md-4 col-12">
                                                    <div class="card p-5 mb-5">
                                                        <div class="card-header p-3 pb-0" style="min-height: 35px;border: 0">
                                                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                                                        </div>
                                                        <div class="row p-3">
                                                            @foreach($permissions as $permission)
                                                                <div class="col-lg-6 col-6 mb-3">
                                                                    <input type="checkbox" class="form-check-input perm_inp  cursor-pointer" style="vertical-align: bottom;"
                                                                           value="{{$group.'.'.$permission['name']}}"
                                                                           name="permissions[]"
                                                                           id="{{$group . '_' . $permission['name']}}" {{isset($selected_roles) ? (in_array(($group.'.'.$permission['name']), $selected_roles) ? 'checked' : '') : ''}}>
                                                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                                                           style="vertical-align: middle;    font-weight: 600;"
                                                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @else
                                            @foreach($permissions_grouped as $group => $permissions)
                                                <div class=" col-lg-4 col-md-4 col-12">
                                                    <div class="card p-5 mb-5">
                                                        <div class="card-header p-3 pb-0" style="min-height: 35px;border: 0">
                                                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                                                        </div>
                                                        <div class="row p-3">
                                                            @foreach($permissions as $permission)
                                                                <div class="col-lg-6 col-6 mb-3">
                                                                    <input type="checkbox" class="form-check-input perm_inp  cursor-pointer" style="vertical-align: bottom;"
                                                                           value="{{$group.'.'.$permission['name']}}"
                                                                           name="permissions[]"
                                                                           id="{{$group . '_' . $permission['name']}}" {{old('permissions') ? (in_array($permission['id'], old('permissions')) ? 'checked' : '') : ''}}>
                                                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                                                           style="vertical-align: middle;    font-weight: 600;"
                                                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                         </div>
                                </div> --}}



                                
                                {{-- <div class="fv-row mb-10">
    <div class="row">
        <div class="col-6 mb-5">
            <label class="fs-5 fw-bold form-label mb-5">
                {{\App\Helpers\TranslationHelper::translate('Name')}}:
            </label>
            <!-- Input Field -->
            <input type="text" class="form-control form-control-solid"
                   value="{{ old('name') ?? $role->name}}"
                   placeholder="{{\App\Helpers\TranslationHelper::translate('Name')}}" name="name"/>
            @error('name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <h3 class="mb-5">
            {{\App\Helpers\TranslationHelper::translate('Choose Permissions')}}
            <input type="checkbox" name="all_perm" id="all_perm"
                   class="form-check-input ms-5 me-3"
                   onchange="changeAllPerm(this)">
            <label for="all_perm">{{\App\Helpers\TranslationHelper::translate('Check All')}}</label>
        </h3>

        @if($method == 'PUT')
            @foreach($permissions_grouped as $group => $permissions)
                <div class="col-lg-4 col-md-6 col-12"> <!-- تعديل العمود ليعرض 3 عناصر في الصف -->
                    <div class="card p-5 mb-5" style="height: 270px">
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                        </div>
                        <div class="row p-3">
                            @foreach($permissions as $permission)
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="{{$group.'.'.$permission['name']}}"
                                           name="permissions[]"
                                           id="{{$group . '_' . $permission['name']}}" {{isset($selected_roles) ? (in_array(($group.'.'.$permission['name']), $selected_roles) ? 'checked' : '') : ''}}>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($permissions_grouped as $group => $permissions)
                <div class="col-lg-4 col-md-6 col-12"> <!-- تعديل العمود ليعرض 3 عناصر في الصف -->
                    <div class="card p-5 mb-5">
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                        </div>
                        <div class="row p-3">
                            @foreach($permissions as $permission)
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="{{$group.'.'.$permission['name']}}"
                                           name="permissions[]"
                                           id="{{$group . '_' . $permission['name']}}" {{old('permissions') ? (in_array($permission['id'], old('permissions')) ? 'checked' : '') : ''}}>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div> --}}


<div class="fv-row mb-10">
    <div class="row">
        <div class="col-6 mb-5">
            <label class="fs-5 fw-bold form-label mb-5">
                {{\App\Helpers\TranslationHelper::translate('Name')}}:
            </label>
            <!-- Input Field -->
            <input type="text" class="form-control form-control-solid"
                   value="{{ old('name') ?? $role->name}}"
                   placeholder="{{\App\Helpers\TranslationHelper::translate('Name')}}" name="name"/>
            @error('name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <h3 class="mb-5">
            {{\App\Helpers\TranslationHelper::translate('Choose Permissions')}}
            <input type="checkbox" name="all_perm" id="all_perm"
                   class="form-check-input ms-5 me-3"
                   onchange="changeAllPerm(this)">
            <label for="all_perm">{{\App\Helpers\TranslationHelper::translate('Check All')}}</label>
        </h3>

        @if($method == 'PUT')
            @foreach($permissions_grouped as $group => $permissions)
                <div class="col-lg-4 col-md-6 col-12 d-flex"> <!-- إضافة d-flex هنا لجعل العناصر متساوية الطول -->
                    <div class="card p-5 mb-5 flex-fill"> <!-- flex-fill لضمان أن العناصر تملأ الفراغ بالتساوي -->
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                        </div>
                        <div class="row p-3">
                            @foreach($permissions as $permission)
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="{{$group.'.'.$permission['name']}}"
                                           name="permissions[]"
                                           id="{{$group . '_' . $permission['name']}}" {{isset($selected_roles) ? (in_array(($group.'.'.$permission['name']), $selected_roles) ? 'checked' : '') : ''}}>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($permissions_grouped as $group => $permissions)
                <div class="col-lg-4 col-md-6 col-12 d-flex"> <!-- إضافة d-flex هنا لجعل العناصر متساوية الطول -->
                    <div class="card p-5 mb-5 flex-fill"> <!-- flex-fill لضمان أن العناصر تملأ الفراغ بالتساوي -->
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3>{{ \App\Helpers\TranslationHelper::translate($group) }}</h3>
                        </div>
                        <div class="row p-3">
                            @foreach($permissions as $permission)
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="{{$group.'.'.$permission['name']}}"
                                           name="permissions[]"
                                           id="{{$group . '_' . $permission['name']}}" {{old('permissions') ? (in_array($permission['id'], old('permissions')) ? 'checked' : '') : ''}}>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="{{$group . '_' . $permission['name']}}">{{\App\Helpers\TranslationHelper::translate($permission['name'])}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>







                                        {{--                                        @foreach ($permissions as $model => $names)--}}
                                        {{--                                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">--}}

                                        {{--                                                <div class="card mb-3">--}}
                                        {{--                                                    <div class="card-header">--}}
                                        {{--                                                        <h3>{{ $model }}</h3>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="card-body">--}}
                                        {{--                                                        <div class="form-check">--}}
                                        {{--                                                            @foreach ($names as $name)--}}
                                        {{--                                                                <div class="mb-2">--}}
                                        {{--                                                                    <input class="form-check-input" type="checkbox"--}}
                                        {{--                                                                           name="permissions[]"--}}
                                        {{--                                                                           id="{{ $name->id }}"--}}
                                        {{--                                                                           value="{{ $name->id }}" {{ in_array($name->id, $assignedPermissions ?? []) ? 'checked' : '' }}>--}}
                                        {{--                                                                    <label class="form-check-label"--}}
                                        {{--                                                                           for="{{ $name->id }}">--}}
                                        {{--                                                                        {{ $name->name }}--}}
                                        {{--                                                                    </label>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            @endforeach--}}
                                        {{--                                                            --}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endforeach--}}
                                   
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{\App\Helpers\TranslationHelper::translate('Save')}}</span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                </div>

    <!--end::Content-->

@endsection
@push('admin_js')
    <script>
        let perm_inp = $('.perm_inp');

        function changeAllPerm(check) {
            if ($(check).is(':checked')) {
                perm_inp.prop('checked', true);
            } else {
                perm_inp.prop('checked', false);

            }
        }
    </script>
@endpush
