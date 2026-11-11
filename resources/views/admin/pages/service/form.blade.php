@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Service'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Service'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Service'),'link'=>route('admin.service.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]"
                   :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Service'),'link'=>route('admin.service.index')]">
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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form action="{{ $action }}" method="POST" id="field_form" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$service->id}}">
                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row align-items-center">
                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-2">
                                                    {{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid inp_"
                                                       value="{{ old('name.'.$key) ?? $service->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        @endforeach
                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-2">
                                                    {{\App\Helpers\TranslationHelper::translate('Description in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea class="form-control form-control-solid" rows="4"
                                                          placeholder="{{\App\Helpers\TranslationHelper::translate('Description in')}} {{__('methods.' . $lang)}}"
                                                          name="description[{{ $key}}]">{{ old('description.'.$key) ?? $service->getTranslation('description',$key)}}</textarea>
                                                @error('description.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        @endforeach
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Category')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="category_id" id="category_id"
                                                    class="form-control form-control-solid inp_">
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Choose Category')}}</option>
                                                @if($method == 'PUT')
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{$category->id}}" {{  $service->category_id == $category->id ? 'selected' : ''}}>
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{$category->id}}" {{  old('category_id') == $category->id ? 'selected' : ''}}>
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach

                                                @endif
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose SubCategory')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="sub_category_id" id="sub_category_id"
                                                    class="form-control form-control-solid inp_" disabled>
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Choose SubCategory')}}</option>

                                            </select>
                                            @error('sub_category_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label for="pay_cash"
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Pay With Cash')}}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <div class="form-check form-switch text-start custom_form_switch ms-5 p-0 d-inline-block">
                                                <input class="form-check-input status_switch custom_switch m-0"
                                                       type="checkbox" name="pay_cash" id="pay_cash" value="1"
                                                       style="float: none" {{$service->pay_cash == 1 ? 'checked' : ''}}>
                                            </div>
                                            @error('pay_cash')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label for="pay_card"
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Pay With Card')}}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <div class="form-check form-switch text-start custom_form_switch ms-5 p-0 d-inline-block">
                                                <input class="form-check-input status_switch custom_switch m-0"
                                                       type="checkbox" name="pay_card" id="pay_card" value="1"
                                                       style="float: none" {{$service->pay_card == 1 ? 'checked' : ''}}>
                                            </div>
                                            @error('pay_card')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Image')}}
                                                : <span
                                                    class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid @if($method != 'PUT') inp_ @endif"
                                                   name="image"/>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if($service->getFirstMediaUrl('services') != null)
                                                <img src="{{ $service->getFirstMediaUrl('services') }}"
                                                     alt="services" width="100px"
                                                     style="border-radius: 5px">
                                            @endif
                                        </div>




                                    </div>
                                    <div class="row">

                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Fields By')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Provider')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="fields_by" id="fields_by" onchange="changeFieldBy(this)"
                                                    class="form-control form-control-solid inp_">
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Fields By')}}</option>
                                                <option
                                                    value="group">{{\App\Helpers\TranslationHelper::translate('Group')}}</option>
                                                <option
                                                    value="field">{{\App\Helpers\TranslationHelper::translate('Field')}}</option>

                                            </select>
                                            @error('fields_by')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5" id="groups_div" style="display: none">
                                            <div class="row align-items-end">
                                                <div class="col-lg-9 col-9">
                                                    <label
                                                        class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}
                                                        ({{\App\Helpers\TranslationHelper::translate('For Provider')}}) :
                                                        <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="group_id" id="group_id" onchange="selectGroup(this)"
                                                            class="form-control form-control-solid">
                                                        <option
                                                            value="">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}</option>
                                                        @if(isset($groups) && $groups->count() > 0)
                                                            @foreach($groups as $group)
                                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('group_id')
                                                    <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3 col-2 pb-3">
                                                    <div>
                                                        <label class="form-check form-check-custom form-check-solid"
                                                               for="all_group">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="all_group" name="all_group"
                                                                   onchange="changeFullGroup(this)" checked>
                                                            <span class="form-check-label fw-semibold" for="all_group">Full Group</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-5" id="group_fields_div" style="display: none">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Group Fields')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Provider')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="group_fields_ids[]" id="group_fields_ids" multiple
                                                    class="form-control form-control-solid">
                                            </select>
                                            @error('group_fields_ids')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5" id="fields_div" style="display: none">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Fields')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Provider')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="field_ids[]" id="field_ids" multiple
                                                    class="form-control form-control-solid">
                                                @if(isset($fields) && $fields->count() > 0)
                                                    @foreach($fields as $field)
                                                        <option value="{{$field->id}}">{{$field->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('field_ids')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Fields By')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Client')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="fields_by_client" id="fields_by_client" onchange="changeFieldByClient(this)"
                                                    class="form-control form-control-solid inp_">
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Fields By')}}</option>
                                                <option
                                                    value="group">{{\App\Helpers\TranslationHelper::translate('Group')}}</option>
                                                <option
                                                    value="field">{{\App\Helpers\TranslationHelper::translate('Field')}}</option>

                                            </select>
                                            @error('fields_by_client')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5" id="groups_div_client" style="display: none">
                                            <div class="row align-items-end">
                                                <div class="col-lg-9 col-9">
                                                    <label
                                                        class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}
                                                        ({{\App\Helpers\TranslationHelper::translate('For Client')}}) :
                                                        <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="group_id_client" id="group_id_client" onchange="selectGroupClient(this)"
                                                            class="form-control form-control-solid">
                                                        <option
                                                            value="">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}</option>
                                                        @if(isset($groups) && $groups->count() > 0)
                                                            @foreach($groups as $group)
                                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('group_id_client')
                                                    <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3 col-2 pb-3">
                                                    <div>
                                                        <label class="form-check form-check-custom form-check-solid"
                                                               for="all_group_client">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="all_group_client" name="all_group_client"
                                                                   onchange="changeFullGroupClient(this)" checked>
                                                            <span class="form-check-label fw-semibold" for="all_group_client">Full Group</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-5" id="group_fields_div_client" style="display: none">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Group Fields')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Client')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="group_fields_ids_client[]" id="group_fields_ids_client" multiple
                                                    class="form-control form-control-solid">
                                            </select>
                                            @error('group_fields_ids_client')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5" id="fields_div_client" style="display: none">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Fields')}}
                                                ({{\App\Helpers\TranslationHelper::translate('For Client')}}) :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="field_ids_client[]" id="field_ids_client" multiple
                                                    class="form-control form-control-solid">
                                                @if(isset($fields) && $fields->count() > 0)
                                                    @foreach($fields as $field)
                                                        <option value="{{$field->id}}">{{$field->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('field_ids_client')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5" id="submit_btn">
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
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Content-->

@endsection

@push('admin_js')
    <script>
        $(document).ready(function () {
            const lang = "{{app()->getLocale()}}";

            let group_fields_ids = $("#group_fields_ids");
            group_fields_ids.select2();

            let fields_by = $("#fields_by");
            fields_by.select2();

            let group_id = $("#group_id");
            group_id.select2();

            let field_ids = $("#field_ids");
            field_ids.select2();


            let group_fields_ids_client = $("#group_fields_ids_client");
            group_fields_ids_client.select2();

            let fields_by_client = $("#fields_by_client");
            fields_by_client.select2();

            let group_id_client = $("#group_id_client");
            group_id_client.select2();

            let field_ids_client = $("#field_ids_client");
            field_ids_client.select2();



            let category_id = $("#category_id");
            category_id.select2();


            let sub_category_id = $("#sub_category_id");
            sub_category_id.select2();

            category_id.change(function () {
                let current_category_id = $(this).val();
                if (current_category_id !== "") {
                    $.ajax({
                        url: "{{route('admin.getSubCategoriesFromCategory')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: current_category_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            console.log(response);
                            sub_category_id.find('option').remove();
                            if (response.status === 1) {
                                sub_category_id.removeAttr('disabled');
                                let data = response.data;
                                // console.log(data);
                                let html_option = '';
                                let new_data = [];
                                new_data.push({
                                    id: '',
                                    text: '<span>{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}</span>',
                                    html: '<span>{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}</span>',
                                    title: '{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}',
                                });

                                $.each(data, function (i, item) {
                                    new_data.push({
                                        id: item.id,
                                        text: "<span>" + item.name[lang] + "</span>",
                                        html: "<span>" + item.name[lang] + "</span>",
                                        title: item.name[lang]
                                    });
                                });

                                // console.log(new_data);
                                sub_category_id.select2({
                                    data: new_data,
                                    escapeMarkup: function (markup) {
                                        return markup;
                                    },
                                    templateResult: function (data) {
                                        return data.html;
                                    },
                                    templateSelection: function (data) {
                                        return data.text;
                                    }
                                });

                                sub_category_id.val('');
                                sub_category_id.trigger('change');


                            }
                        }
                    });
                } else {
                    sub_category_id.find('option').remove();
                    let empty_data = [];
                    empty_data.push({
                        id: "",
                        text: '<span>{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}</span>',
                        html: '<span>{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}</span>',
                        title: '{{\App\Helpers\TranslationHelper::translate("Choose SubCategory")}}'
                    });

                    sub_category_id.select2({
                        data: empty_data,
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                        templateResult: function (data) {
                            return data.html;
                        },
                        templateSelection: function (data) {
                            return data.text;
                        }
                    });
                    sub_category_id.val('');
                    sub_category_id.trigger('change');
                }
            });

            let field_form = $("#field_form");
            let submit_btn = $("#submit_btn");

            submit_btn.on('click', function (e) {
                e.preventDefault();
                $(".error-message").remove();

                var emptyInputs = $('.inp_').filter(function () {
                    if ($(this).is('input') || $(this).is('textarea')) {
                        return $(this).val().trim() === '';
                    } else if ($(this).is('select')) {
                        return $(this).val() === '' || $(this).val() === '-1';
                    }
                });

                if (emptyInputs.length > 0) {
                    emptyInputs.each(function () {

                        if ($(this).is('select')) {
                            if ($(this).parent().find('.error-message').length < 1) {
                                $(this).parent().append('<span class="error-message text-danger">This field is required.</span>');
                            }
                        } else {
                            if ($(this).parent().find('.error-message').length < 1) {
                                $(this).after('<span class="error-message text-danger">This field is required.</span>');
                            }
                        }

                        if ($(this).parent().parent().hasClass('day_includes_item')) {
                            $(this).parent().parent().parent().show();
                        }


                    });
                }

                let errors = 0;
                let fields_by = $("#fields_by");
                let group_id = $("#group_id");
                let all_group = $("#all_group");
                let group_fields_ids = $("#group_fields_ids");
                let field_ids = $("#field_ids");
                if (fields_by.val() === 'group') {
                    if (group_id.val() === '') {
                        errors++;
                        if (group_id.parent().find('.error-message').length < 1) {
                            group_id.parent().append('<span class="error-message text-danger">Please Choose The Group.</span>');
                        }
                    } else {
                        if (!all_group.is(':checked')) {
                            if (!group_fields_ids.val() || group_fields_ids.val().length === 0) {
                                errors++;
                                if (group_fields_ids.parent().find('.error-message').length < 1) {
                                    group_fields_ids.parent().append('<span class="error-message text-danger">Please Choose At least One Field.</span>');
                                }
                            }
                        }
                    }
                } else {
                    if (!field_ids.val() || field_ids.val().length === 0) {
                        errors++;
                        if (field_ids.parent().find('.error-message').length < 1) {
                            field_ids.parent().append('<span class="error-message text-danger">Please Choose At least One Field.</span>');
                        }
                    }
                }



                let fields_by_client = $("#fields_by_client");
                let group_id_client = $("#group_id_client");
                let all_group_client = $("#all_group_client");
                let group_fields_ids_client = $("#group_fields_ids_client");
                let field_ids_client = $("#field_ids_client");
                if (fields_by_client.val() === 'group') {
                    if (group_id_client.val() === '') {
                        errors++;
                        if (group_id_client.parent().find('.error-message').length < 1) {
                            group_id_client.parent().append('<span class="error-message text-danger">Please Choose The Group.</span>');
                        }
                    } else {
                        if (!all_group_client.is(':checked')) {
                            if (!group_fields_ids_client.val() || group_fields_ids_client.val().length === 0) {
                                errors++;
                                if (group_fields_ids_client.parent().find('.error-message').length < 1) {
                                    group_fields_ids_client.parent().append('<span class="error-message text-danger">Please Choose At least One Field.</span>');
                                }
                            }
                        }
                    }
                } else {
                    if (!field_ids_client.val() || field_ids_client.val().length === 0) {
                        errors++;
                        if (field_ids_client.parent().find('.error-message').length < 1) {
                            field_ids_client.parent().append('<span class="error-message text-danger">Please Choose At least One Field.</span>');
                        }
                    }
                }


                if (emptyInputs.length < 1 && errors < 1) {
                    field_form.submit();
                }
            });
        });

        function changeFieldBy(fieldBy) {
            let current_field_by = $(fieldBy).val();
            let groups_div = $("#groups_div");
            let fields_div = $("#fields_div");
            let group_fields_div = $("#group_fields_div");
            let all_group = $("#all_group");
            if (current_field_by !== '') {
                if (current_field_by === 'group') {
                    groups_div.show();
                    all_group.prop('checked', true);
                    fields_div.hide();
                } else {
                    groups_div.hide();
                    group_fields_div.hide();

                    fields_div.show();
                }
            } else {
                groups_div.hide();
                fields_div.hide();
            }
        }

        function selectGroup(group_list) {
            let current_group = $(group_list).val();
            let group_fields_ids = $("#group_fields_ids");
            const lang = "{{app()->getLocale()}}";

            if (current_group !== "") {
                $.ajax({
                    url: "{{route('admin.getGroupFields')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: current_group,
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response);
                        group_fields_ids.find('option').remove();
                        if (response.status === 1) {
                            let data = response.data;
                            // console.log(data);
                            let html_option = '';
                            let new_data = [];


                            $.each(data, function (i, item) {
                                new_data.push({
                                    id: item.id,
                                    text: "<span>" + item.name[lang] + "</span>",
                                    html: "<span>" + item.name[lang] + "</span>",
                                    title: item.name[lang]
                                });
                            });

                            // console.log(new_data);
                            group_fields_ids.select2({
                                data: new_data,
                                escapeMarkup: function (markup) {
                                    return markup;
                                },
                                templateResult: function (data) {
                                    return data.html;
                                },
                                templateSelection: function (data) {
                                    return data.text;
                                }
                            });

                            group_fields_ids.find('option').prop("selected", true);
                            group_fields_ids.trigger('change');

                        }
                    }
                });
            } else {
                group_fields_ids.find('option').remove();
                let empty_data = [];


                group_fields_ids.select2({
                    data: empty_data,
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (data) {
                        return data.html;
                    },
                    templateSelection: function (data) {
                        return data.text;
                    }
                });
                group_fields_ids.val('');
                group_fields_ids.trigger('change');
            }
            // alert(current_group);
        }

        function changeFullGroup(full_group_check) {
            let full_group_check_status = $(full_group_check);
            let group_fields_div = $("#group_fields_div");
            if (full_group_check_status.is(':checked')) {
                group_fields_div.hide();
            } else {
                group_fields_div.show();
            }
        }


        function changeFieldByClient(fieldBy) {
            let current_field_by_client = $(fieldBy).val();
            let groups_div_client = $("#groups_div_client");
            let fields_div_client = $("#fields_div_client");
            let group_fields_div_client = $("#group_fields_div_client");
            let all_group_client = $("#all_group_client");
            if (current_field_by_client !== '') {
                if (current_field_by_client === 'group') {
                    groups_div_client.show();
                    all_group_client.prop('checked', true);
                    fields_div_client.hide();
                } else {
                    groups_div_client.hide();
                    group_fields_div_client.hide();

                    fields_div_client.show();
                }
            } else {
                groups_div_client.hide();
                fields_div_client.hide();
            }
        }

        function selectGroupClient(group_list) {
            let current_group_client = $(group_list).val();
            let group_fields_ids_client = $("#group_fields_ids_client");
            const lang = "{{app()->getLocale()}}";

            if (current_group_client !== "") {
                $.ajax({
                    url: "{{route('admin.getGroupFields')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: current_group_client,
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response);
                        group_fields_ids_client.find('option').remove();
                        if (response.status === 1) {
                            let data = response.data;
                            // console.log(data);
                            let html_option = '';
                            let new_data = [];


                            $.each(data, function (i, item) {
                                new_data.push({
                                    id: item.id,
                                    text: "<span>" + item.name[lang] + "</span>",
                                    html: "<span>" + item.name[lang] + "</span>",
                                    title: item.name[lang]
                                });
                            });

                            // console.log(new_data);
                            group_fields_ids_client.select2({
                                data: new_data,
                                escapeMarkup: function (markup) {
                                    return markup;
                                },
                                templateResult: function (data) {
                                    return data.html;
                                },
                                templateSelection: function (data) {
                                    return data.text;
                                }
                            });

                            group_fields_ids_client.find('option').prop("selected", true);
                            group_fields_ids_client.trigger('change');

                        }
                    }
                });
            } else {
                group_fields_ids_client.find('option').remove();
                let empty_data = [];


                group_fields_ids_client.select2({
                    data: empty_data,
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (data) {
                        return data.html;
                    },
                    templateSelection: function (data) {
                        return data.text;
                    }
                });
                group_fields_ids_client.val('');
                group_fields_ids_client.trigger('change');
            }
            // alert(current_group);
        }

        function changeFullGroupClient(full_group_check) {
            let full_group_check_status_client = $(full_group_check);
            let group_fields_div_client = $("#group_fields_div_client");
            if (full_group_check_status_client.is(':checked')) {
                group_fields_div_client.hide();
            } else {
                group_fields_div_client.show();
            }
        }

    </script>

    @if($method == 'PUT')
        <script>
            $(document).ready(function () {

                let category_id = $("#category_id");

                let sub_category_id = $("#sub_category_id");

                category_id.trigger('change');
                setTimeout(function () {
                    sub_category_id.val('{{$service->sub_category_id}}');
                    sub_category_id.trigger('change');
                }, 1000);



                let fields_by = $("#fields_by");
                fields_by.val('{{$service->group_id == null ? 'field' : 'group'}}');
                fields_by.trigger('change');

                let field_ids = $("#field_ids");
                let group_id = $("#group_id");
                let all_group = $("#all_group");
                let group_fields_ids = $("#group_fields_ids");

                @if($service->group_id == null)
                    field_ids.val({{$service->fields->pluck('id')}});
                    field_ids.trigger('change');
                @else
                    group_id.val('{{$service->group_id}}');
                    group_id.trigger('change');
                    setTimeout(function () {
                        all_group.prop('checked', @if($service->full_group == 1) true @else false @endif );
                        all_group.trigger('change');
                        group_fields_ids.val('');
                        group_fields_ids.trigger('change');

                    }, 500);

                    setTimeout(function () {
                        group_fields_ids.val({{$service->group->fields->pluck('id')}});
                        group_fields_ids.trigger('change');
                        }, 1000);

                @endif



                let fields_by_client = $("#fields_by_client");
                fields_by_client.val('{{$service->client_group_id == null ? 'field' : 'group'}}');
                fields_by_client.trigger('change');

                let field_ids_client = $("#field_ids_client");
                let group_id_client = $("#group_id_client");
                let all_group_client = $("#all_group_client");
                let group_fields_ids_client = $("#group_fields_ids_client");

                @if($service->client_group_id == null)
                field_ids_client.val({{$service->clientFields->pluck('id')}});
                field_ids_client.trigger('change');
                @else
                group_id_client.val('{{$service->client_group_id}}');
                group_id_client.trigger('change');
                setTimeout(function () {
                    all_group_client.prop('checked', @if($service->client_full_group == 1) true @else false @endif );
                    all_group_client.trigger('change');
                    group_fields_ids_client.val('');
                    group_fields_ids_client.trigger('change');

                }, 500);

                setTimeout(function () {
                    group_fields_ids_client.val({{$service->clientGroup->fields->pluck('id')}});
                    group_fields_ids_client.trigger('change');
                }, 1000);

                @endif


            });
        </script>
    @endif
@endpush
