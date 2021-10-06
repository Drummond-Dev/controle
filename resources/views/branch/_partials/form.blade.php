@include('includes.alters')

<div class="form-group">
    <label for="company">Compania:</label>
    <select class="form-control" name="company_id" id="company">
        <option>Escolha uma Compania</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}"
            @if(isset($branch))
                @if($company->id === $branch->company_id)
                    selected
                @endif
            @endif
            >{{ $company->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="cnpj">CNPJ:</label>
    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" value="{{ $branch->cnpj ?? old('cnpj') }}">
</div>

<div class="form-group">
    <label for="location">Localização:</label>
    <select class="form-control" name="location_id" id="location">
            <option>Escolha uma localização</option>
        @foreach($locations as $location)
            <option value="{{ $location->id }}"
            @if(isset($branch))
                @if($location->id === $branch->location_id)
                    selected
                @endif
            @endif
            >{{ $location->name }} / {{ $location->uf }}</option>
        @endforeach
    </select>
</div>