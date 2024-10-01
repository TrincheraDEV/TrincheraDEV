<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('dashboardcourses');

    $component->assertSee('');
});
