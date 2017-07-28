<div class="box-pagination">
    {{ $Model->paginate() }}
    <span class="total-records">{{ $Model->count() }} registro(s) encontrado(s)</span>
</div>
