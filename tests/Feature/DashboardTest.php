<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    // Ganti dengan URL langsung jika route('login') tidak ditemukan
    $response = $this->get(route('dashboard'));  
    $response->assertRedirect('/login');  // Ganti dengan /login jika perlu
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    // Ganti dengan URL langsung jika route('dashboard') tidak ditemukan
    $response = $this->get(route('dashboard'));
    $response->assertStatus(200);
});
