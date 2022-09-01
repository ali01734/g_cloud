@extends('_partials.form')

@section('form-title')
    {{ $title }}
@endsection

@section('content')
    <div class="form-group">
        {!! Form::label('name', 'Nom', ['class' => 'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::text('name', isset($values['name']) ? $values['name'] : '', [
                'class' => 'form-control',
                'placeholder' => 'Nom de la matière',
                ])
            !!}
        </div>

    </div>
    <div class="form-group">
        {!! Form::label('color', trans('strings.color'), ['class' => 'col-sm-2 control-label']) !!}

        <div class="col-sm-10" >
            {!! Form::text('color', isset($values['color']) ? $values['color'] : '', [
                'class' => 'form-control',
                'placeholder' => trans('strings.color'),
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!!
                Form::textarea('description', isset($values['description']) ? $values['description'] : '', [
                    'class' => 'form-control',
                    'placeholder' => 'Description',
                ])
            !!}
        </div>
    </div>

    {!! Form::hidden('redirect-to', 'admin.subjects.index') !!}

    <div class="form-group">
        {!! Form::label('icons', trans('strings.icon'), ['class' => 'col-sm-2 control-label']) !!}

        <div class="col-md-10">
            <div class="row">
                @foreach($icons as $i => $icon)
                   <div class="icon-widget">
                       @if (!empty($values) && $icon == $values['icon'])
                           {!! Form::radio("icon", $icon, true, ['id' => "icon$i"]) !!}
                       @else
                           {!! Form::radio("icon", $icon, null, ['id' => "icon$i"]) !!}
                       @endif

                       <label for="icon{{ $i }}" class="col-sm-2" style="text-align: center;">
                           <img src="{{ $icon }}" alt="icon" style="max-width: 60px">
                       </label>
                   </div>
                @endforeach
            </div>
        </div>
    </div>

@overwrite