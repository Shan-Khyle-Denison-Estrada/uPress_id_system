<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../node_modules/select2/dist/js/select2.min.js"></script>
<script src="./includes/stepper.js"></script>

<script>
    $(document).ready(function() {
        var $disabledResults = $(".js-example-theme-single");

        var category= [
            "Master of Public Administration (MPA)", "Master of Arts in Education (MAED)", "Master of Arts in Science Education (MA SciEd)"

        ];
        
        $('.js-example-theme-single').select2({
            theme: "classic"
        });
        // $('#select-program').select2({
        //     data:category
        // });
    });
</script>

<!-- stepper script -->
<script>
    $(document).ready(function() {
        text(0);
    });
    function text(x) {
        clearViews();
        if (x == 0) {
            // student
            $('.stud-replacement').hide();
            $('.stud-affidavit').hide();
            // employee
            $('.hrmo').show();
            $('.hrmo-lost').hide();
            $('.emp-affidavit').hide();
        } else if (x == 1) {
            // student
            $('.stud-replacement').show();
            $('.stud-affidavit').hide();
            // employee
            $('.hrmo').show();
            $('.hrmo-lost').hide();
            $('.emp-affidavit').hide();
        } else {
            // student
            $('.stud-replacement').hide();
            $('.stud-affidavit').show();
            // employee
            $('.hrmo').hide();
            $('.hrmo-lost').show();
            $('.emp-affidavit').show();
        }
    };
        $('#new').click(function() {
            text(0);
        });
        $('#rep').click(function() {
            text(1);
        });
        $('#lost').click(function() {
            text(2);
    });

    function clearViews() {
        // student
        $('.stud-replacement').hide();
        $('.stud-affidavit').hide();
        // employee
        $('.hrmo').show();
        $('.hrmo-lost').hide();
        $('.emp-affidavit').hide();
        
    }
    
</script>


