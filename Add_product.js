var select = document.getElementById('select');

var dvd_form = document.getElementById('dvd_form');
var book_form = document.getElementById('book_form');
var furniture_form = document.getElementById('furniture_form');

select.addEventListener("change", function () {
    if (select.value == "0") {
       
        book_form.style.display = 'none';
        furniture_form.style.display = 'none';
        dvd_form.style.display = 'none';
    } else if (select.value == "DVD") {
        dvd_form.style.display = 'block';
        book_form.style.display = 'none';
        furniture_form.style.display = 'none';
      
    } else if (select.value == "Book") {
        book_form.style.display = 'block';
        dvd_form.style.display = 'none';
        furniture_form.style.display = 'none';
       
    } else if (select.value == "furniture") {
        furniture_form.style.display = 'block';
        book_form.style.display = 'none';
        dvd_form.style.display = 'none';
      
    }
});
