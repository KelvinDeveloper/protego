<{!! ( isset($Config['href']) ? 'a' : 'button' ) . ' ' . Form::attributes($Config) !!}>
<?php $Config['icon'] = explode('|', $Config['icon']); ?>
{!! ( isset( $Config['icon'] ) ? '<i class="material-icons ' . ( isset( $Config['icon'][1] ) ? $Config['icon'][1] : 'left' ) . '">' . $Config['icon'][0] . '</i>' : '' ) !!}
{{ $Config['name'] }}
</{!! isset($Config['href']) ? 'a' : 'button' !!}>