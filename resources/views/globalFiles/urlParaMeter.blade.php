<?php $urlSeparatorDataTable = '~'; ?>
<div class="url-pMeter">
    @foreach ($inputData as $input => $data)
        <?php
        $inputArray = explode($urlSeparatorDataTable, $input);
        $inputClass = count($inputArray) > 1 ? $inputArray[0] . '-data-input' : 'data-input';
        ?>
        <input id="{{ $input }}" class="{{ $inputClass }}" type="hidden" value="{{ $data }}">
    @endforeach
</div>
