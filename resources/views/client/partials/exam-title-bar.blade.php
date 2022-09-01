<div class="row small-collapse">
    <h3 class="column medium-collapse">
        <div class="column small-12 medium-expand">
            {{ $title }}
            <div class="badge"
                 style="font-size: 0.8rem">
                {{ $count }}
            </div>
        </div>
    </h3>
    <div class="column">
        <div class="row">
            @if(!empty($type))
                <div class="column medium-6">
                    <select name="region"
                            class="highlighted"
                            id="region-select"
                            data-onchange-name="region">
                        <option value="">
                            @if($selectedRegion) {{ trans('strings.allTheRegions') }}
                            @else {{ trans('strings.choseTheRegion') }}
                            @endif
                        </option>
                        @foreach($regions as $region)
                            <option value="{{ $region }}"
                                    @if($region == $selectedRegion) selected @endif>
                                {{ trans("strings.region$region") }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if(empty($type) && count($branches) > 1 || !empty($type) && $type == 'regional')
                <div class="column" style="padding-left: 0;">
                    <select name="branch"
                            class="highlighted"
                            id="branch-select"
                            data-onchange-name="branch">
                        <option value=""> {{ trans('strings.'. ($selectedBranch ? 'allTheBranches' : 'choseYourBranch')) }} </option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"
                                    class="branch-option"
                                    {{ (isset($selectedBranch) && $selectedBranch == $b['id']) ? 'selected' : '' }}
                                    {{ $branch->count == 0 ? 'disabled' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
</div>