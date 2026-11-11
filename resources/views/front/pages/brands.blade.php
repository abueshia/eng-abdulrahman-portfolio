@extends('front.layouts.app')

@section('content')

 <main>
        <section class="products-ourownbrands">
            <div class="container pt-5">
                <h2 data-aos="fade-down" data-aos-duration="1000">~ {{\App\Helpers\TranslationHelper::translate('Our Brands')}} ~</h2>
                <div class="row">
                    @foreach ($brands as $brand )
                     <div class="col-md-4 pt-3">
                        <div class="logo-our-praneds" data-aos="zoom-in" data-aos-duration="1000">
                            <img width="100%" height="250px" src="{{ $brand->getFirstMediaUrl('galleries_image') }}" alt="Logo Our Praneds">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
    </main>


@endsection


@push('js')


@endpush
