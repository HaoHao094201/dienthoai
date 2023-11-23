<option value="">--- Chọn quận huyện ---</option>
@foreach ($huyen as $h)
    <option value="{{ $h->idh }}">{{ $h->ten_h }}</option>
@endforeach
        
