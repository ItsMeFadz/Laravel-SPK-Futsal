// restrict-date

document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    var minDate = yyyy + '-' + mm + '-' + dd;

    document.querySelectorAll('.restrict-date').forEach(el => {
        el.setAttribute('min', minDate);
    });
});