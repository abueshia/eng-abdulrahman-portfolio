<!--begin::Toolbar-->

<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->

    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1
            class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
            @if(isset($title) && $title != '')
                {{$title}}
            @else
                {{\App\Helpers\TranslationHelper::translate('Dashboard')}}
            @endif
        </h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('admin.index') }}"
                   class="text-muted text-hover-primary"> {{\App\Helpers\TranslationHelper::translate('Dashboard')}} </a>
            </li>
            <!--end::Item-->
            @foreach ($breadcrumbs as $bread)
                @if($bread != null)
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted {{ $bread['active'] ?? '' }}">
                        @if(array_key_exists('link' , $bread))
                            <a href="{{ $bread['link']  }}"> {{ $bread['text'] }} </a>
                        @else
                            {{ $bread['text'] }}
                        @endif
                    </li>
                @endif
            @endforeach

        </ul>
        <!--end::Breadcrumb-->
    </div>
    @if(!empty($button))
        <div class="d-flex align-items-center py-1 mx-5">
            <a href="{{  $button['link'] ?? '#'  }}" class="btn btn-sm btn-primary">{{ $button['text'] ?? '#'  }}</a>
        </div>
@endif
<!--end::Page title-->
</div>

