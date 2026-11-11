@extends('front.layouts.app')

@section('content')

<main>
    <section class="prodect-deteles" style="padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center" style="margin-top: 50px;">
                <div class="col-md-6">
                    <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->name }}" class="product-image">
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <h2>{{ $product->name }}</h2>
                        
                        <p class="category">
                            <strong>{{\App\Helpers\TranslationHelper::translate('Category')}}:</strong>
                            {{ $product->productcategory?->name ?? 'Not specified' }}
                        </p>

                        <p class="description">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('js')
@endpush

