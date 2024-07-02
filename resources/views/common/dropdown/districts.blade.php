<option value="">Select</option>
@foreach ($districts as $district)
<option value="{{ $district->id }}">{{ $district->name_en }}</option>
@endforeach
