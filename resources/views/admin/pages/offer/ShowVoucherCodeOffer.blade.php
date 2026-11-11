@extends('admin.layouts.app')

@section('title', \App\Helpers\TranslationHelper::translate('Offer Details'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('offers'), 'link' => route('admin.offer.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Details')],
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">{{ \App\Helpers\TranslationHelper::translate('Voucher Code Offers') }}</h3>
            <a href="{{ route('admin.offer.index') }}" class="btn btn-primary">{{ \App\Helpers\TranslationHelper::translate('Back to Offers') }}</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>{{ \App\Helpers\TranslationHelper::translate('Client Name') }}</th>
                        <th>{{ \App\Helpers\TranslationHelper::translate('Offer Name') }}</th>
                        <th>{{ \App\Helpers\TranslationHelper::translate('Voucher Code Offer') }}</th>
                        <th>{{ \App\Helpers\TranslationHelper::translate('Points Offer') }}</th>
                        <th>{{ \App\Helpers\TranslationHelper::translate('Created at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vouchercodeoffer as $key => $voucher)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $voucher->client->name ?? 'N/A' }}</td>
                            <td>{{ $voucher->offer->name ?? 'N/A' }}</td>
                            <td>{{ $voucher->discount_number }}</td>
                            <td>{{ $voucher->points }}</td>
                             <td>{{ $voucher->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ \App\Helpers\TranslationHelper::translate('No data available') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@stop
