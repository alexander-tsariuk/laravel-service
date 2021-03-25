@if(isset($items['general']) && !empty($items['general']))
    @foreach($items['general'] as $code => $item)
        <div class="form-group">
            <label for="general[{{$code}}]">{{ $item->label }}</label>
            {!! getFieldByIdType($item->fieldType, "data[general][{$code}]", $item->content) !!}
        </div>
    @endforeach
@endif
