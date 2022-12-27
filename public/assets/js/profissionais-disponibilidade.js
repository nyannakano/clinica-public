$(document).ready(function(){
    let ativado = "false";
    // Selecionando se está disponível ou não
    $('form').each(function (i) {
        let diaselecionado = "#dia" + i;
        $(diaselecionado).change(function () {
            ativado = $(this).val();

            console.log(ativado);
            console.log(i);

            if (ativado === "false") {
                $(".horarios" + i).prop("disabled", true);
            } else if (ativado === "true") {
                $(".horarios" + i).prop("disabled", false);
            }
        });
    })

})
