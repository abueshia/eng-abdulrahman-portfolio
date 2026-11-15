@if (auth()->guard('admin')->user()?->can('stats.view_details', 'admin'))
    <a href="{{ route('admin.stat.show', ['stat' => $stat->id]) }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="{{ \App\Helpers\TranslationHelper::translate('Show Details') }}">
        <img src="{{ asset('dashboard/assets/img/show.png') }}" alt="show" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()?->can('stats.edit', 'admin'))
    <a href="{{ route('admin.stat.edit', ['stat' => $stat->id]) }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="{{ \App\Helpers\TranslationHelper::translate('Edit') }}">
        <img src="{{ asset('dashboard/assets/img/edit.png') }}" alt="edit" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()?->can('stats.delete', 'admin'))
    <button type="button"
            data-url="{{ route('admin.stat.destroy', ['stat' => $stat->id]) }}"
            data-item-id="{{ $stat->id }}"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="{{ asset('dashboard/assets/img/delete.png') }}" alt="delete" style="width: 25px">
    </button>
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

