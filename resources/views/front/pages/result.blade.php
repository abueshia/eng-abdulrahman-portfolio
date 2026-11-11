@extends('front.layouts.app_iframe')

@push('css')
    <style>

        ::-webkit-scrollbar {
            display: none;
        }
        html {
            scrollbar-width: none; /* Hides scrollbar */
        }
        iframe#external {
            width: 100%;
            height: 100%;
            /*position: absolute;*/
            /*top: 0;*/
            /*z-index: 1;*/
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            z-index: 2;
            background: #fff;
        }
        footer {
            /*position: fixed;*/
            /*bottom: 0;*/
            /*left: 0;*/
            width: 100vw;
            z-index: 2;
            background: #fff;
        }
        .tr-footer-bg {margin-top: 0!important;}
        /*main*/
    </style>
@endpush

@section('content')
{{--    <div id="frame_container" style="height: 100vh;">--}}
{{--        <iframe src="{{$url}}" frameborder="0" id="external"></iframe>--}}
{{--    </div>--}}
<a href="{{$url}}" style="display: block; margin-top: 200px" id="click_me">clicked</a>
@endsection

@push('js')
    <script>

        const link = document.getElementById('click_me');
        link.click();


        {{--window.location.href = "{{$url}}";--}}

    </script>
@endpush

