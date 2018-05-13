@csrf

<!-- CONTENIDOR PARE + NOM -->
<h6>Dades del contenidor</h6>
<div class="form-row">
    <!-- Pare -->
    <div class="form-group col-md-4">
        <label for="pareContenidor">Pare</label>
        <select name="container_parent_id" class="form-control" id="pareContenidor" aria-describedby="pareContenidorHelp">
            @if(isset($container))
                <option value="cap" {{ ($container->container_parent_id or old('container_parent_id')) == null ? 'selected' : '' }}>Cap</option>
                <option value="1" {{ ($container->container_parent_id or old('container_parent_id')) == 1 ? 'selected' : '' }}>Nom 1</option>
                <option value="0" {{ ($container->container_parent_id or old('container_parent_id')) == 0 ? 'selected' : '' }}>Nom 2</option>
            @else
                <option value="cap" selected>Cap</option>
                <option value="1">Nom 1</option>
                <option value="0">Nom 2</option>
            @endif
        </select>
        <small id="pareContenidorHelp" class="form-text text-muted">El contenidor on hi serà contingut.</small>
    </div>

    <!-- Nom -->
    <div class="form-group col-md-8">
        <label for="nomContenidor">Tipus</label>
        <select name="container_name_id" class="form-control" id="nomContenidor" aria-describedby="nomContenidorHelp" required {{ $containerNames->isEmpty() ? 'disabled' : '' }}>
            @forelse ($containerNames as $containerName)
                @if(isset($container))
                    <option value="{{ $containerName->id }}" {{ ($container->container_name_id or old('container_name_id')) == $containerName->id ? 'selected' : '' }}>{{ $containerName->nom }}</option>
                @else
                    <option value="{{ $containerName->id }}">{{ $containerName->nom }}</option>
                @endif
            @empty
                <option selected>No hi ha tipus de contenidors...</option>
            @endforelse
        </select>
        <small id="nomContenidorHelp" class="form-text text-muted">El tipus de contenidor.</small>
    </div>
</div><!-- /.form-row -->
<hr class="mb-4">
<!-- CONTENIDOR VEHICLE - USUARI -->
<h6>Ubicació del contenidor</h6>
<div class="form-row">
    <!-- Ubicació -->
    <div class="form-group col-md-4">
        @if(isset($container))
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="es_dun_vehicle" id="ubicacioVehicle" value="1"
                    {{ ($container->es_dun_vehicle or old('es_dun_vehicle')) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="ubicacioVehicle">Vehicle</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="es_dun_vehicle" id="ubicacioParc" value="0"
                    {{ ($container->es_dun_vehicle or old('es_dun_vehicle')) == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="ubicacioParc">Parc</label>
            </div>
        @else
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="es_dun_vehicle" id="ubicacioVehicle" value="1" checked>
                <label class="form-check-label" for="ubicacioVehicle">Vehicle</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="es_dun_vehicle" id="ubicacioParc" value="0">
                <label class="form-check-label" for="ubicacioParc">Parc</label>
            </div>
        @endif
        <small class="form-text text-muted">Lloc en el que s'ubica el contenidor.</small>
    </div>
    <!-- Vehicle -->
    <div id="vehicleContenidorSelect" class="form-group col-md-8">
        <select name="vehicle_id" class="form-control" id="vehicleContenidor" aria-describedby="vehicleContenidorHelp" {{ $vehicles->isEmpty() ? 'disabled' : '' }}>
            @forelse ($vehicles as $vehicle)
                @if(isset($container))
                    <option value="{{ $vehicle->id }}" {{ ($container->vehicle_id or old('vehicle_id')) == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->type->codi }}, {{ $vehicle->type->descripcio }} ({{ $vehicle->type->nom }})
                    </option>
                @else
                    <option value="{{ $vehicle->id }}">{{ $vehicle->type->codi }}, {{ $vehicle->type->descripcio }} ({{ $vehicle->type->nom }})</option>
                @endif
            @empty
                <option selected>No hi ha vehicles...</option>
            @endforelse
        </select>
        <small id="vehicleContenidorHelp" class="form-text text-muted">El vehicle al qual pertany el contenidor.</small>
    </div>
    <!-- Parc -->
    <div id="parcContenidorSelect" class="form-group col-md-8" style="display:none">
        <select name="user_id" class="form-control" id="parcContenidor" aria-describedby="parcContenidorHelp" {{ $users->isEmpty() ? 'disabled' : '' }}>
            @forelse ($users as $user)
                @if(isset($container))
                    <option value="{{ $user->id }}" {{ ($container->user_id or old('user_id')) == $user->id ? 'selected' : '' }}>
                        {{ $user->codi_parc }}, {{ $user->name }}
                    </option>
                @else
                    <option value="{{ $user->id }}">{{ $user->codi_parc }}, {{ $user->name }}</option>
                @endif
            @empty
                <option selected>No hi ha vehicles...</option>
            @endforelse
        </select>
        <small id="parcContenidorHelp" class="form-text text-muted">El parc al qual pertany el contenidor.</small>
    </div>
</div><!-- /.form-row -->

<!-- Botó (submit) -->
<button type="submit" class="btn btn-danger bg-dark">
    <p class="my-0 underline-small">{{ $submitButton }}</p>
</button>