<?php

/**
 * Feature Test: Home Route
 * 
 * Test of de home route correct werkt en redirect naar login.
 */
test('home route redirects to login', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});
