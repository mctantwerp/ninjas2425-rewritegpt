<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rewrite GPT</title>

        <!-- Styles / Scripts -->

    </head>
    <body>
        <h1>Rewrite GPT</h1>

        <h2>API Key : </h2>
        <form action="{{ route('store.apikey') }}" method="POST">
            @csrf
            <input type="text" name="api_key" placeholder="Enter your OpenAI API key here..." value="{{ $information->api_key }}">
            <button type="submit">Submit</button>
        </form>

        <h2>Options : </h2>
        <form action="" method="POST">
            @csrf
            <input type="radio" name="options" value="1"> Rewrite
            <br>
            <input type="radio" name="options" value="2"> Translate
            <br>
            <button type="submit">Save</button>
        </form>
    </body>
</html>
