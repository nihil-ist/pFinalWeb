

$(window).scroll(function() {
    if ($(this).scrollTop() > 0) { 
      $('.navbar-custom').addClass('scrolled');

    } else {
      $('.navbar-custom').removeClass('scrolled');


    }
});


$(document).ready(function(){
    $('#registerButton').click(function(){
        $('#exampleModal').modal('hide');
        $('#exampleModal').on('hidden.bs.modal', function () {
            $('#modalSignin').modal('show');
        });
    });
});

function validarContraseña() {
    var contraseña = document.getElementById("password").value;
    var repetirContraseña = document.getElementById("repetir_password").value;

    if (contraseña !== repetirContraseña) {
        alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
        return false;
    }

    return true;
}