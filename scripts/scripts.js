var buttonPress = $(function () {
    $(".btn").click(function () {
        var clickedButton = $(this).val();
        $("input:text").val(clickedButton);
    });
});
