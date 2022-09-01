{!! Form::open(['method'=>'post','class' => 'row']) !!}
{!! csrf_field() !!}
{!! Form::text('username',isset($values['username']) ? $values['username'] : '',
['class'=>'column small-12','placeholder'=>'اسم المستعمل']) !!}
{!! Form::password('password','',['class'=>'column small-12',
'placeholder'=>'كلمة المرور']) !!}
{!! Form::submit('OK', ['class' => 'column small-12']) !!}
{!! Form::close() !!}