<?php

use nataalam\Models\User;
use nataalam\TransactionTrait;

class UserTest extends TestCase
{
    use TransactionTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHasPhoto()
    {
        $user = User::where('is_admin', true)->first();
        $this->assertTrue($user->hasPhoto());
    }

    public function testNameAttribute()
    {
        $user = User::where('is_admin', true)->first();
        $this->assertEquals(
            $user->firstName . ' ' . $user->lastName,
            $user->name
        );
    }
}
