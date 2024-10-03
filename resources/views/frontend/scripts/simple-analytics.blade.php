@if (app()->environment() === 'local')

@if (auth()->check() && auth()->user()->id !== 1)
@else
<!-- 100% privacy-first analytics -->
<script data-strict-utm="true" async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
<noscript>
    <img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" />
</noscript>
@endif
@endif