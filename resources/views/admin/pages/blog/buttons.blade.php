@if (auth()->guard('admin')->user()?->can('blogs.view_details', 'admin'))
    <a href="{{ route('admin.blog.show', ['blog' => $blog->id]) }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="{{ \App\Helpers\TranslationHelper::translate('Show Details') }}">
        <img src="{{ asset('dashboard/assets/img/show.png') }}" alt="show" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()?->can('blogs.edit', 'admin'))
    <a href="{{ route('admin.blog.edit', ['blog' => $blog->id]) }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="{{ \App\Helpers\TranslationHelper::translate('Edit') }}">
        <img src="{{ asset('dashboard/assets/img/edit.png') }}" alt="edit" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()?->can('blogs.delete', 'admin'))
    <button type="button"
            data-url="{{ route('admin.blog.destroy', ['blog' => $blog->id]) }}"
            data-item-id="{{ $blog->id }}"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="{{ asset('dashboard/assets/img/delete.png') }}" alt="delete" style="width: 25px">
    </button>
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
