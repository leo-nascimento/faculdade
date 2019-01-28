//  Masks
$(document).ready(function () {
    alert('sjfejfvjjef');
    $("#dtbirth").mask('00/00/0000', {reverse: true});
    if($("#phone").length < 15)
        $("#phone").mask('00. 0000-0000', {reverse: true});
    else
        $("#phone").mask('(00) 0000-0000', {reverse: true});
});

// Botão de inserir ativo
if($('#name').length > 0 || $('#email').length > 0 || $('#dtbirth').length > 0 || $('#phone').length > 0)
    $('#insert_aluno').prop('disabled', false);
else
    $('#insert_aluno').prop('disabled', true);

// enviando dados
function submitData() {
    $.ajax({
        url: "?controle=Aluno&acao=manterAluno",
        method: "post",
        dataType: "json",
        data: {
            st_nome: $('#name').val(),
            st_email: $('#email').val(),
            st_dt_nascimento: $('#dtbirth').val(),
            st_telefone: $('#phone').val()
        }
    }).done(function(res){
        if(res.error){
            document.getElementById("alert-danger").innerHTML = res.message;
            document.getElementById("alert-danger").style.display = "block";
        }else{
            document.getElementById("name").value = '';
            document.getElementById("email").value = '';
            document.getElementById("dtbirth").value = '';
            document.getElementById("phone").value = '';
            document.getElementById("alert-success").value = "block";
        }
    })
}