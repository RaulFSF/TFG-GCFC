<div class="h-full mb-auto">
    <div class="p-4 w-full text-2xl h-fit">
        <div>
            <h2 class="text-xl">Información de {{$history->player->name}}</h2>
            <ul class="text-black text-sm list-none list-inside mt-2">
                <li>Goles: {{$history->goals}}</li>
                <li>Asistencias: {{$history->assits}}</li>
                <li>Tarjetas amarillas: {{$history->yellow_cards}}</li>
                <li>Tarjetas rojas: {{$history->red_cards}}</li>
                <li>Media de valoraciones: {{ $history->player->scouts->sum('pivot.stars') / $history->player->scouts->count() }}</li>
                <li>Cantidad de valoraciones: {{ $history->player->scouts->count() }}</li>
                <li>Cantidad de seguidores: {{ $history->player->follows->count() }}</li>
            </ul>
        </div>
    </div>
</div>
