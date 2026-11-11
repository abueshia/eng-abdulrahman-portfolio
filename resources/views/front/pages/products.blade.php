@extends('front.layouts.app')
@section('content')


    <main>
        <section class="products">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <h2 data-aos="fade-down" data-aos-duration="1000"> {{\App\Helpers\TranslationHelper::translate('Our Products')}} </h2>
 <h3 class="text-center" data-aos="fade-down" data-aos-duration="1000">
    {{ $category->name }}
</h3>

                <div class="row">
                    @foreach ( $products as $product )
                           <div class="col-md-3 pt-3">
                        <a href="#">
                            {{-- {{ route('products.details', $product->id) }} --}}
                            <div class="product-card" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="{{ $product->getFirstMediaUrl('products') }}" alt="Cake">
                                <div class="title-product">
                                    <a href="#">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                 



   
                </div>
            </div>
        </section>
        
      
    </main>
@endsection


@push('js')

@endpush
