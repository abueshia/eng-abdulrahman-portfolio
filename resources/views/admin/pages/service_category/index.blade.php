@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Service Categories'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Service Categories'),'link'=>route('admin.service_category.index')],
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
                        @can('service_categories.create')

                            <a href="{{ route('admin.service_category.create') }}"
                               class="btn btn-primary text-gray-800">
                                <i class="ki-duotone ki-plus fs-2  text-gray-800"></i>
                                {{\App\Helpers\TranslationHelper::translate('Create Service Category')}}
                            </a>
                        @endcan
                        @can('service_categories.sort')

                            <a href="{{ route('admin.service_category.reorder') }}"
                               class="btn btn-primary text-gray-800"
                               style="margin-left: 12px;">
                                <i class="ki-solid ki-sort fs-2  text-gray-800"></i>
                                {{\App\Helpers\TranslationHelper::translate('Sort Items')}}
                            </a>
                    @endcan


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
                    <th>{{\App\Helpers\TranslationHelper::translate('Image')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Name')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Created_at')}}</th>
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
            orderCellsTop: true,
            fixedHeader: true,
            language: {
                @if(App::getLocale()=='ar')
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
                @else
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
                @endif
            },
            processing: true,

            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>>
                      <'row'<'col-sm-12'tr>>
                      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5',],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, "desc"]],
            ajax: {
                url: '{{ route('admin.service_category.table') }}',
                data: function (d) {
                    d.id = $('#id').val();
                    d.name = $('#name').val();
                    d.created_at = $('#created_at').val();
                }

            },
            columns: [
                {data: 'id', name: 'id', defaultContent: '-'},
                {data: 'image', name: 'image', defaultContent: '-', orderable: false, searchable: false},
                {data: 'name', name: 'name', defaultContent: '-'},
                // {data: 'code', name: 'code', defaultContent: '-'},
                {data: 'created_at', name: 'created_at', defaultContent: '-'},
                {data: 'action', orderable: false, searchable: false, className: 'text-center'}

            ], createdRow: function (row, data, index) {
                $(row).attr('id', 'row-' + data['id']);
            },
        });
    </script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
