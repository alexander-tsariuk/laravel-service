@if(isset($items['mainpage']) && !empty($items['general']))
    @foreach($items['mainpage'] as $code => $item)
        <div class="form-group">
            <label for="mainpage[{{$code}}]">{{ $item->label }}</label>
            {!! getFieldByIdType($item->fieldType, "data[mainpage][{$code}]", $item->content ?? '') !!}
        </div>
    @endforeach
@endif
