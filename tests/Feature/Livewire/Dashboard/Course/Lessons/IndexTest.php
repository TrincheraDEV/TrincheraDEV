<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('dashboard.course.lessons.index');

    $component->assertSee('');
});
