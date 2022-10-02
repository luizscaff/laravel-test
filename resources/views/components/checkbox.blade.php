<div class="form-group row">
  <div class="col-md-1">
    <input id="{{ $field }}" type="checkbox" value="1" 
          {!! $attributes->merge(["class" => "rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"]) !!}
           class="form-control @error('{{ $field }}') is-invalid @enderror" name="{{ $field }}" 
           {{ old($field) != null ? "checked" : (isset($item) && $item->$field ? "checked" : '') }} autocomplete="$field">
  </div>
</div>