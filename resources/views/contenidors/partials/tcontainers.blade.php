<table class="table table-bordered table-striped">
    <caption><small>{{ $tInfo }}</small></caption>
    <thead class="thead-dark">
        <tr style="border-bottom:3px solid #dc3545;">
            <th scope="col">#</th>
            <th scope="col">Tipus</th>
            <th scope="col">Ubicat (a)</th>
            <th scope="col">Contingut (en)</th>
            <th scope="col">Materials</th>
            <th scope="col">Acció</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($containers as $key => $container)
            @php $count = $key+1; @endphp
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $container['container_name']['nom'] }}</td>
                <td>
                    {{-- Mostrar les dades del lloc on està ubicat el contenidor. --}}
                    @if (isset($container['vehicle']))
                        {{ $container['vehicle']->codigo() }}, {{ $container['vehicle']['type']['nom'] }}
                    @elseif (isset($container['user']))
                        {{ $container['user']['codi_parc'] }}, {{ $container['user']['name'] }}
                    @else
                        No assignat
                    @endif
                </td>
                <td>
                    {{ $container['parent']['container_name']['nom'] }}
                    {{-- Mostrar les dades del lloc on està contingut el contenidor. --}}
                    @if (isset($container['parent']['vehicle']))
                        , {{ $container['parent']['vehicle']['codi'] }}, {{ $container['parent']['vehicle']['type']['nom'] }}
                    @elseif (isset($container['parent']['user']))
                        , {{ $container['parent']['user']['codi_parc'] }}, {{ $container['parent']['user']['name'] }}
                    @else @endif
                </td>
                <td>
                    @if(!empty($container['materials']))
                        <button type="button" class="btn btn-link" style="text-decoration: none;"
                            data-toggle="modal" data-target="#contenidorMaterialsModal{{ $container['id'] }}">
                            <i class="fas fa-clipboard-list"></i> Veure
                        </button>
                        @include('contenidors.partials.modal-materials', [
                            'container'  => $container
                        ])
                    @endif
                </td>
                <td class="text-right">
                    <!-- Editar -->
                    <a class="btn btn-xs btn-default" href="{{ action('ContainerController@edit', ['id' => $container->id]) }}">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </a>
                    <!-- Esborrar -->
                    <div class="d-inline-block">
                        <form action="{{ action('ContainerController@destroy', ['id' => $container->id]) }}" method="POST" class="form-delete">
                            @method('DELETE')
                            @csrf
                            {{-- Tipus --}}
                            <input type="hidden" name="tipus" value="{{ $container['container_name']['nom'] }}">
                            {{-- Ubicat --}}
                            @if (isset($container['vehicle']))
                                <input type="hidden" name="ubicat" value="{{ $container['vehicle']->codigo() }}, {{ $container['vehicle']['type']['codi'] }}">
                            @elseif (isset($container['user']))
                                <input type="hidden" name="ubicat" value="{{ $container['user']['codi_parc'] }}, {{ $container['user']['name'] }}">
                            @else
                                <input type="hidden" name="ubicat" value="No assignat">
                            @endif
                            {{-- Contingut --}}
                            <input type="hidden" name="contingut" value="{{ $container['parent']['container_name']['nom'] }}">
                            {{-- Grup --}}
                            @if (isset($container['vehicle']))
                                <input type="hidden" name="grup" value="Vehicles">
                            @elseif (isset($container['user']))
                                <input type="hidden" name="grup" value="Parcs">
                            @else
                                <input type="hidden" name="grup" value="No assignats">
                            @endif
                            <button type="submit" class="btn btn-xs btn-danger">
                                <i class="fas fa-times"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ $tBuida }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
<!-- Paginació -->
{{ $containers->links() }}