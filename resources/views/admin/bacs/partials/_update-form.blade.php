{!!
    Form::open([
        'url' => $url,
        'method' => $method,
        'class' => 'form',
        'enctype' => "multipart/form-data",
    ])
!!}

<div class="box">
    <div class="box-header">
        <i class="fa fa-file-o"></i>
        <strong>
            {{ trans('strings.addingABac') }}
        </strong>
    </div>
    <div class="box-body">
        {{-- Acedemic year --}}
        <div class="form-group">
            <label> {{ trans('strings.academicYear') }} </label>
            <select name="year"
                    class="form-control"
                    required>
                @foreach($years as $y)
                    <option value="{{ $y }}"
                            @if(isset($year) and $y == $year) selected @endif>
                        {{ $y - 1 }} &dash; {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- The branch --}}
        <div class="form-group">
            <label> {{ trans('strings.theBranches') }} </label>
            <select name="branches[]"
                    class="form-control select2"
                    required
                    multiple>
                @foreach(\nataalam\Models\Branch::all() as $branch)
                    <option value="{{ $branch->id }}"
                        @if (isset($curBranches) && $curBranches->contains($branch)) selected @endif>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- The type --}}
        <div class="form-group">
            <label> {{ trans('strings.theType') }} </label>
            <select name="type"
                    class="form-control"
                    required>
                @foreach(nataalam\Models\BacExamFile::$types as $i => $type)
                    <option value="{{ $type }}">
                        {{ trans("strings.$type") }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label> {{ trans('strings.theRegion') }} </label>
            <select name="region" required class="form-control">
                @foreach($regions as $key => $region)
                    <option value="{{ $key }}"
                            {{ (isset($bac) && $bac->region == $key) ? 'selected' : '' }}>
                        {{ trans("strings.$region") }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(!isset($bac))
            {{-- The exam file --}}
            <div class="form-group">
                <label> {{ trans('strings.theExam') }} </label>

                @if(!empty($bac))
                    <br>
                    <input type="checkbox"
                           name="changeExam"
                           class="change-checkbox"
                           id="change-exam-input">
                    <label for="change-exam-input">
                        {{ trans('strings.change') }}
                    </label>
                @endif

                <input type="file"
                       name="exam"
                       class="form-control">
            </div>

            {{-- The correction file --}}
            <div class="form-group">
                <label> {{ trans('strings.theCorrection') }} </label>

                @if(!empty($bac))
                    <br>
                    <input type="checkbox"
                           name="changeCorrection"
                           class="change-checkbox"
                           id="change-correct-input">
                    <label for="change-correct-input">
                        {{ trans('strings.change') }}
                    </label>
                @endif

                <input type="file"
                       name="correction"
                       class="form-control">
            </div>
        @endif

    </div>
    <div class="box-footer">
        <div class="pull-right">
            <a href="{{ URL::previous() }}"
               class="btn btn-warning">
                {{ trans('strings.cancel') }} &nbsp;
                <i class="fa fa-ban"></i>
            </a>
            <button type="submit"
                    class="btn btn-primary">
                {{ trans('strings.ok') }} &nbsp;
                <i class="fa fa-check"></i>
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}