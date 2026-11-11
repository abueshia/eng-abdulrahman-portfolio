
    {{-- <a href="{{route('admin.group.reorder.fields',['group'=>$group->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Sort Fields')}}">
        <img src="{{asset('dashboard/assets/img/swap.png')}}" alt="show" style="width: 25px">
    </a> --}}

@if (auth()->guard('admin')->user()->can('group.view_details', 'admin'))
    <a href="{{route('admin.group.show',['group'=>$group->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
        <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()->can('group.edit', 'admin'))
    <a href="{{route('admin.group.edit',['group'=>$group->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
        <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
    </a>
@endif

@if (auth()->guard('admin')->user()->can('group.delete', 'admin'))
    <button type="button" data-url="{{route('admin.group.destroy',['group'=>$group->id])}}"
            data-item-id="{{ $group->id }}"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
    </button>
@endif


<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
