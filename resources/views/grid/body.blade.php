<tbody>
    @foreach($Values as $Value)
        <tr>
        @foreach($Table as $Name => $Field)
            <td>{{ $Value->{$Name} }}</td>
        @endforeach
            <td>
                <div class="btn-group btn-space">
                    <a href="/{{ str_singular($Model->getTable()) }}/{{ $Value->id }}" class="btn btn-info">Editar</a>
                    <button type="button" data-toggle="dropdown" class="btn btn-info btn-shade2 dropdown-toggle"><span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="/{{ str_singular($Model->getTable()) }}/{{ $Value->id }}">Editar</a></li>
                        <li class="divider"></li>
                        <li><a class="delete" href="#" data-id="{{ $Value->id }}">Excluir</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>