{!!
    Form::open([
        'url' => $url,
        'method' => $method,
        'enctype' => "multipart/form-data"
    ])
!!}
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-pencil"></i>
            {{ isset($title) ? $title : '' }}
    </h3>
    </div>

    <div class="box-body">

        <div class="form-group">
            <label> {{ trans('strings.theBranches') }} </label>
            <select name="branches[]"
                    class="form-control select2"
                    multiple>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}"
                            {{ isset($exam) && $exam->branches->contains($branch) ? 'selected' : '' }}
                    >
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- File --}}
        <div class="form-group">
            <label> {{ trans('strings.theFile') }} </label>
            @if (isset($exam))
                <input type="checkbox"
                       name="keep_exam"
                       id="keep-exam"
                       class="change-checkbox"
                       checked>
                <label for="keep-exam">
                    {{ trans('strings.keepSameFile') }}
                </label>
            @endif
            <input type="file" name="exam">
        </div>

        {{-- Correction --}}
        <div class="form-group">
            <label> {{ trans('strings.theCorrection') }} </label>
            @if (isset($exam))
                <input type="checkbox"
                       name="keep_correction"
                       id="keep-corrct"
                       class="change-checkbox"
                        {{ $hasCorrection ? 'checked' : '' }}>
                <label for="keep-corrct">
                    {{ trans('strings.keepSameFile') }}
                </label>
            @endif
            <input type="file" name="correction">

        </div>

        {{-- Courses --}}
        <div class="form-group">
            <label>
                {{ trans('strings.theCourses') }}
            </label>
            <select name="courses[]"
                    class="select2"
                    multiple="multiple"
                    style="width: 100%;">

                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                            @if(isset($exam) && $exam->courses->contains($course->id))
                                selected
                            @endif>
                        {{ $course->name }}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="">
                {{ trans('strings.description') }}
            </label>
            <input type="text"
                   name="description"
                   class="form-control"
                   value="{{ isset($exam) ? $exam->description : '' }}">
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit"
                    class="btn btn-success">
                {{ trans('strings.ok') }}
                &nbsp;
                <i class="fa fa-check"></i>
            </button>
            <a href="{{ URL::previous() }}"
               class="btn btn-warning">
                {{ trans('strings.cancel') }}
                &nbsp;
                <i class="fa fa-ban"></i>
            </a>
        </div>
    </div>
</div>
{!! Form::close() !!}