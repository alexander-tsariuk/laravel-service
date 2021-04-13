<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" required>
                <option value="0">Неактивен</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Активен</option>
            </select>
            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="prefix">Алиас</label>
            <input type="text" class="custom-select form-control-border {{ $errors->has('prefix') ? 'is-invalid' : '' }}" name="prefix" required value="{{ old('prefix') }}">
            @if($errors->has('prefix'))
                <span class="text-danger">{{ $errors->first('prefix') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="parentId">Родительский элемент</label>
            <select class="form-control form-control-border {{ $errors->has('parentId') ? 'is-invalid' : '' }}" name="parentId">
                <option value="0">Не выбрано</option>
                @if(isset($services) && !empty($services))
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('parentId') == $service->id ? 'selected' : '' }}>{{ $service->translation->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
