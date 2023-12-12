

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
            icon: "error",
            background: "url(assets/mcatisb.jpg)",
            color: "#fff"
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
            icon: "error",
            background: "url(assets/mcatisb.jpg)",
            color: "#fff"
          });
        return false;
    }
    return true;
}

function validarPregunta() {

        Swal.fire({
            title: "That Was Not The Correct Answer",
            text: "Try Again!",
            icon: "error",
            background: "url(assets/mcatisb.jpg)",
            color: "#fff"
            
          });
        return false;

}

function sorpresa(){
  Swal.fire({
    title: "Check Your Email",
    text: "We have sent you a surprise via email!",
    icon: "info",
    background: "url(assets/mcatisb.jpg)",
    color: "#fff"
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
        title: "Signed in successfully",
        background: "url(assets/mcatisb.jpg)",
        color: "#fff"
      });
}

function cartAlert(){
  let timerInterval;
  Swal.fire({
    title: "Redirecting to Sign In Page",
    html: "You have to be signed in to add a product to cart.",
    background: "url(assets/mcatisb.jpg)",
    color: "#fff",
    timer: 3000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      const timer = Swal.getPopup().querySelector("b");
      timerInterval = setInterval(() => {
        timer.textContent = `${Swal.getTimerLeft()}`;
      }, 100);
    },
    willClose: () => {
      clearInterval(timerInterval);
    }
  }).then((result) => {
    /* Read more about handling dismissals below */
      window.location.href = "login.php";
  });
}

function incorrectLogin(){
  Swal.fire({
    title: "Incorrect Credentials",
    text: "Verify the entered data",
    icon: "error",
    background: "url(assets/mcatisb.jpg)",
    color: "#fff"
  });
}

function contactAlert(){
  Swal.fire({
    title: "Your message has been submitted!",
    text: "Check your email to see our response",
    background: "url(assets/mcatisb.jpg)",
    color: "#fff"
  });
}

$(document).ready(function () {
  $('#payment_method').change(function () {
      var selectedMethod = $(this).val();

      $('#credit_card_fields, #oxxo_fields').hide();

      $('#' + selectedMethod + '_fields').show();
  });
});