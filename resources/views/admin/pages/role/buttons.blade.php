{{-- @can('roles.edit') --}}
@if (auth()->guard('admin')->user()->can('roles.edit', 'admin'))
{{--<a href="{{route('admin.role.show',['role'=>$role->id])}}"--}}
{{--   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">--}}
{{--    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">--}}
{{--</a>--}}
<a href="{{route('admin.role.edit',['role'=>$role->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{-- @endcan --}}
@if (auth()->guard('admin')->user()->can('roles.delete', 'admin'))
{{-- @can('roles.delete') --}}
<button type="button" data-url="{{route('admin.role.destroy',['role'=>$role->id])}}"
   data-item-id="{{ $role->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{-- @endcan --}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
