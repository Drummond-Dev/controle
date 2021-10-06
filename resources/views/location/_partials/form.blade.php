@include('includes.alters')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $location->name ?? old('name') }}">
</div>

<div class="form-group">
    <label for="uf">UF:</label>
    <input type="text" name="uf" id="uf" class="form-control" placeholder="UF" value="{{ $location->uf ?? old('uf') }}">
</div>