@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('code'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('code'),'link'=>route('admin.coupon.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')
    <style>
    .custom-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 18px;
        }

        /* Hide the default checkbox */
        .custom-switch input {
            display: none;
        }

        /* The slider */
        .custom-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 24px;
        }

        .custom-slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .custom-slider {
            background-color: #4caf50;
        }

        input:checked + .custom-slider:before {
            transform: translateX(19px);
        }
    </style>
@endpush

@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!-- Card Toolbar Section -->
        <div class="card-toolbar w-100 mb-7">
            <!-- Left Part: Create Button -->
            <div class="left-part">
                @if (auth()->guard('admin')->user()->can('coupon.create', 'admin'))
                    <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary text-gray-800 mb-3">
                        <i class="ki-duotone ki-plus fs-2 text-gray-800"></i>
                        {{ \App\Helpers\TranslationHelper::translate('Create code') }}
                    </a>
                @endif
            </div>
                
            <!-- Right Part: Filter Section -->
            {{-- <div class="right-part d-flex align-items-center gap-3">
                <input type="text" id="name" class="form-control w-25" placeholder="Search by name">
                <select id="city_id" class="form-control w-25">
                    <option value="">All Cities</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                <input type="text" id="created_at" class="form-control datepicker w-25" placeholder="Search by date">
                <button id="filter" class="btn btn-primary">Filter</button>
            </div>
             --}}
        </div>

        <!-- Table Section -->
        <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer" id="kt_table_users">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Name Group') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('points') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Total code') }}</th>
                     <th>{{ \App\Helpers\TranslationHelper::translate('validate_to') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Date') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Actions') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('is_banned') }}</th>
                </tr>
            </thead>
            <tbody>
                <!-- The content will be filled dynamically using DataTables -->
            </tbody>
        </table>

    </div>
</div>

    <!--end::Content-->
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@endsection

@push('admin_js')
    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />


{{-- 
    <script>
var table1 = $('#kt_table_users').DataTable({
    serverSide: true,
    processing: true,
    fixedHeader: true,
    orderCellsTop: true,
    language: {
        @if(App::getLocale() == 'ar')
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
        @else
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        @endif
    },
    dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>> 
          <'row'<'col-sm-12'tr>> 
          <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
    buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    order: [[0, "desc"]],
    ajax: {
        url: '{{ route('admin.coupon.table') }}',
        data: function (d) {
            d.name = $('#name').val();  // إرسال قيمة البحث عن الجروب
            d.created_at = $('#created_at').val();  // إرسال التاريخ المحدد
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'},
        {
            data: 'name',
            name: 'name',
            defaultContent: '-',
            render: function (data, type, row) {
                return '<a href="{{ route("admin.coupon.show", ":coupon_id") }}'.replace(":coupon_id", row.id) + '">' + data + '</a>';
            }
        },
        {data: 'coupon', name: 'coupon', defaultContent: '-'},
        {data: 'created_at', name: 'created_at', defaultContent: '-'},
        {data: 'action', orderable: false, searchable: false, className: 'text-center'}
    ],
    order: [[0, 'desc']],
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    }
});

// تحديث البيانات عند الكتابة في حقل البحث
$('#name').on('keyup change', function () {
    table1.draw();
});
    </script>
 --}}

 <script>
    $(document).ready(function() {
    var table1 = $('#kt_table_users').DataTable({
        serverSide: true,
        processing: true,
        fixedHeader: true,
        orderCellsTop: true,
        language: {
            @if(App::getLocale() == 'ar')
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
            @else
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
            @endif
        },
        dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>> 
              <'row'<'col-sm-12'tr>> 
              <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[0, "desc"]],
        ajax: {
            url: '{{ route('admin.coupon.table') }}',
            data: function (d) {
                d.name = $('#name').val();  // إرسال قيمة البحث عن الجروب
                d.created_at = $('#created_at').val();  // إرسال التاريخ المحدد
            }
        },
        columns: [
            {data: 'id', name: 'id', defaultContent: '-'},
            {
                data: 'name',
                name: 'name',
                defaultContent: '-',
                render: function (data, type, row) {
                    return '<a href="{{ route("admin.coupon.show", ":coupon_id") }}'.replace(":coupon_id", row.id) + '">' + data + '</a>';
                }
            },

             {data: 'points', name: 'points', defaultContent: '-'},
            
            {data: 'coupon', name: 'coupon', defaultContent: '-'},

            {data: 'validate_to', name: 'validate_to', defaultContent: '-'},
            
            {data: 'created_at', name: 'created_at', defaultContent: '-'},
            {data: 'action', orderable: false, searchable: false, className: 'text-center'},
            {data: 'is_banned', orderable: false, searchable: false, className: 'text-center'}
        ],
        order: [[0, 'desc']],
        createdRow: function (row, data, index) {
            $(row).attr('id', 'row-' + data['id']);
        }
    });

    // تحديث البيانات عند الكتابة في حقل البحث
    $('#name').on('keyup change', function () {
        table1.draw();
    });

    // تحديث حالة الـ Switch Button عند التغيير
    $(document).on('change', '.is_banned_switch', function () {
        var groupId = $(this).data('id');
        var isBanned = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '/admin/groups/' + groupId + '/update-status', 
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                is_banned: isBanned
            },
            success: function (response) {
                if (response.success) {
                    toastr.success('Status updated successfully!');
                } else {
                    toastr.error('Failed to update status!');
                }
            }
        });
    });
});

 </script>

    <script>
        $(document).on('change', '.is_banned_switch', function() {
    var groupId = $(this).data('id');
    var isBanned = $(this).prop('checked') ? 1 : 0;

    $.ajax({
        url: '/admin/groups/' + groupId + '/update-status', 
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}',
            is_banned: isBanned
        },
        success: function(response) {
            if (response.success) {
                toastr.success('Status updated successfully!');
            } else {
                toastr.error('Failed to update status!');
            }
        }
    });
});

    </script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
