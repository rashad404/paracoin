<section class="games-section">

    <?php
    $league_name_old='';
    $league_name='';
    $league_begin = '<div class="league_name">test LEAGUE</div>';

    $league_end = '';

    ?>

    @foreach ($list as $item)
        <div>

            <?php
            if ($league_name_old != $item->leagueId && \App\Helpers\Shared::getGameOrder() == 'league') {
                $league_name_old = $item->leagueId;
                echo '<div class="league_name">'.$item->leagueName.'</div>';
            }

            ?>
            <span class="game_time">
                {!! App\Helpers\Game::gameTime($item->status, $item->halfStartTime, $item->matchTime) !!}
            </span>
            {{ $item->homeName }}
            @if($item->homeRed>0)
                <span class="red-card">{{$item->homeRed}}</span>
            @endif
            @if($item->homeYellow>0)
                <span class="yellow-card">{{$item->homeYellow}}</span>
            @endif
            <a href="/game-info/{{ $item->matchId }}/{{App\Helpers\Url::genLink($item->homeName.'-'.$item->awayName)}}">
                {{ (in_array($item->status, array(-1,1,2,3,4,5))) ? $item->homeScore .'-'. $item->awayScore : '-' }}
            </a>

            {{ $item->awayName }}
            @if($item->awayRed>0)
                <span class="red-card">{{$item->awayRed}}</span>
            @endif
            @if($item->awayYellow>0)
                <span class="yellow-card">{{$item->awayYellow}}</span>
            @endif
        </div>
    @endforeach
</section>
