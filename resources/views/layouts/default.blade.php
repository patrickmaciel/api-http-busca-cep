<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{!! URL::asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" href="{!! URL::asset('/css/default.css') !!}">
  <title>{!! $title !!}</title>
</head>
<body>
  <div class="container">
    <a href="https://github.com/patrickmaciel/api-http-busca-cep"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>

    <h1>API Http Busca CEP</h1>

    <p>Exemplo de funcionamento da API.</p>
    <p>Caso não esteja funcionando como esperado, certifique-se que seguiu todos os passos conforme descrito no repositório (readme.md).</p>
    <p><em>Obs.: ou talvez exista um erro mesmo ai basta reportar lá no Github ok? :)</em></p>

    @yield('content')
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Nunca deixe sua curiosidade morrer!</p>
    </div>
  </footer>

  <script type="text/javascript" src="{!! URL::asset('/bower_components/jquery/dist/jquery.min.js') !!}"></script>
  <script type="text/javascript" src="{!! URL::asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>

  @yield('javascript')
</body>
</html>
