<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testInstantiation(): void
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
    }

    public function testSettersAndGetters(): void
    {
        $user = new User();

        $user->setUsername('testuser');
        $this->assertEquals('testuser', $user->getUsername());

        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());

        $user->setPlainPassword('password');
        $this->assertEquals('password', $user->getPlainPassword());
    }

    public function testToString(): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $this->assertEquals('testuser', (string) $user);
    }
}
