<img
    src="{{asset('dashboard/assets/img/star_'.($provider_service->avg_rate >= 1 ? '1' : '0').'.png')}}"
    alt="star" width="20px">
<img
    src="{{asset('dashboard/assets/img/star_'.($provider_service->avg_rate >= 2 ? '1' : '0').'.png')}}"
    alt="star" width="20px">
<img
    src="{{asset('dashboard/assets/img/star_'.($provider_service->avg_rate >= 3 ? '1' : '0').'.png')}}"
    alt="star" width="20px">
<img
    src="{{asset('dashboard/assets/img/star_'.($provider_service->avg_rate >= 4 ? '1' : '0').'.png')}}"
    alt="star" width="20px">
<img
    src="{{asset('dashboard/assets/img/star_'.($provider_service->avg_rate >= 5 ? '1' : '0').'.png')}}"
    alt="star" width="20px">
<span style="vertical-align: middle;">({{$provider_service->rate_count}})</span>
