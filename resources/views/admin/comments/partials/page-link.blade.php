@if($cmt->lesson_id)
    <a href="{{ route('lessons.show', $cmt->lesson->id) }}#comment-{{ $cmt->id }}"
       target="_blank">
        {{ $cmt->lesson->name }}
    </a>
@elseif($cmt->exercise_id)
    <a href="{{ route('exercises.show', $cmt->exercise->id) }}#comment-{{ $cmt->id }}"
       target="_blank">
        {{ $cmt->exercise->name }}
    </a>
@elseif($cmt->bac_subject_id)
    <a href="{{ route('bacs.index', $cmt->bacSubject->id) }}#comment-{{ $cmt->id }}"
       target="_blank">
        {{ $cmt->bacSubject->name }}
    </a>
@elseif($cmt->regional_subject_id)
    <a href="{{ route('bacs.index', [$cmt->regionalSubject->id, 'regional']) }}#comment-{{ $cmt->id }}"
       target="_blank">
        {{ $cmt->regionalSubject->name }}
    </a>
@endif