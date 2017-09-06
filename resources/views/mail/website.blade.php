<style>
    h1 {
        font-size: 18px;
        color: #0F0F0F;
    }
    em {
        color: #999999;
        font-size: 14px;
    }
</style>

<h1>Mensagem enviada via <b>Protego</b> através do site {{ $Website->domain ?: $Website->subdomain }} </h1> <br>

<em>Enviada: {{ date('d/m/Y h:i:s') }}</em> <br>
<em>Por: {{ $request->contactName }} &#60;{{ $request->contactEmail }}&#62; </em> <br>
<em>Assunto: {{ $request->contactSubject ?: 'Sem título' }}</em> <br><br>

{{ $request->contactMessage }}