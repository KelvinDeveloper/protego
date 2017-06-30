<thead>
    <tr>
        @foreach($Model->field as $Name => $Field)
            @if ( isset( $Model->grid['hidden'] ) && is_array( $Model->grid['hidden'] ) && in_array( $Name, $Model->grid['hidden'] ) ) <?php continue; ?> @endif
            <th style="width:{!! $Field->type == 'pics' ? '120px' : 'auto' !!}">{{ $Field->label }}</th>
        @endforeach
            <th style="width: 130px"></th>
    </tr>
</thead>