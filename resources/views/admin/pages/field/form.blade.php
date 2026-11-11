@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Field'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Field'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Fields'),'link'=>route('admin.field.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]"
                   :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Fields'),'link'=>route('admin.field.index')]">
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
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="field_form">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$field->id}}">

                            @endif
                            <!--begin::Input field-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-2">
                                                    {{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                    <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid inp_"
                                                       value="{{ old('name.'.$key) ?? $field->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="group_id" id="group_id"
                                                    class="form-control form-control-solid inp_">
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Choose Group')}}</option>
                                                @if($method == 'PUT')
                                                    @foreach($groups as $group)
                                                        <option
                                                            value="{{$group->id}}" {{  $field->group_id == $group->id ? 'selected' : ''}}>
                                                            {{$group->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach($groups as $group)
                                                        <option
                                                            value="{{$group->id}}" {{  old('group_id') == $group->id ? 'selected' : ''}}>
                                                            {{$group->name}}
                                                        </option>
                                                    @endforeach

                                                @endif
                                            </select>
                                            @error('group_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Status')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" id="status"
                                                    class="form-control form-control-solid inp_">
                                                @if($method == 'PUT')
                                                    <option value="1" {{  $field->status == '1' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Active')}}
                                                    </option>
                                                    <option value="0" {{  $field->status == '0' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Inactive')}}
                                                    </option>
                                                @else
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Active')}}
                                                    </option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Inactive')}}
                                                    </option>

                                                @endif
                                            </select>
                                            {{--                                            @dd(old('status'))--}}

                                            @error('status')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Is Required ?')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="is_required" id="is_required"
                                                    class="form-control form-control-solid inp_">
                                                @if($method == 'PUT')
                                                    <option
                                                        value="1" {{  $field->is_required == '1' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                    </option>
                                                    <option
                                                        value="0" {{  $field->is_required == '0' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                    </option>
                                                @else
                                                    <option value="1" {{ old('is_required') == '1' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                    </option>
                                                    <option value="0" {{ old('is_required') == '0' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                    </option>

                                                @endif
                                            </select>

                                            @error('is_required')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-2">{{\App\Helpers\TranslationHelper::translate('Choose Type')}}
                                                :
                                                <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="type" id="type" onchange="changeValue(this)"
                                                    class="form-control form-control-solid inp_">
                                                <option
                                                    value="">{{\App\Helpers\TranslationHelper::translate('Choose Type')}}</option>
                                                @if($method == 'PUT')
                                                    <option value="text" {{  $field->type == 'text' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Text')}}
                                                    </option>
                                                    <option
                                                        value="textarea" {{  $field->type == 'textarea' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Textarea')}}
                                                    </option>
                                                    <option
                                                        value="date" {{  $field->type == 'date' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Date')}}
                                                    </option>
                                                    <option
                                                        value="time" {{  $field->type == 'time' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Time')}}
                                                    </option>
                                                    <option
                                                        value="number" {{  $field->type == 'number' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Number')}}
                                                    </option>
                                                    <option
                                                        value="dropdown" {{  $field->type == 'dropdown' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Dropdown')}}
                                                    </option>
                                                    <option
                                                        value="radio" {{  $field->type == 'radio' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Radio')}}
                                                    </option>
                                                    <option value="link" {{  $field->type == 'link' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Link')}}
                                                    </option>
                                                    <option value="image" {{  $field->type == 'image' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Image')}}
                                                    </option>
                                                @else
                                                    <option value="text" {{  old('type') == 'text' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Text')}}
                                                    </option>
                                                    <option
                                                        value="textarea" {{  old('type') == 'textarea' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Textarea')}}
                                                    </option>
                                                    <option
                                                        value="date" {{  old('type') == 'date' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Date')}}
                                                    </option>
                                                    <option
                                                        value="time" {{  old('type') == 'time' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Time')}}
                                                    </option>
                                                    <option
                                                        value="number" {{  old('type') == 'number' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Number')}}
                                                    </option>
                                                    <option
                                                        value="dropdown" {{  old('type') == 'dropdown' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Dropdown')}}
                                                    </option>
                                                    <option
                                                        value="radio" {{  old('type') == 'radio' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Radio')}}
                                                    </option>
                                                    <option value="link" {{  old('type') == 'link' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Link')}}
                                                    </option>
                                                    <option value="image" {{  old('type') == 'image' ? 'selected' : ''}}>
                                                        {{\App\Helpers\TranslationHelper::translate('Image')}}
                                                    </option>
                                                @endif
                                            </select>
                                            @error('type')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mt-5" id="options_card" style="display: {{isset($field) && $field->options->count() > 0 ? '' : 'none'}}">
                                        <div class="col-lg-12">
                                            <h3 class="mb-5">{{\App\Helpers\TranslationHelper::translate('Options List')}}
                                                :</h3>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="options_container" id="options_container">

                                                @if(isset($field))
                                                    @if($field->options->count() > 0)
                                                        @foreach($field->options as $k => $option)
                                                            @if($k == 0)
                                                                <div class="row include_item mb-3" data-index="{{$k+1}}">
                                                                    <div class="col-lg-5">
                                                                        <input type="text" name="options[1][en]"
                                                                               class="form-control form-control-solid inp_opt"
                                                                               value="{{$option->getTranslation('name', 'en')}}"
                                                                               placeholder="Enter Option Value in English">
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <input type="text" name="options[1][ar]"
                                                                               class="form-control form-control-solid inp_opt"
                                                                               value="{{$option->getTranslation('name', 'ar')}}"
                                                                               placeholder="Enter Option Value in Arabic">
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <button type="button"
                                                                                class="btn btn-warning w-100 bold"
                                                                                onclick="plusGeneralOptionItem(this)">
                                                                            Add +
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="row include_item mb-3" data-index="{{$k+1}}">
                                                                    <div class="col-lg-5">
                                                                        <input type="text" name="options[{{$k+1}}][en]"
                                                                               class="form-control form-control-solid inp_opt"
                                                                               value="{{$option->getTranslation('name', 'en')}}"
                                                                               placeholder="Enter Option Value in English">
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <input type="text" name="options[{{$k+1}}][ar]"
                                                                               class="form-control form-control-solid inp_opt"
                                                                               value="{{$option->getTranslation('name', 'ar')}}"
                                                                               placeholder="Enter Option Value in Arabic">
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <button type="button"
                                                                                class="btn btn-danger w-100 bold"
                                                                                onclick="deleteOptionItem(this)">
                                                                            Delete
                                                                            <i class='fa fa-trash-can'></i>

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    @else
                                                        <div class="row include_item mb-3" data-index="1">
                                                            <div class="col-lg-5">
                                                                <input type="text" name="options[1][en]"
                                                                       class="form-control form-control-solid inp_opt"
                                                                       placeholder="Enter Option Value in English">
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <input type="text" name="options[1][ar]"
                                                                       class="form-control form-control-solid inp_opt"
                                                                       placeholder="Enter Option Value in Arabic">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <button type="button" class="btn btn-warning w-100 bold"
                                                                        onclick="plusGeneralOptionItem(this)">
                                                                    Add +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else

                                                    <div class="row include_item mb-3" data-index="1">
                                                        <div class="col-lg-5">
                                                            <input type="text" name="options[1][en]"
                                                                   class="form-control form-control-solid inp_opt"
                                                                   placeholder="Enter Option Value in English">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="text" name="options[1][ar]"
                                                                   class="form-control form-control-solid inp_opt"
                                                                   placeholder="Enter Option Value in Arabic">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="btn btn-warning w-100 bold"
                                                                    onclick="plusGeneralOptionItem(this)">
                                                                Add +
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input field-->

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
            let group_id = $("#group_id");
            group_id.select2();

            let status = $("#status");
            status.select2();

            let is_required = $("#is_required");
            is_required.select2();


            let type = $("#type");
            type.select2();

            let field_form = $("#field_form");
            let submit_btn = $("#submit_btn");
            let all_inputs = field_form.find('input.inp_');

            submit_btn.on('click', function (e) {
                e.preventDefault();

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
                let emptyOptions = [];
                if (type.val() === 'dropdown' || type.val() === 'radio') {
                    emptyOptions = $('.inp_opt').filter(function () {
                        if ($(this).is('input') || $(this).is('textarea')) {
                            return $(this).val().trim() === '';
                        } else if ($(this).is('select')) {
                            return $(this).val() === '' || $(this).val() === '-1';
                        }
                    });

                    if (emptyOptions.length > 0) {
                        emptyOptions.each(function () {

                            if ($(this).is('select')) {
                                if ($(this).parent().find('.error-message').length < 1) {
                                    $(this).parent().append('<span class="error-message text-danger">This field is required.</span>');
                                }
                            } else {
                                if ($(this).parent().find('.error-message').length < 1) {
                                    $(this).after('<span class="error-message text-danger">This field is required.</span>');
                                }
                            }
                        });
                    }
                }

                if (emptyInputs.length < 1 && emptyOptions.length < 1) {
                    field_form.submit();
                }
            });

        });

        function changeValue(dropdown) {
            let options_card = $("#options_card");
            let current_val = $(dropdown).val();
            if (current_val === 'dropdown' || current_val === 'radio') {
                options_card.show()
            } else {
                options_card.hide();
            }
        }

        function plusGeneralOptionItem(btn) {
            let includes = $(btn).parent().parent().parent();
            let current_length = parseInt($('.include_item').last().attr('data-index'));
            includes.append(
                "<div class=\"row include_item mb-3 \" data-index='" + (current_length + 1) + "'>\n" +
                "                <div class=\"col-lg-5\">\n" +
                "                    <input type=\"text\" name=\"options[" + (current_length + 1) + "][en]\" class=\"form-control form-control-solid inp_opt\"\n" +
                "                           placeholder=\"Enter Option Value in English\">\n" +
                "                </div>\n" +
                "                <div class=\"col-lg-5\">\n" +
                "                    <input type=\"text\" name=\"options[" + (current_length + 1) + "][ar]\" class=\"form-control form-control-solid inp_opt\"\n" +
                "                           placeholder=\"Enter Option Value in Arabic\">\n" +
                "                </div>\n" +
                "<div class=\"col-lg-2\">\n" +
                "                    <button type=\"button\" class=\"btn btn-danger w-100 bold\" onclick=\"deleteOptionItem(this)\">\n" +
                "                            Delete " +
                "<i class='fa fa-trash-can'></i>" +
                "\n" +
                "                    </button>\n" +
                "                </div>" +
                "            </div>"
            );
        }


        function deleteOptionItem(btn) {
            let current_row = $(btn).parent().parent();
            current_row.remove();
        }


    </script>

@endpush
