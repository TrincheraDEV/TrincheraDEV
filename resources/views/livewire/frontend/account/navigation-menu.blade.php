<?php

namespace App\Http\Livewire\Frontend\Settings;

use Livewire\Volt\Component;

new Class extends Component {

}
?>

<flux:navlist>
    <flux:navlist.item icon="user" href="/account">Account</flux:navlist.item>
    @if(auth()->user()->subscribed('basic') || auth()->user()->subscriptions()->count() >= 1)
    <flux:navlist.item icon="currency-dollar" href="{{ route('billing') }}" target="_blank">Billing</flux:navlist.item>
    @else
    <flux:navlist.item icon="currency-dollar" href="{{ route('pricing') }}">Pricing</flux:navlist.item>
    @endif
</flux:navlist>