@if (session('message'))
  <div class="alert alert-success" role="alert">
    {{ session('message') }}
  </div>
@elseif (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
@elseif($errors->any())
  <div class="alert alert-danger" role="alert">
  {!! implode('', $errors->all('<div>:message</div>')) !!}
  </div>
@endif