   @if (auth()->guard('admin')->user()->can('about_us.view_details', 'admin'))
<a href="{{route('admin.about.show',['about'=>$about->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
   @if (auth()->guard('admin')->user()->can('about_us.edit', 'admin'))
<a href="{{route('admin.about.edit',['about'=>$about->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
