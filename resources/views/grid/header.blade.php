<thead>
    <tr>
        @foreach($Table as $Name => $Field)
            <th>{{ $Field->name }}</th>
        @endforeach
            <th style="width: 130px"></th>
    </tr>
</thead>