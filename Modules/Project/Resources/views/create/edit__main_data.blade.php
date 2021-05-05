<div class="card">
    <div class="card-header">
        <h3 class="card-title">Основная информация</h3>
    </div>
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
            <label for="position">Позиция</label>
            <input
                type="text"
                class="custom-select form-control-border {{ $errors->has('position') ? 'is-invalid' : '' }}"
                name="position"
                value="{{ old('position') }}"
            />

            @if($errors->has('prefix'))
                <span class="text-danger">{{ $errors->first('prefix') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="prefix">Алиас</label>
            <input
                type="text"
                class="custom-select form-control-border {{ $errors->has('prefix') ? 'is-invalid' : '' }}"
                name="prefix"
                required
                value="{{ old('prefix') }}"
            />

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
                        <option value="{{ $service->id }}" {{ old('serviceId') == $service->id ? 'selected' : '' }}>{{ $service->translation->name }}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->has('serviceId'))
                <span class="text-danger">{{ $errors->first('serviceId') }}</span>
            @endif
        </div>
    </div>
</div>
