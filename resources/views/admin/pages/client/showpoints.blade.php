@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('points history'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('points history'),'link'=>route('admin.client.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')


        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-body py-4 px-0" dir="{{ Config::get('app.locale') == 'en' ? 'ltr' : 'rtl' }}">
                        <div class="row px-0 mt-3">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                <h4 class="d-inline-block py-3">{{ \App\Helpers\TranslationHelper::translate('points history') }}</h4>
                            </div>
                        </div>
                        <!-- جدول سجل النقاط -->
                        <table class="table table-striped table-bordered" id="points_table">
                            <thead>
                                <tr>
                                    <th>{{ \App\Helpers\TranslationHelper::translate('Points') }}</th>
                                    <th>{{ \App\Helpers\TranslationHelper::translate('Date') }}</th>
                                    <th>{{ \App\Helpers\TranslationHelper::translate('Transaction') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                {{-- @foreach($clients as $client) --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>


{{-- 
                            <tbody>
    @if($clients->points->isEmpty()) 
        <tr>
            <td colspan="3" class="text-center">{{ __('No points available for this client.') }}</td>
        </tr>
    @else
        @foreach($clients as $point)
        <tr>
            <td>{{ $point->points }}</td>
            <td>{{ $point->created_at->format('Y-m-d H:i:s') }}</td>
            <td>{{ $point->transaction }}</td>
        </tr>
        @endforeach
    @endif
</tbody> --}}


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






        <!--end::Post-->
    </div>
    <!--end::Content-->
    </div>

@stop
@section('script')
    <script>
    $(document).ready(function() {
        $('#points_table').DataTable({
            "order": [[1, 'desc']], // ترتيب الجدول بناءً على التاريخ
            "language": {
                @if(App::getLocale() == 'ar')
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
                @else
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/en.json",
                @endif
            }
        });
    });
</script>
@stop
