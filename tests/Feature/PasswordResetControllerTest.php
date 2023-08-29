<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendPasswordResetMail;

class PasswordResetControllerTest extends TestCase
{
    public function testEmailIsSent_whenResetPasswordFormIsSubmitted(): void
    {
        Queue::fake();

        $this->post('/password-reset', ['email' => 'example@test.com']);

        Queue::assertPushed(SendPasswordResetMail::class);
    }
}
