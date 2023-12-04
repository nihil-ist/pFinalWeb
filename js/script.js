

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
