function replaceValue(elem_1, elem_2) {
    var valueFirstInput = $('#departure').val();
    var valueSecondInput = $('#arrival').val();
    $('#departure').val(valueSecondInput);
    $('#arrival').val(valueFirstInput);
}

function chooseToday() {
    var currentDate     = new Date();
    var currentDay      = ((currentDate.getDate().toString().length) == 1) ? '0'+(currentDate.getDate()) : (currentDate.getDate());
    var currentMonth    = (((currentDate.getMonth()+1).toString().length) == 1) ? '0'+(currentDate.getMonth()+1) : (currentDate.getMonth()+1);
    var currentYear     = currentDate.getFullYear();
    var today = currentDay + "." + currentMonth + "." + currentYear;
    
    $('#date').val(today);
    $('#date').blur();
}

function randomInteger(min, max) {
    let rand = min + Math.random() * (max + 1 - min);
    return Math.floor(rand);
}

var count = randomInteger(1, 7);
count = count + ' пользователей просматривает эту страницу';
var block = document.getElementById("count-visor");
block.innerHTML = count;