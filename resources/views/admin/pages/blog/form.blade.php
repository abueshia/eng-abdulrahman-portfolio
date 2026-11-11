@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    @if(App::getLocale() == 'ar')

@endif

@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Blog'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Blog'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Blogs'), 'link' => route('admin.blog.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]"
                   :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Blog'), 'link' => route('admin.blog.index')]">
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
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $blog->id }}">
                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        {{-- @foreach (Config('language') as $key => $lang) --}}
                                        {{-- <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Name') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   value="{{ old('name') ?? $blog->name }}"
                                                   placeholder="{{ \App\Helpers\TranslationHelper::translate('Name') }}"
                                                   name="name"/>
                                            @error('name')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                                 @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $blog->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                      @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description[{{ $key }}]" rows="5" id="description{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description.'.$key) ?? $blog->getTranslation('description', $key) }}</textarea>
        @error('description.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach

                                        
{{-- <div class="col-12 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Description') }}</label>
    <textarea 
        class="form-control form-control-solid full-editor arabic-numbers" 
        name="description" 
        rows="5" 
        id="description1" 
        style="height: 300px; direction: rtl; unicode-bidi: bidi-override; font-family: 'Tajawal', Arial, sans-serif;">
        {{ old('description') ?? $blog->description }}
    </textarea>

    @error('description')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


                                   <div class="col-6  mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Image') }}
                                                : <span class="text-danger">
                                                    {{ \App\Helpers\TranslationHelper::translate('Size') }} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <input type="file" class="form-control form-control-solid" name="image"/>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if ($blog->getFirstMediaUrl('blogs_image') != null)
                                                <img src="{{ $blog->getFirstMediaUrl('blogs_image') }}" alt="blogs"
                                                     width="100px" style="border-radius: 5px">
                                            @endif
                                        </div>



{{-- 
                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Category') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="category_id">
                                                <option
                                                    value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                        {{-- @endforeach --}}

                          

                                        {{-- <div class="col-12  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Description') }}
                                            </label>
                                            <!--end::Label-->
                                            <textarea class="form-control form-control-solid full-editor"
                                                      name="description" rows="5" id="description1"
                                                      style="height: 300px; direction: rtl;">{{ old('description') ?? $blog->description }}</textarea>

                                                       <textarea
    class="form-control form-control-solid full-editor"
    name="description"
    rows="5"
    id="description1"
    style="height: 300px; direction: rtl; text-align: right;">
    {{ old('description') ?? $blog->description }}
     </textarea>


                                            @error('description')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}




{{-- 
                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Image') }}
                                                : <span class="text-danger">
                                                    {{ \App\Helpers\TranslationHelper::translate('Size') }} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid"
                                                   name="meta_image"/>
                                            @error('meta_image')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if ($blog->getFirstMediaUrl('blogs_meta_image') != null)
                                                <img src="{{ $blog->getFirstMediaUrl('blogs_meta_image') }}" alt="blogs"
                                                     width="100px" style="border-radius: 5px">
                                            @endif
                                        </div>

                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Title') }}
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" name="meta_title"
                                                   value="{{ old('meta_title') ?? $blog->meta_title }}"/>
                                            @error('meta_title')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

{{-- 
                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('alt_text') }}
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" name="alt_text"
                                                   value="{{ old('alt_text') ?? $blog->alt_text }}"/>
                                            @error('alt_text')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-6  mb-5" id="-meta-tags">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_tags') }}
                                            </label>
                                            <select name="meta_tags[]" id="meta_tags" class="form-control" multiple>
                                                @if(isset($tags) && $tags->count() > 0)
                                                    @if($method == 'PUT')
                                                        @foreach($tags as $tag)
                                                            <option value="{{$tag->id}}" {{in_array($tag->id, $blog->tags()->pluck('tag_id')->toArray()) ? 'selected' : ''}}>{{$tag->name}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($tags as $tag)
                                                            <option value="{{$tag->id}}" {{old('meta_tags') ? (in_array($tag->id, old('meta_tags')) ? 'selected' : '') : ''}}>{{$tag->name}}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>

                                            @error('meta_tags')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                        {{-- <div class="col-6 form-group lang_form col-6"
                                              id="-meta-tags">
                                             <label class="col-6"
                                                    class="title-color">{{ \App\Helpers\TranslationHelper::translate('meta_tags') }}

                                                 </label>
                                             <input type="text" class="form-control"
                                                    name="meta_tags[]"
                                                    value=""
                                                    id="_meta_tags" data-role="tagsinput">
                                         </div> --}}


                                        {{-- <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Description') }}
                                            </label>
                                            <!--end::Label-->
                                            <textarea class="form-control form-control-solid" name="meta_description"
                                                      rows="5"
                                                      style="">{{ old('meta_description') ?? $blog->meta_description }}</textarea>
                                            @error('meta_description')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}




                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
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
{{-- <script src="/path-to-your-js-file/custom.js"></script> --}}
    <script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>








    <script>
        $(document).ready(function() {
            $('#meta_tags').select2({
                tags: true,
                placeholder: 'Select or create options',
                allowClear: true
            });
        });
    </script>



{{-- <script>
    tinymce.init({
    selector: '#description1',
    directionality: 'rtl',
    content_css: '//fonts.googleapis.com/css?family=Tajawal',
    plugins: 'directionality',
    toolbar: 'ltr rtl',
    setup: function (editor) {
        editor.on('init', function () {
            if (document.documentElement.lang === 'ar') {
                editor.getBody().style.direction = 'rtl';
                editor.getBody().style.fontFamily = "'Tajawal', Arial, sans-serif";
            }
        });
    }
});
</script> --}}




 
@endpush

