@include('includes.alters')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $client->name ?? old('name') }}">
</div>
@if(isset($client->image))
<div class="form-group">
    <img src="{{ url("storage/{$client->image}") }}" alt="{{ $client->name }}" style="max-width: 60px;">
</div>
@endif
<div class="form-group">
    <label for="image">Logotipo:</label>
    <input type="file" name="image" id="image" class="form-control-file" placeholder="Logotipo" value="{{ $client->image ?? old('image') }}">
</div>