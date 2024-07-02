<option value="">Select</option>
@foreach ($upazilas as $upazila)
<option value="{{ $upazila->id }}">{{ $upazila->name_en }}</option>
@endforeach
