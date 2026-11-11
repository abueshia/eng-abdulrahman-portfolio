@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Branches'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Branches'),'link'=>route('admin.branche.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')

@endpush

@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!-- Card Toolbar Section -->
        <div class="card-toolbar w-100 mb-7">
            <!-- Left Part: Create Button -->
            <div class="left-part" style="margin-bottom: 15px;">
                @if (auth()->guard('admin')->user()->can('branche.create', 'admin'))
                    <a href="{{ route('admin.branche.create') }}" class="btn btn-primary text-gray-800 mb-3">
                        <i class="ki-duotone ki-plus fs-2 text-gray-800"></i>
                        {{ \App\Helpers\TranslationHelper::translate('Create Branche') }}
                    </a>
                @endif
            </div>
                
            <!-- Right Part: Filter Section -->
            <div class="right-part d-flex align-items-center gap-3">
                <input type="text" id="name" class="form-control w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by name') }}">
                {{-- <select id="city_id" class="form-control w-25">
                    <option value="">{{ \App\Helpers\TranslationHelper::translate('All Cities') }}</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select> --}}
                <input type="text" id="created_at" class="form-control datepicker w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by date') }}">
                <button id="filter" class="btn btn-primary">{{ \App\Helpers\TranslationHelper::translate('Filter') }}</button>
            </div>
        </div>

        <!-- Table Section -->
        <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer" id="kt_table_users">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('image') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Name') }}</th>
                    {{-- <th>{{ \App\Helpers\TranslationHelper::translate('City') }}</th> --}}
                    <th>{{ \App\Helpers\TranslationHelper::translate('Date') }}</th>
                    <th>{{ \App\Helpers\TranslationHelper::translate('Actions') }}</th>
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

<script>
    // تفعيل الـ datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
</script>



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
    ajax: {
        url: '{{ route('admin.branche.table') }}',
        data: function (d) {
            d.name = $('#name').val();  // إرسال القيمة من حقل البحث الاسم
            d.city_id = $('#city_id').val();  // إرسال المدينة المحددة
            d.created_at = $('#created_at').val();  // إرسال التاريخ المحدد
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'},
                {data: 'image', name: 'image', defaultContent: '-', orderable: false, searchable: false},

        {data: 'name', name: 'name', defaultContent: '-'},
        // {data: 'city.name', name: 'city.name', defaultContent: '-'},  
        {data: 'created_at', name: 'created_at', defaultContent: '-'},
        {data: 'action', orderable: false, searchable: false, className: 'text-center'}
    ],
    order: [[0, 'desc']], // ترتيب الجدول بشكل تنازلي حسب العمود id
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    }
});

// تحديث البيانات عند الكتابة في حقل البحث الاسم
$('#name').on('keyup change', function () {
    table1.draw();
});

// عند تغيير المدينة أو التاريخ
$('#city_id, #created_at').on('change', function () {
    table1.draw();
});

    </script>

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
