@extends("client.base")

@section("page_title")
    {{ trans('strings.subjectList') }}
@endsection

@section("content")
    {{-- Used for Ajax request--}}
    <input type="hidden"
           name="subject"
           value="{{ $subject->id }}"
           id="subject-input">

    <div class="column small-12 callout callout-success" style="padding: 75px 0; background: {{ $subject->color ?? '#1C758A' }}; color: white">
        <h1 class="text-center">
            <img src="{{ $subject->icon }}" alt="Subject icon" width="60">
            {{ $subject->name }}
        </h1>
    </div>

    <section class="row medium-uncollapse nav-content">
        <section class="column large-9 small-collapse medium-12 ">
            <div class="callout" style="min-height: 300px">

                <div class="columns small-12 small-collapse">
                    <div class="row expanded ">

                        <h1 class="columns  text-medium text-bold shrink">
                            {{ trans('strings.theCourses') }}
                            <div class="badge"
                                 style="font-size: 0.4em"
                                 id="courses-count">
                                0
                            </div>
                        </h1>
                        <div class="column ">
                            <div class="{{ $userHasLevelAndBranch ? 'hidden' : '' }}"
                                 id="level-branch-selects"
                                 data-toggler
                                 data-animate="hinge-in-from-top hinge-out-from-top">
                                <div class="row expanded">
                                    <div class="column">
                                        <select name="level"
                                                id="level-select">
                                            <option value="">
                                                {{ trans('strings.choseYourLevel') }}
                                            </option>
                                            @foreach($levels as $level)
                                                <option value="{{ $level->id }}">
                                                    {{ $level->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="column">
                                        <select name="branch"
                                                id="branch-select"
                                                disabled>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Selects toggle --}}
                            @if ($userHasLevelAndBranch)
                                <div id="lvl-br-toggler"
                                     data-toggler
                                     data-animate="hinge-in-from-top hinge-out-from-top"
                                     class="text-blue pull-left lb-toggle-container">
                                    <div data-equalizer-watch class="lb-toggle">
                                        <a data-toggle="level-branch-selects lvl-br-toggler"
                                           id="toggle-link">
                                            {{ Auth::user()->level->name }},
                                            {{ Auth::user()->branch->name }}
                                        </a>
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <nav>
                    <div class="row expanded" id="courses-container"></div>
                </nav>
            </div>
        </section>
        <section class="column large-3">
            <div class="callout primary">
                <nav class="row" data-equalizer>
                    <div class="column medium-12 end">
                        <a href="{{ route('bacs.index', $subject->id) }}"
                           class="course-link text-blue">
                            {{ trans('strings.bacExams') }}
                        </a>
                    </div>
                    <div class="column medium-12 end">
                        <a href="{{ route('bacs.index', [$subject->id, 'regional']) }}"
                           class="course-link text-blue">
                            {{ trans('strings.regionalExams') }}
                        </a>
                    </div>
                    <div class="column medium-12 end">
                        <a href="{{ route('bacs.index', [$subject->id, 'year9']) }}"
                           class="course-link text-blue">
                            {{ trans('strings.year9Exams') }}
                        </a>
                    </div>
                    <div class="column medium-12 end">
                        <a href="{{ route('bacs.index', [$subject->id, 'year6']) }}"
                           class="course-link text-blue">
                            {{ trans('strings.year6Exams') }}
                        </a>
                    </div>
                </nav>
            </div>
        </section>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {

            var levelSelect = $('#level-select').change(onLevelChange);
            var branchSelect = $('#branch-select').change(fetchCourses);
            var coursesContainer = $('#courses-container');
            var coursesCount =  $('#courses-count');

            function onLevelChange() {
                branchSelect
                    .html('')
                    .removeAttr('disabled');
                levelSelect
                    .find('option[value=""]')
                    .remove();

                var url = '/levels/' + levelSelect.val() + '/branches';
                $.getJSON(url, {}, function(branches) {
                    branches.forEach(addBranchToSelect);
                    fetchCourses();
                });
            }

            function addBranchToSelect(branch) {
                $('#branch-select').append(
                    $('<option>')
                        .val(branch.id)
                        .html(branch.name)
                );
            }

            function fetchCourses() {
                var url = '/subjects/' + $('#subject-input').val()
                        + '/levels/' + $('#level-select').val()
                        + '/branches/' + $('#branch-select').val()
                        + '/courses';

                $.getJSON(url, {}, function(courses) {
                    coursesContainer.html('');
                    courses.forEach(addCourse);
                    coursesCount.html(courses.length);
                });
            }

            function addCourse(course) {
                coursesContainer.append(
                    $('<div class="column medium-3 end">').append(
                        $('<a class="course-link">')
                            .attr('href', '/courses/' + course.id )
                            .html(course.name)
                    )
                );
            }
        })
    </script>
@endsection

