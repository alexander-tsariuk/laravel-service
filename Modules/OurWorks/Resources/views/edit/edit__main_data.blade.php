<div class="card">
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
            <input type="text" class="custom-select form-control-border {{ $errors->has('prefix') ? 'is-invalid' : '' }}" name="prefix" required value="{{ old('prefix') ?? $item->prefix }}">
            @if($errors->has('prefix'))
                <span class="text-danger">{{ $errors->first('prefix') }}</span>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="status">Изображение</label>
            <div class="img-bordered mb-3" id="image-area" style="min-height: 200px">
                @if(isset($item->image) && !empty($item->image))
                    <img src="/storage/{{ $item->image }}" class="img-fluid" style="max-width: 200px;"/>
                @endif
            </div>

            <input
                type="file"
                name="uploadingImage"
                class="upload-file"
                data-object="ourwork"
                data-id="{{$item->id}}"
            />

            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>
</div>
