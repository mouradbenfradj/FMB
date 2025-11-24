<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testSetAndGetUsername()
    {
        $user = new User();
        $user->setUsername('testuser');
        $this->assertEquals('testuser', $user->getUsername());
    }

    public function testSetAndGetEmail()
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function testSetAndGetEnabled()
    {
        $user = new User();
        $user->setEnabled(true);
        $this->assertTrue($user->isEnabled());
    }
}
