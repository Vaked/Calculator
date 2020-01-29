var buttonPress = $(function () {
    $(".btn").click(function () {
        var clickedButton = $(this).val();
        return clickedButton;
    });
});


// $(document).ready(function() {
//     $(".btn").click(function(){
//         $("input:text").val(buttonPress.clickedButton.val());
//     })
// })