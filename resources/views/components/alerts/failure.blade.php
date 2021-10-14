@if($data)
    <div class="failure-alert" role="alert">
        <div class="flex">
            <div class="my-3 pr-3">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
            </div>
            <div>
                <p class="font-bold alert-title">{{$data['title']}}</p>
                <p class="text-sm alert-message">{{$data['content']}}</p>
            </div>
            <div class="close-alert">
                <i class="fas fa-times cursor-pointer"></i>
            </div>
        </div>
    </div>
@endif
