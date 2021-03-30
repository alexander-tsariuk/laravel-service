<div class="card">
    <div class="card-header">
        <h3 class="card-title">Основная информация</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" required>
                <option value="0" {{ !$item->status ? 'selected' : '' }}>Неактивен</option>
                <option value="1" {{ !empty($item->status) && $item->status == 1 ? 'selected' : '' }}>Активен</option>
            </select>
            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="prefix">Алиас</label>
            <input type="text" class="custom-select form-control-border {{ $errors->has('prefix') ? 'is-invalid' : '' }}" name="prefix" required value="{{ $item->prefix }}">

            @if($errors->has('prefix'))
                <span class="text-danger">{{ $errors->first('prefix') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="serviceId">Услуга</label>
            <select name="serviceId" class="form-control form-control-border {{ $errors->has('serviceId') ? 'is-invalid' : '' }}">
                <option value="0">Не выбрано</option>
                @if(isset($services) && !empty($services))
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $item->serviceId == $service->id ? 'selected' : '' }}>{{ $service->translation->name }}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->has('serviceId'))
                <span class="text-danger">{{ $errors->first('serviceId') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Изображение</label>
            <div class="mb-3" id="image-area" style="min-height: 200px">
                @if(isset($item->image) && !empty($item->image))
                    <img src="/storage/{{ $item->image }}" class="img-fluid" style="max-width: 200px;"/>
                @endif
            </div>

            <input
                type="file"
                name="uploadingImage"
                class="upload-file {{ isset($item->image) && !empty($item->image) ? 'd-none' : '' }}"
                data-object="project"
                data-id="{{$item->id}}"
            />

            <input
                type="button"
                name="deleteImage"
                class="btn btn-danger deleteImage {{ !isset($item->image) || empty($item->image) ? 'd-none' : '' }}"
                data-object="project"
                data-id="{{$item->id}}"
                value="Удалить изображение"
            />

            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>
</div>
