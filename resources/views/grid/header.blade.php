<thead>
    <tr>
        @foreach($Table as $Name => $Field)
            <th>{{ $Field->name }}</th>
        @endforeach
    </tr>
</thead>