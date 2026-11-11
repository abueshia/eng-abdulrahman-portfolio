@if (auth()->guard('admin')->user()->can('card.view_all', 'admin'))
<a href="{{route('admin.card.show',['card'=>$card->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif

@if (auth()->guard('admin')->user()->can('card.edit', 'admin'))
<a href="{{route('admin.card.edit',['card'=>$card->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
@if (auth()->guard('admin')->user()->can('card.delete', 'admin'))

<button type="button" data-url="{{route('admin.card.destroy',['card'=>$card->id])}}"
   data-item-id="{{ $card->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{-- @endcan --}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

