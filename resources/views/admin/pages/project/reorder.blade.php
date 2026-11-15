@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Reorder Projects'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Projects'), 'link' => route('admin.project.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Sort Items')],
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ \App\Helpers\TranslationHelper::translate('Sort Items') }}</h4>
                        <a class="btn btn-light-primary btn-sm" href="{{ route('admin.project.index') }}">
                            {{ \App\Helpers\TranslationHelper::translate('Go to Projects') }}
                        </a>
                    </div>
                    <div class="card-body py-6">
                        <ul id="sortable-list" class="list-group mb-5">
                            @foreach ($items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center py-4 cursor-move"
                                    data-id="{{ $item->id }}">
                                    <span><i class="ki-solid ki-abstract-14 me-3"></i> {{ $item->title }}</span>
                                    <span class="badge badge-light">{{ $item->sort_order }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" id="save-reorder-btn" class="btn btn-success">
                            {{ \App\Helpers\TranslationHelper::translate('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_js')
    <script src="{{ asset('dashboard/assets/js/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script>
        $(function () {
            $('#sortable-list').sortable();
            $('#save-reorder-btn').on('click', function () {
                const items = [];
                $('#sortable-list li').each(function () {
                    items.push($(this).data('id'));
                });
                $.post('{{ route('admin.project.reorder.save') }}', {
                    _token: '{{ csrf_token() }}',
                    items: items
                }).done(function (response) {
                    Swal.fire({
                        title: '{{ \App\Helpers\TranslationHelper::translate('Done') }}',
                        icon: 'success',
                        text: response.message
                    });
                });
            });
        });
    </script>
@endpush

