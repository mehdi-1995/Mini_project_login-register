<x-mail::message>
    click on the button link

    The body of your message.

    <x-mail::button :url="$token">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
