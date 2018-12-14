     </div>

    <!-- jQuery 3 -->
    <script src="vendor/jquery.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- InputMask -->
    <script src="vendor/input-mask/jquery.inputmask.js"></script>
    <script src="vendor/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="vendor/input-mask/jquery.inputmask.extensions.js"></script>

    <script src="vendor/moment/min/moment.min.js"></script>
    <script src="vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $('#month1').inputmask('9999-99', { 'placeholder': 'yyyy-dd' })
            //Datemask2 mm/dd/yyyy
            $('#month2').inputmask('9999-99', { 'placeholder': 'yyyy-dd' })

            $('#reservation').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('YYYY-MM-DD') + ':' + picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>

</body>

</html>
<!-- end document-->