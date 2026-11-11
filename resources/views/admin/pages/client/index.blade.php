@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Clients'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Clients'),'link'=>route('admin.client.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">


@endpush

@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card-toolbar w-100 mb-7">


          <div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar" style="direction: {{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}; margin-bottom: 15px;">
    <div class="left-part">
        @if (auth()->guard('admin')->user()->can('client.create', 'admin'))
            <a href="{{ route('admin.client.create') }}" class="btn btn-primary text-gray-800 mb-3">
                <i class="ki-duotone ki-plus fs-2 text-gray-800"></i>
                {{ \App\Helpers\TranslationHelper::translate('Create Client') }}
            </a>
        @endif
    </div>
</div>
            
            <div class="d-flex align-items-center gap-3 mb-4">
    {{-- <input type="text" id="card" class="form-control w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by') }}"> --}}
    <input type="text" id="search" class="form-control w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by') }}">


    <select id="category" class="form-control w-25">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('All Customer rating') }}</option>
        <option value="gold">{{ \App\Helpers\TranslationHelper::translate('Gold') }}</option>
        <option value="silver">{{ \App\Helpers\TranslationHelper::translate('Silver') }}</option>
        <option value="bronze">{{ \App\Helpers\TranslationHelper::translate('Bronze') }}</option>
    </select>
    <select id="city_id" class="form-control w-25">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('All Cities') }}</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    <input type="text" id="created_at" class="form-control datepicker w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by date') }}">
    <button id="filter" class="btn btn-primary">  {{ \App\Helpers\TranslationHelper::translate('Filter') }}</button>
</div>

            <!-- DataTable Section -->
            <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                   id="kt_table_users">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Name') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Customer rating') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('city') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('points') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Date') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('is_active') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Ban') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Actions') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@endsection

@push('admin_js')
 {{-- <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />




<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
</script>


    <script>
var table1 = $('#kt_table_users').DataTable({
    serverSide: true,
    orderCellsTop: true,
    fixedHeader: true,
    processing: true,
    language: {
        @if(App::getLocale() == 'ar')
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
        @else
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        @endif
    },
    ajax: {
        url: '{{ route('admin.client.table') }}',
        data: function (d) {
            // إرسال الفلاتر الخاصة بالبحث عبر الـ Ajax
            d.name = $('#name').val(); // فلترة حسب الاسم
            d.category = $('#category').val(); // فلترة حسب التصنيف
            d.city_id = $('#city_id').val(); // فلترة حسب المدينة
            d.created_at = $('#created_at').val(); // فلترة حسب تاريخ الإنشاء
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'}, // العمود الأول
        {data: 'name', name: 'name', defaultContent: '-'}, // العمود الثاني
        {data: 'category', name: 'category', defaultContent: '-'},
        {data: 'city_name', name: 'city_name', defaultContent: '-', searchable: true},


   { 
    data: 'points', 
    name: 'points', 
    defaultContent: '-', 
    render: function(data, type, row) {
        return `<a href="{{ route('admin.client.showpoints', ':id') }}".replace(':id', row.id)">${data}</a>`;
    }
}       ,

        {data: 'created_at', name: 'created_at', defaultContent: '-'}, // العمود الخامس
        {data: 'action', orderable: false, searchable: false, className: 'text-center'} // زر العمليات
    ],
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    },
});

// فلترة الجدول عند الضغط على زر الفلترة
$('#filter_button').on('click', function() {
    table1.ajax.reload(); // إعادة تحميل البيانات بعد الفلترة
});



$(document).on('click', '.ban-client', function () {
    let clientId = $(this).data('id');
    Swal.fire({
        title: '@lang('Are you sure you want to ban this client?')', // الترجمة
        text: '@lang('This action will block the client and they will not be able to log in.')',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '@lang('Yes, ban it!')',
        cancelButtonText: '@lang('Cancel')',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.client.ban") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: clientId,
                    is_banned: 1
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            '@lang('Client Banned')', // الترجمة
                            '@lang('The client has been banned successfully.')',
                            'success'
                        );
                        table1.ajax.reload();
                    } else {
                        Swal.fire(
                            '@lang('Error')', 
                            '@lang('An error occurred while banning the client.')',
                            'error'
                        );
                    }
                }
            });
        }
    });
});
</script>

<script>
// إلغاء حظر العميل
$(document).on('click', '.unban-client', function () {
    let clientId = $(this).data('id');
    Swal.fire({
        title: '@lang('Are you sure you want to unban this client?')', // الترجمة
        text: '@lang('This action will lift the ban and the client will be able to log in again.')',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '@lang('Yes, unban it!')',
        cancelButtonText: '@lang('Cancel')',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.client.ban") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: clientId,
                    is_banned: 0
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            '@lang('Client Unbanned')', // الترجمة
                            '@lang('The client has been unbanned successfully.')',
                            'success'
                        );
                        table1.ajax.reload();
                    } else {
                        Swal.fire(
                            '@lang('Error')', 
                            '@lang('An error occurred while unbanning the client.')',
                            'error'
                        );
                    }
                }
            });
        }
    });
});

</script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script> --}}


<script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

<script>
    // تهيئة datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
</script>

<script>

