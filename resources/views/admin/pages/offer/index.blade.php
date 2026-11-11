@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Offer'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Offer'),'link'=>route('admin.offer.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@push('admin_css')

@endpush

@section('content')


   <div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card-toolbar w-100 mb-7">

<div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar" style="display: flex; flex-direction: {{ App::getLocale() == 'ar' ? 'row-reverse' : 'row' }}; margin-bottom: 15px;">
    <div class="left-part" >
        @if (auth()->guard('admin')->user()->can('offer.create', 'admin'))
            <a href="{{ route('admin.offer.create') }}" class="btn btn-primary text-gray-800">
                <i class="ki-duotone ki-plus fs-2 text-gray-800"></i>
                {{ \App\Helpers\TranslationHelper::translate('Create Offer') }}
            </a>
        @endif
    </div>
</div>


            <!-- Filter Section -->
            <div class="d-flex align-items-center gap-3 mb-4">
                <!-- Filter by Name -->
                <input type="text" id="name" class="form-control w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by Name') }}">
                
                <!-- Filter by Product -->
                <select id="product_id" class="form-control w-25">
                    <option value=""> {{ \App\Helpers\TranslationHelper::translate('Choose Product') }}</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                
                <!-- Filter by Date -->
                <input type="text" id="created_at" class="form-control datepicker w-25" placeholder="{{ \App\Helpers\TranslationHelper::translate('Search by Date') }}">

                <!-- Apply Filter Button -->
                <button id="filter" class="btn btn-primary">{{\App\Helpers\TranslationHelper::translate('Filter')}}</button>
            </div>
        </div>

        <!-- DataTable Section -->
        <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer" id="kt_table_users">
            <thead>
            <tr>
                <th>#</th>
                <th>{{\App\Helpers\TranslationHelper::translate('image')}}</th>
                <th>{{\App\Helpers\TranslationHelper::translate('Name')}}</th>
                <th>{{\App\Helpers\TranslationHelper::translate('products')}}</th>
                 {{-- <th>{{\App\Helpers\TranslationHelper::translate('Voucher Code')}}</th> --}}
                
                <th>{{\App\Helpers\TranslationHelper::translate('point')}}</th>
                {{-- <th>{{\App\Helpers\TranslationHelper::translate('udiscount %')}}</th> --}}
                <th>{{\App\Helpers\TranslationHelper::translate('Created_at')}}</th>
                <th>{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>


    <!--end::Content-->
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@endsection


@push('admin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

<script>
    // تفعيل الـ datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    // تهيئة جدول البيانات باستخدام DataTables
    var table1 = $('#kt_table_users').DataTable({
        serverSide: true,
        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            @if(App::getLocale() == 'ar')
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
            @else
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
            @endif
        },
        ajax: {
            url: '{{ route('admin.offer.table') }}',
            data: function (d) {
                d.name = $('#name').val();
                d.product_id = $('#product_id').val();
                d.created_at = $('#created_at').val();
            }
        },
        columns: [
            {data: 'id', orderable: true, searchable: false, name: 'id', defaultContent: '-'},
            {data: 'image', name: 'image', defaultContent: '-', orderable: false, searchable: false},
            {data: 'name', orderable: true, searchable: true, name: 'name', defaultContent: '-'},
            {data: 'products', orderable: true, searchable: true, name: 'products', defaultContent: '-'},
            //  {data: 'discount_number', orderable: true, searchable: true, name: 'discount_number', defaultContent: '-'},

            {data: 'point', orderable: true, searchable: true, name: 'point', defaultContent: '-'},
            {data: 'created_at', orderable: false, searchable: false, name: 'created_at', defaultContent: '-'},
            {data: 'action', orderable: false, searchable: false, className: 'text-center'}
        ],
        createdRow: function (row, data, index) {
            $(row).attr('id', 'row-' + data['id']);
        },
    });

    // التعامل مع زر الفلترة
    $('#filter').on('click', function(e) {
        e.preventDefault();
        table1.draw();
    });

    // التعامل مع أزرار الزيادة والنقصان باستخدام jQuery
    $(document).on('click', '.increment-point', function () {
        var offerId = $(this).data('id');
        var currentPoint = parseInt($('#point-' + offerId).text());
        var newPoint = currentPoint + 1;

        // تحديث الـ UI
        $('#point-' + offerId).text(newPoint);

        // إرسال التحديث إلى الـ backend باستخدام AJAX
        $.ajax({
                url: '{{ route('admin.update-point', ['id' => '__ID__']) }}'.replace('__ID__', offerId),

            method: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                point: newPoint
            },
            success: function(response) {
                if (response.success) {
                    console.log('Point updated successfully');
                } else {
                    alert('Failed to update points');
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        });
    });

    $(document).on('click', '.decrement-point', function () {
        var offerId = $(this).data('id');
        var currentPoint = parseInt($('#point-' + offerId).text());
        var newPoint = currentPoint - 1;

        // تحديث الـ UI
        $('#point-' + offerId).text(newPoint);

        // إرسال التحديث إلى الـ backend باستخدام AJAX
        $.ajax({
            url: '{{ route('admin.update-point', ['id' => '__ID__']) }}'.replace('__ID__', offerId),
            method: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                point: newPoint
            },
            success: function(response) {
                if (response.success) {
                    console.log('Point updated successfully');
                } else {
                    alert('Failed to update points');
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        });
    });
</script>

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush

