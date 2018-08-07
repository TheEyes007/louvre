const options = {
    format : 'dd/mm/yyyy',
};

(function($){
  $(function(){
      const options = {
          format : 'dd/mm/yyyy',
      };
    $('.sidenav').sidenav();
    $('.datepicker').datepicker(options);
    $('.parallax').parallax();
  }); // end of document ready
})(jQuery); // end of jQuery name space