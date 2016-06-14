@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h2>Busca por CEP</h2>
            <form id="busca-por-cep" action="{!! route('api.v1.cep.busca_por_cep', '?') !!}" class="form">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="number" id="cep" name="cep" class='form-control' max-length="8">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit" data-loading="Aguarde...">Buscar</button>
            </form>
        </div>

        <div class="col-lg-6">
            <h2>Busca por Logradouro</h2>
            <form id="busca-por-logradouro" action="{!! route('api.v1.cep.busca_por_logradouro', '?') !!}" class="form">
                <div class="form-group">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" id="logradouro" name="logradouro" class='form-control' max-length="120">
                </div>
                <button class="btn btn-success" type="submit" data-loading="Aguarde...">Buscar</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="row hide" id="retorno">
        <h2>Endereços encontrados</h2>
        <table class="table">
            <thead>
                <th>Logradouro</th>
                <th>Bairro</th>
                <th>Localidade</th>
                <th>CEP</th>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
@endsection()


@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form').submit(function(event) {
                event.preventDefault();
                $('#retorno').addClass('hide');
                $('#retorno table tbody tr').remove();

                var url = $(this).attr('action');
                var form_id = $(this).attr('id');

                if (form_id == 'busca-por-cep') {
                    url = url.replace('?', $('#cep').val());
                    $('#logradouro').val('');
                } else {
                    url = url.replace('?', $('#logradouro').val());
                    $('#cep').val('');
                }

                $.getJSON(url, function(response) {
                    if (response.error == true) {
                        alert('Nenhum endereço encontrado com os parâmetros informados');
                    } else {
                        $('#retorno').removeClass('hide');

                        $.each(response.addresses, function( key, val ) {
                            console.log(val);
                            $('#retorno table tbody').append("<tr><td>" + val['Logradouro/Nome'] + "</td><td>" + val['Bairro/Distrito'] + "</td><td>" + val['Localidade/UF'] + "</td><td>" + val['CEP'] + "</td></tr>");
                        });

                        $('html, body').animate({
                           scrollTop: $("#retorno").offset().top
                       }, 1000);
                    }
                }).fail(function() {
                    console.log('FAIL');
                });
            });
        });
    </script>
@endsection
