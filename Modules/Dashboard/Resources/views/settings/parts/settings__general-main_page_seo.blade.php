@if(isset($items['mainpage_seo']) && !empty($items['mainpage_seo']))
    @foreach($items['mainpage_seo'] as $code => $item)
        <div class="form-group">
            <label for="mainpage_seo[{{$code}}]">{{ $item->label }}</label>
            {!! getFieldByIdType($item->fieldType, "data[mainpage_seo][{$code}]", $item->content ?? '') !!}
        </div>
    @endforeach
@endif
