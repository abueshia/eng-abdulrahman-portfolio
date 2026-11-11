@extends('front.layouts.app')

@section('content')

<div class="container" style="max-width: 900px; margin: 0 auto; padding: 130px 20px; text-align: center;">
    <h2 class="tr-company-title" style="font-size: 40px; color: #222; margin-bottom: 35px;">
        {{ \App\Helpers\TranslationHelper::translate('Terms and Condition') }}
    </h2>

    @if($termsandcondition && $termsandcondition->description)
        <div class="tr-company-description" style="font-size: 20px; color: #555; line-height: 1.8; text-align: justify;">
            {!! $termsandcondition->description !!}
        </div>
    @else
        <p style="font-size: 20px; color: #888; margin-top: 20px;">
            {{ \App\Helpers\TranslationHelper::translate('No terms and conditions available at the moment.') }}
        </p>
    @endif
</div>

@endsection
