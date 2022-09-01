<li class="off-canvas-lb-selects">
    <div class="row">
        <div class="column small-12">
            <select name="level"
                    class="level-select">
                @if(!$currentUserLevel)
                    <option value="">
                        {{ trans('strings.choseYourLevel') }}
                    </option>
                @endif
                @foreach($selectLevels as $level)
                    <option value="{{ $level->id }}"
                            {{ $level == $currentUserLevel ? 'selected' : '' }}>
                        {{ $level->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="column small-12 ">
            <select name="branch"
                    class="branch-select"
                    {{$currentUserBranch ? '' : 'disabled'}}>

                @if($currentUserBranch)
                    @foreach($selectBranches as $branch)
                        <option value="{{ $branch->id }}"
                                {{ $branch == $currentUserBranch ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                @else
                    <option value="">
                        {{ trans('strings.choseYourBranch') }}
                    </option>
                @endif
            </select>
        </div>
    </div>
</li>

