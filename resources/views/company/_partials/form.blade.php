@include('includes.alters')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $company->name ?? old('name') }}">
</div>
@if(isset($company->image))
<div class="form-group">
    <img src="{{ url("storage/{$company->image}") }}" alt="{{ $company->name }}" style="max-width: 60px;">
</div>
@endif
<div class="form-group">
    <label for="image">Logotipo:</label>
    <input type="file" name="image" id="image" class="form-control-file" placeholder="Logotipo" value="{{ $company->image ?? old('image') }}">
</div>