@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Termsandconditions'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Termsandconditions'),'link'=>route('admin.termsandcondition.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')

@endpush

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card toolbar-->
            <div class="card-toolbar w-100 mb-7">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar">
                    <div class="left-part">
                        <!--begin::Add Service-->

{{--                        @can('place_termsandconditions.create')--}}
                           {{-- @if (auth()->guard('admin')->user()->can('termsandcondition.create', 'admin'))
                            <a href="{{ route('admin.termsandcondition.create') }}" class="btn btn-primary text-gray-800">
                                <i class="ki-duotone ki-plus fs-2  text-gray-800"></i>
                                {{\App\Helpers\TranslationHelper::translate('Create Termsandcondition')}}
                            </a>
                            @endif --}}

{{--                        @endcan--}}

 {{-- @if (auth()->guard('admin')->user()->can('termsandcondition.sort', 'admin'))
                            <a href="{{ route('admin.termsandcondition.reorder') }}" class="btn btn-primary text-gray-800"
                               style="margin-left: 12px;">
                                <i class="ki-solid ki-sort fs-2  text-gray-800"></i>
                                {{\App\Helpers\TranslationHelper::translate('Sort Items')}}
                            </a>
@endif --}}

                    <!--end::Add Service-->
                    </div>

                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
            </div>
            <!--end::Card toolbar-->
            <!--begin::Table-->


            <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                   id="kt_table_users">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('description')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Date')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
                </tr>
                </thead>
            </table>

            <!--end::Table-->
        </div>
    </div>

    <!--end::Content-->
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@endsection

@push('admin_js')
    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        // begin first table
var table1 = $('#kt_table_users').DataTable({
    serverSide: true,
    processing: true,
    fixedHeader: true,
    orderCellsTop: true,
    language: {
        @if(App::getLocale() == 'ar')
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",  // اللغة العربية
        @else
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",  // اللغة الإنجليزية
        @endif
    },

    ajax: {
        url: '{{ route('admin.termsandcondition.table') }}',
        data: function (d) {
            d.name = $('#name').val(); 
        }
    },


    columns: [
        { data: 'id', name: 'id', defaultContent: '-' },
        { data: 'description', name: 'description', defaultContent: '-' },
        { data: 'created_at', name: 'created_at', defaultContent: '-' },
        { data: 'action', orderable: false, searchable: false, className: 'text-center' }
    ],

    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']); 
    }
});


$('#name').on('keyup change', function () {
    table1.draw();
});

    </script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
