<link rel="icon" type="image/png" href="img/favicon.ico" />
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/mootools-impromptu.js"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/script.js"></script>
<script>
    $(document).on('ready', function ()
    {
       $('.close').on('click', function ()
       {
           var url = window.location.pathname;
          window.location = url;
       });
       
       $('#mo').on('click', function ()
       {
           if($('#divmo').css("display") === 'block')
           {
               $('#divmo').css('display', 'none');
               $(this).text("Mostrar +");
           }else
           {
               $('#divmo').css('display', 'block');
               $(this).text("Mostrar -");
           }
       });

    });
</script>


<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->
<script src="js/bootstrap.min.js"></script>