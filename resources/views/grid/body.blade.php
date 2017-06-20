<tbody>
    @foreach($Values as $Value)
        <tr>
        @foreach($Table as $Name => $Field)
            <td>{{ $Value->{$Name} }}</td>
        @endforeach
        </tr>
    @endforeach
</tbody>