@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Codes Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[ 
        ['text'=>\App\Helpers\TranslationHelper::translate('Codes'),'link'=>route('admin.coupon.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!-- **جزء البحث والتصدير** -->
        <div class="row px-0 mt-3 align-items-center">
            <!-- **البحث** -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                <form method="GET" action="{{ route('admin.coupon.show', $group->id) }}">
                    <div class="input-group">
                        <input type="text" name="search" 
                               class="form-control search-input" 
                               placeholder="{{ __('Search by Code') }}" 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary search-button" type="submit">
                            <i class="fas fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- **زر التصدير** -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-end mb-2">
                <a href="{{ route('admin.coupon.show', ['coupon' => $group->id, 'export' => 'true']) }}" 
                   class="btn btn-success export-button">
                    <i class="fas fa-file-excel"></i> {{ __('Export to Excel') }}
                </a>
            </div>
        </div>

        <!-- **جدول عرض الأكواد** -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover coupon-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Code Status') }}</th>
                                <th>{{ __('Date Created') }}</th>
                                <th>{{ __('Actions') }}</th> <!-- عمود جديد للإجراءات -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $index => $coupon)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $coupon->code }}</td>

                                    {{-- إظهار اسم العميل لأول voucher فقط --}}
                                    <td>{{ $coupon->voucherspages->first()->client->name ?? __('N/A') }}</td>

                                    
        <td>
    @if ($coupon->voucherspages->first())
        @if ($coupon->voucherspages->first()->status == 'active')
            {{ __('Active') }}
        @elseif ($coupon->voucherspages->first()->status == 'inactive')
            {{ __('Inactive') }}
        @else
            {{ __('Pending') }}
        @endif
    @else
        {{ __('No Status') }}
    @endif
</td>


                                    <td>
                                        {{-- عرض تاريخ الإنشاء --}}
                                        {{ $coupon->created_at->format('Y-m-d H:i') }}
                                    </td>

                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" 
                                                   class="toggle-status" 
                                                   data-id="{{ $coupon->id }}" 
                                                   {{ $coupon->is_valid === 'valid' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        {{ __('No Codes Available') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('admin_js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-status').forEach(function (switchButton) {
            switchButton.addEventListener('change', function () {
                const couponId = this.getAttribute('data-id');
                const isChecked = this.checked;
                const url = '{{ route('admin.toggleStatus', ':id') }}'.replace(':id', couponId); 
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ is_valid: isChecked ? 'valid' : 'not valid' }),
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        this.checked = !isChecked; 
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isChecked; 
                });
            });
        });
    });
</script>
@endpush

