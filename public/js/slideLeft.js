var h = false;
$('.menuBtn').click(function (event) {
    if (h == false) {
        $('.menu').each(function () {
            $(this).toggle("slow", function () {
                left: "0"
            });
        });
    } else {
        $('.menu').each(function () {
            $(this).toggle("slow", function () {
                left: "50"
            });
        });
    }
});