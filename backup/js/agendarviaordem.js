// $(function (){
// let formularios = document.querySelectorAll('.agendamento');
//
// for (let i = 0; i < formularios.length; i++) {
//     let formulario = formularios[i];
//     let agendamento = formulario.querySelector('#agendamento');
//     let botao = agendamento.querySelector('#botaoEnviar');
//     let sessao = formulario.querySelector('.sessao');
//     botao.addEventListener('click', function (event) {
//
//         event.preventDefault();
//
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//
//         $.ajax({
//             url: "/ordens/agendar",
//             type: "POST",
//             dataType: "json",
//             data: $(this).serialize(),
//             success: function (json) {
//
//                 console.log(json);
//                 console.log('deu certo?');
//
//             }
//         });
//
//         sessao.textContent = "Sessão Agendada com Sucesso!";
//         agendamento.classList.add('fadeOut');
//         setTimeout(function () {
//             agendamento.remove();
//         }, 500);
//     });
// }
// });



$(function () {
    $('.loading').hide();
    $('form').each(function (i) {
        let agendamento = $(this);
        let sessao = $('.sessao').get(i);
        $(this).bind('submit', function (event){
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/ordens/agendar",
                type: "POST",
                dataType: "json",
                data: $(this).serialize(),
                loading: $('.loading').show(),
                success: function (json) {
                    $('.loading').hide();
                    sessao.textContent = "Sessão Agendada com Sucesso!";
                    agendamento.addClass('fadeOut');
                    setTimeout(function () {
                        agendamento.remove();
                    }, 500);
                },
                error: function() {
                    sessao.textContent = "Data inválida ou já utilizada para outro agendamento, com este profissional.";
                    $('.loading').hide();
                }
            });

        });
    });
});
