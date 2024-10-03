<!DOCTYPE html>
<html lang="en" class="h-full antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinchera DEV</title>
    <meta name="description"
        content="Courses, content and resources focused on practical examples of WordPress, Laravel, Tailwind CSS, Alpine JS and more.">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col items-center justify-center h-full">

    <div class="px-6 mx-auto max-w-7xl lg:px-8">
        <div class="text-center">
            <img src="{{ asset('images/tdev/trincheradev-logo.png') }}" alt="Trinchera DEV" class="w-48 mx-auto">

            <h1 class="max-w-3xl mx-auto mt-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl text-balance">
                We are creating the courses and content you need
            </h1>

            <h2 class="max-w-2xl mx-auto my-4 text-lg leading-6 text-gray-600 text-balance">
                We focus on practical examples of WordPress, Laravel, Tailwind CSS, Alpine JS and more.
            </h2>

            <form x-on:submit.prevent="post" x-data="form" class="justify-center mt-5 sm:flex sm:items-center">
                <div class="w-full sm:max-w-xs">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" x-model="email" required
                        class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#000e22] sm:text-sm sm:leading-6"
                        placeholder="you@example.com">
                </div>
                <button type="submit"
                    class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-[#336bb3] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#000e22] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#000e22] sm:ml-3 sm:mt-0 sm:w-auto">
                    Notify me
                </button>
            </form>
        </div>
    </div>

    @if (app()->environment('production'))
    <!-- ActiveCampaign -->
    <script>
        (function (e, t, o, n, p, r, i) { e.visitorGlobalObjectAlias = n; e[e.visitorGlobalObjectAlias] = e[e.visitorGlobalObjectAlias] || function () { (e[e.visitorGlobalObjectAlias].q = e[e.visitorGlobalObjectAlias].q || []).push(arguments) }; e[e.visitorGlobalObjectAlias].l = (new Date).getTime(); r = t.createElement("script"); r.src = o; r.async = true; i = t.getElementsByTagName("script")[0]; i.parentNode.insertBefore(r, i) })(window, document, "https://diffuser-cdn.app-us1.com/diffuser/diffuser.js", "vgo");
        vgo('setAccount', '651451965');
        vgo('setTrackByDefault', true);

        vgo('process');
    </script>
    @endif

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('form', () => ({
                email: '',

                async post() {
                    try {
                        const response = await fetch('https://hook.eu1.make.com/e52txjvuhb2kc6oek9g8a3k1c4p93ijq', {
                            method: 'POST',
                            body: JSON.stringify({ email: this.email }),
                        });

                        if (response.ok) {
                            // Disable the submit button
                            const submitButton = document.querySelector('button[type="submit"]');
                            submitButton.disabled = true;
                            submitButton.classList.add('opacity-50', 'cursor-not-allowed');

                            // Show notification message
                            const notification = document.createElement('div');
                            notification.textContent = 'We will advice you when we launch!';
                            notification.className = 'mt-3 text-sm text-green-800 block text-center';
                            document.querySelector('form').insertAdjacentElement('afterend', notification);

                            // Clear the email input
                            this.email = '';
                        } else {
                            throw new Error('Network response was not ok');
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        console.log('Email sent');
                    }
                }
            }));
        });
    </script>

    @if (app()->environment() === 'production')

    @if (auth()->check() && auth()->user()->id !== 1)
    @else
    <!-- 100% privacy-first analytics -->
    <script data-strict-utm="true" async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <noscript>
        <img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt=""
            referrerpolicy="no-referrer-when-downgrade" />
    </noscript>
    @endif
    @endif
</body>

</html>