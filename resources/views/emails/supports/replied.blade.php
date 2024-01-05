<x-mail::message>
    # Dúvida Respondida

    Assunto da dúvida {{$reply->support_id}} foi respondida com <b>{{$reply->content}}</b>.
    <x-mail::button :url="route('replies.index', $reply->support_id)">
        Ver
    </x-mail::button>

    Obrigado<b>
    {{config('app.name')}}
</x-mail::message>