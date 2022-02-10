$(function () {
    $('.ccm-flashing-diffs').on('click', function() {
        $('.diffmod, .diffins, .diffdel').addClass('diff-blink');
        setTimeout(function () {
            $('.diffmod, .diffins, .diffdel').removeClass('diff-blink');
        }, 1000);
    });
});