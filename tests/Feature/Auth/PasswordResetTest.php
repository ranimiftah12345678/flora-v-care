<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    public function test_password_reset_endpoints_are_not_registered(): void
    {
        $this->get('/forgot-password')->assertNotFound();
        $this->post('/forgot-password')->assertNotFound();
        $this->get('/reset-password/token')->assertNotFound();
        $this->post('/reset-password')->assertNotFound();
    }
}
