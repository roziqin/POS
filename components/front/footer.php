 </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/jquery.price_format.2.0.js" type="text/javascript"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script type="text/javascript"> $('#price').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); </script>
    
    <script type="text/javascript">
    $(document).ready(function(){ 
        $("#ip-diskon").change(function(){
            var total = $("#ip-total").val();
            var tipebayar = $("#ip-potongan").val();
            console.log(tipebayar)
            if (tipebayar == "Diskon") {
                var diskon = total*$("#ip-diskon").val()/100;    
            } else {
                var diskon = $("#ip-diskon").val();
            }
            var jumlah = total-diskon;
            var tax = jumlah*0.1;
            console.log(tax);
            console.log(tax.toString().length);
            if (tax.toString().length == 3) {
                if (tax.toString().slice(0) == 0 ) {
                    tax = 0;
                } else if (tax.toString().slice(0) <= 500 ) {
                    tax = 500;
                } else {
                    tax = 1000;
                }
                console.log("tax "+tax);

            } else if (tax.toString().length == 4) {
                if (tax.toString().slice(1) == 0 ) {
                
                    tax = tax.toString().slice(0,1)+"000";
                
                } else if (tax.toString().slice(1) <= 500 ) {
                
                    tax = tax.toString().slice(0,1)+"500";
                
                } else {
                
                    tax = parseInt(tax.toString().slice(0,1))+1+"000";
                
                }

                tax = parseInt(tax);


            } else if (tax.toString().length == 5) {

                if (tax.toString().slice(2) == 0 ) {
                    
                    tax = tax.toString().slice(0,2)+"000";

                } else if (tax.toString().slice(2) <= 500 ) {
                    
                    tax = tax.toString().slice(0,2)+"500";
                
                } else {
                    
                    tax = parseInt(tax.toString().slice(0,2))+1+"000";
                
                }
                tax = parseInt(tax);

            } else {

                if (tax.toString().slice(3) == 0 ) {
                    
                    tax = tax.toString().slice(0, 3)+"000";

                } else if (tax.toString().slice(3) <= 500 ) {
                    
                    tax = tax.toString().slice(0, 3)+"500";
                
                } else {
                    
                    tax = parseInt(tax.toString().slice(0, 3))+1+"000";
                
                }
                tax = parseInt(tax);


            }
            //var tax1 = tax.priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 });
            //var result = $(tax1).text().split('|');
            console.log(" "+tax.toString().length );
            var jumlahakhir = jumlah + tax;
            console.log(total+" "+tipebayar+" "+diskon+" "+jumlah+" -tax: "+tax+" "+jumlahakhir);
            $("#ip-tax").val(tax);
            $("#display_tot").text(jumlahakhir).priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 });
        });
       setInterval(function(){ 
        $.ajax({url: "components/display_notification.php", success: function(result){
            $("#notification").html(result);
        }});
      }, 3000);
    });
    </script>
</body>

</html>
<!-- end document-->