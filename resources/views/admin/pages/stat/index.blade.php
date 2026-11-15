@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Statistics'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Statistics'), 'link' => route('admin.stat.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('List')],
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card-toolbar w-100 mb-7">
                <div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar">
                    <div class="left-part d-flex gap-3">
                        @if (auth()->guard('admin')->user()?->can('stats.create', 'admin'))
                            <a href="{{ route('admin.stat.create') }}" class="btn btn-primary text-gray-800">
                                <i class="ki-duotone ki-plus fs-2 text-gray-800"></i>
                                {{ \App\Helpers\TranslationHelper::translate('Create Statistic') }}
                            </a>
                        @endif

                        @if (auth()->guard('admin')->user()?->can('stats.sort', 'admin'))
                            <a href="{{ route('admin.stat.reorder') }}" class="btn btn-light-primary">
                                <i class="ki-solid ki-sort fs-2"></i>
                                {{ \App\Helpers\TranslationHelper::translate('Sort Items') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                           id="kt_table_stats">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Icon') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Label') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Value') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Active') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.delete-modal', ['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])
@endsection

@push('admin_js')
    <script src="{{ asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $('#kt_table_stats').DataTable({
            serverSide: true,
            processing: true,
            fixedHeader: true,
            orderCellsTop: true,
            language: {
                @if (App::getLocale() === 'ar')
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
                @else
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
                @endif
            },
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end'B>>
                  <'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, "asc"]],
            ajax: {
                url: '{{ route('admin.stat.table') }}',
            },
            columns: [
                {data: 'id', name: 'id', defaultContent: '-'},
                {data: 'icon', name: 'icon', defaultContent: '-', orderable: false, searchable: false},
                {data: 'label', name: 'label', defaultContent: '-'},
                {data: 'display_value', name: 'value', defaultContent: '-'},
                {data: 'is_active', name: 'is_active', defaultContent: '-'},
                {data: 'action', orderable: false, searchable: false, className: 'text-center'}
            ],
            createdRow: function (row, data) {
                $(row).attr('id', 'row-' + data['id']);
            }
        });
    </script>
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush

