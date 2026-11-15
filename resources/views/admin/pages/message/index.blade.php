@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Contact Messages'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Contact Messages'), 'link' => route('admin.message.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('List')],
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-6">
                <div class="card-body py-5">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">{{ \App\Helpers\TranslationHelper::translate('Filter by Type') }}</label>
                            <select id="filter_message_type" class="form-select form-select-solid">
                                <option value="">{{ \App\Helpers\TranslationHelper::translate('All Types') }}</option>
                                @foreach ($messageTypes as $typeValue => $typeLabel)
                                    <option value="{{ $typeValue }}">{{ $typeLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">{{ \App\Helpers\TranslationHelper::translate('Filter by Status') }}</label>
                            <select id="filter_message_status" class="form-select form-select-solid">
                                <option value="">{{ \App\Helpers\TranslationHelper::translate('All Statuses') }}</option>
                                @foreach ($messageStatuses as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}">{{ $statusLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                           id="kt_table_messages">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Name') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Email') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Phone') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Type') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Subject') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Status') }}</th>
                            <th>{{ \App\Helpers\TranslationHelper::translate('Date') }}</th>
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
        const messagesTable = $('#kt_table_messages').DataTable({
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
            order: [[0, "desc"]],
            ajax: {
                url: '{{ route('admin.message.table') }}',
                data: function (d) {
                    d.type = $('#filter_message_type').val();
                    d.status = $('#filter_message_status').val();
                }
            },
            columns: [
                {data: 'id', name: 'id', defaultContent: '-'},
                {data: 'name', name: 'name', defaultContent: '-'},
                {data: 'email', name: 'email', defaultContent: '-'},
                {data: 'phone', name: 'phone', defaultContent: '-'},
                {data: 'type', name: 'type', defaultContent: '-'},
                {data: 'subject', name: 'subject', defaultContent: '-'},
                {data: 'status', name: 'status', defaultContent: '-'},
                {data: 'created_at', name: 'created_at', defaultContent: '-'},
                {data: 'action', orderable: false, searchable: false, className: 'text-center'}
            ],
            createdRow: function (row, data) {
                $(row).attr('id', 'row-' + data['id']);
            }
        });

        $('#filter_message_type, #filter_message_status').on('change', function () {
            messagesTable.ajax.reload();
        });
    </script>
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
