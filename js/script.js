

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
        Swal.fire({
            title: "Oh!",
            text: "Password Doesn't Match!",
            icon: "error"
          });
        return false;
    }
    return true;
}

function validarContrasena2() {
    var contraseña = document.getElementById("password").value;
    var repetirContraseña = document.getElementById("repetir_password").value;

    if (contraseña !== repetirContraseña) {
        Swal.fire({
            title: "Oh!",
            text: "Password Doesn't Match!",
            icon: "error"
          });
        return false;
    }
    return true;
}

function validarPregunta() {

        Swal.fire({
            title: "That Was Not The Correct Answer",
            text: "Try Again!",
            icon: "error"
          });
        return false;

}

function sorpresa(){
  Swal.fire({
    title: "Oh whats this??",
    text: "We have sent to you a surprise via email",
    icon: "question"
  });
}

function loginAlert(){
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,

      });
      Toast.fire({
        icon: "success",
        title: "Signed in successfully"
      });
}