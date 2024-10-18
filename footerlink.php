
<script src="js/jquery/jquery-2.2.4.min.js"></script>

<script src="js/popper.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/plugins.js"></script>

<script src="js/classy-nav.min.js"></script>

<script src="js/active.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-23581568-13');
</script>
<script defer
    src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
    integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
    data-cf-beacon='{"rayId":"809810a67cf36ef2","version":"2023.8.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){ 

        $(document).on("change",".quantity", function(){
     
            

        var studentId = $(this).data("id");
        var qtyval = $(this).val();
       
        $.ajax({
          url: "pro_quantity.php",
          type : "POST",
          data : {id : studentId , val : qtyval},
          success : function(data){
              if(data == 1){
                window.location.href='index.php?did';
              } else {
                window.location.href='index.php';
              }
          }
        });
    });
        
    });
</script>
<script>
    function redirectToPage(select) {
        var selectedValue = select.value;
        var url = 'index.php?pr=' + selectedValue;
        window.location.href = url;
    }
</script>
    