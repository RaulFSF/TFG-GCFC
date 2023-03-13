<div class="h-full mb-auto">
    <div class="p-4 w-full text-2xl h-fit">
        <div>
            <h2 class="text-xl font-semibold">{{$history->league->season->name}}</h2>
            <h2 class="text-xl italic">Información de {{$history->player->name}}</h2>
            <ul class="text-black text-sm list-none list-inside mt-2">
                <li>Goles: {{$history->goals}}</li>
                <li>Asistencias: {{$history->assits}}</li>
                <li>Tarjetas amarillas: {{$history->yellow_cards}}</li>
                <li>Tarjetas rojas: {{$history->red_cards}}</li>
            </ul>
        </div>
    </div>
</div>
