<h1>{{ $subject }}</h1>
<p>
    <b>Имя:</b> {{ $request['name'] }}
</p>
<p>
    <b>Телефон: </b> {{ $request['phone'] }}
</p>
<p>
    <b>Комментарий: </b> {{ $request['message'] ?? '---'}}
</p>


