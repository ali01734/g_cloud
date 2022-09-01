Hello world
<a href="{{ route('users.confirm', [$user->id, 'code' => $user->verification_code]) }}">
    Confirm your password
</a>