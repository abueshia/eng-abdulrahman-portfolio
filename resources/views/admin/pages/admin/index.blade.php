@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Admins'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Admins'),'link'=>route('admin.admin.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')
    {{--    <link href="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
@endpush

@section('content')



    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card-toolbar w-100 mb-7">
                <div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar">
                    <div class="left-part">
                          @if (auth()->guard('admin')->user()->can('admins.create', 'admin'))
                        <a href="{{ route('admin.admin.create') }}" class="btn btn-primary text-gray-800">
                            <i class="ki-duotone ki-plus fs-2  text-gray-800"></i>
                            {{\App\Helpers\TranslationHelper::translate('Create Admin')}}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                   id="kt_table_users">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Name')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Email')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Role')}}</th>
                     <th>{{\App\Helpers\TranslationHelper::translate('Branch')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Created_at')}}</th>
                    <th>{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@endsection

@push('admin_js')
     <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        
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
    buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    order: [[0, "desc"]],
    ajax: {
        url: '{{ route('admin.admin.table') }}',
        data: function (d) {
            d.name = $('#name').val(); 
            d.role_name = $('#role_name').val(); 
            d.branche_name = $('#branche_name').val();
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'},
        {data: 'name', name: 'name', defaultContent: '-'},
        {data: 'email', name: 'email', defaultContent: '-'},
        {data: 'role_name', name: 'role_name', defaultContent: '-'},
        {data: 'branche_name', name: 'branche_name', defaultContent: '-'},
        {data: 'created_at', name: 'created_at', defaultContent: '-'},
        {data: 'action', orderable: false, searchable: false, className: 'text-center'}
    ],
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    },
});

    </script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
