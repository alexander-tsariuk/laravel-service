<div class="card card-outline card-tabs">
    <div class="card-header">
        <h3 class="card-title">Галерея</h3>
    </div>
    <div class="card-body">
        <div id="dUpload" class="dropzone dropzone-multiple">
            <div class="dz-default dz-message">Перетяните в эту область изображения или нажмите на неё</div>
        </div>

        <div class="container-fluid">
            <div class="row gallery-items mt-2 pt-2 border-top" >
                @if(isset($item->images) && !empty($item->images))
                    @foreach($item->images as $itemImage)
                        <div class="col-3 gallery-item border-right">
                            <img src="/storage{{ $itemImage->path }}" class="img-fluid">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
