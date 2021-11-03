<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Генератор коротких ссылок</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<body>
<div class="container">
    <nav class="navbar navbar-dark bg-dark text-white">
        <h2>Генератор коротких ссылок</h2>
    </nav>
    <form class="row g-3 mt-md-10 justify-content-md-center" method="post">
        @csrf
        <div class="col-10">
            <input type="text" name="source-url" id="source-url" class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-warning" style="width: 100%">Генерировать</button>
        </div>
    </form>
    <div class="row mt-md-10 justify-content-md-center">
        <div class="col">
            @yield('generated_url')
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
