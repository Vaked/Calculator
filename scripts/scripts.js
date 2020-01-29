var buttonPress = $(document).ready(function buttonPress() {
    $(".btn").click(function (event) {
        event.preventDefault();
        let clickedButton = $(this).val();
        let temp = $("input:text").val();
        $("input:text").val(temp + "" + clickedButton);
    });
});