// var table1 = $('#kt_table_users').DataTable({
//     serverSide: true,
//     orderCellsTop: true,
//     fixedHeader: true,
//     processing: true,
//     language: {
//         @if(App::getLocale() == 'ar')
//         url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
//         @else
//         url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
//         @endif
//     },
//     processing: true,
// searching: false, // لتعطيل البحث
// dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>>
//           <'row'<'col-sm-12'tr>>
//           <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
// buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
// "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
// order: [[0, "desc"]],

//     ajax: {
//         url: '{{ route('admin.client.table') }}',
//         data: function (d) {
//             d.name = $('#name').val(); 
//               d.card = $('#card').val();
//             d.category = $('#category').val(); 
//             d.city_id = $('#city_id').val(); 
//             d.created_at = $('#created_at').val(); 
//         }
//     },

//   columns: [
//     {data: 'id', name: 'id', defaultContent: '-'}, 
//     {data: 'name', name: 'name', defaultContent: '-'}, 
//     {data: 'category', name: 'category', defaultContent: '-'},
//     {data: 'city_name', name: 'city_name', defaultContent: '-', searchable: true},
//     { 
//         data: 'points', 
//         name: 'points', 
//         defaultContent: '-', 
//         render: function(data, type, row) {
//             return `<a href="{{ route('admin.client.showpoints', ':id') }}`.replace(':id', row.id) + `">${data}</a>`;
//         }
//     },
//     {data: 'created_at', name: 'created_at', defaultContent: '-'},
    
//     {data: 'is_active', name: 'is_active', defaultContent: '-'},

//     {data: 'ban', name: 'ban', defaultContent: '-'},

//     {data: 'action', orderable: false, searchable: false, className: 'text-center'}
// ],
// createdRow: function (row, data, index) {
//     $(row).attr('id', 'row-' + data['id']);
// },

// createdRow: function (row, data, index) {
//     $(row).attr('id', 'row-' + data['id']);
// },


// });

// $('#filter').on('click', function() {
//     table1.ajax.reload(); 
// });

var table1 = $('#kt_table_users').DataTable({
    serverSide: true,
    orderCellsTop: true,
    fixedHeader: true,
    processing: true,
    language: {
        @if(App::getLocale() == 'ar')
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
        @else
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        @endif
    },
    processing: true,
    searching: false, // لتعطيل البحث الافتراضي
    dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>>
          <'row'<'col-sm-12'tr>>
          <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
    buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    order: [[0, "desc"]],
    ajax: {
        url: '{{ route('admin.client.table') }}',
        data: function (d) {
            d.search_value = $('#search').val(); // أخذ قيمة البحث
            d.category = $('#category').val(); 
            d.city_id = $('#city_id').val(); 
            d.created_at = $('#created_at').val(); 
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'},
        {data: 'name', name: 'name', defaultContent: '-'},
        {data: 'category', name: 'category', defaultContent: '-'},
        {data: 'city_name', name: 'city_name', defaultContent: '-', searchable: true},
        {data: 'points', name: 'points', defaultContent: '-'},
        {data: 'created_at', name: 'created_at', defaultContent: '-'},
        {data: 'is_active', name: 'is_active', defaultContent: '-'},
        {data: 'ban', name: 'ban', defaultContent: '-'},
        {data: 'action', orderable: false, searchable: false, className: 'text-center'}
    ],
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    }
});

$('#search').on('keyup', function() {
    table1.ajax.reload(); // إعادة تحميل البيانات بعد كل إدخال
});



$(document).on('change', '.ban-toggle', function () {
    let clientId = $(this).data('id');
    let isBanned = $(this).is(':checked') ? 1 : 0;  

    Swal.fire({
        title: isBanned ? '@lang('Are you sure you want to ban this client?')' : '@lang('Are you sure you want to unban this client?')',
        text: isBanned ? '@lang('This action will block the client and they will not be able to log in.')' : '@lang('This action will lift the ban and the client will be able to log in again.')',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: isBanned ? '@lang('Yes, ban it!')' : '@lang('Yes, unban it!')',
        cancelButtonText: '@lang('Cancel')',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.client.ban") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: clientId,
                    is_banned: isBanned
                },
                success: function (response) {
                    Swal.fire(
                        isBanned ? '@lang('Client Banned')' : '@lang('Client Unbanned')',
                        isBanned ? '@lang('The client has been banned successfully.')' : '@lang('The client has been unbanned successfully.')',
                        'success'
                    );
                    table1.ajax.reload();  
                }
            });
        } else {
            $(this).prop('checked', !isBanned);
        }
    });
});


</script>


<script>
    // التعامل مع التبديل بين التفعيل والإلغاء
$(document).on('change', '.active-toggle', function () {
    let clientId = $(this).data('id');
    let isActive = $(this).prop('checked') ? 1 : 0; // التحقق من حالة الـ checkbox

    $.ajax({
        url: '{{ route("admin.client.toggleActiveStatus") }}', // المسار الذي سيستقبل الطلب
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: clientId,
            is_active: isActive
        },
        success: function (response) {
            if (response.success) {
                Swal.fire(
                    'Success!',
                    response.is_active ? 'Client is activated.' : 'Client is deactivated.',
                    'success'
                );
            } else {
                Swal.fire('Error!', 'Failed to update client status.', 'error');
            }
        },
        error: function () {
            Swal.fire('Error!', 'Something went wrong, please try again later.', 'error');
        }
    });
});

</script>
<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>



@endpush
