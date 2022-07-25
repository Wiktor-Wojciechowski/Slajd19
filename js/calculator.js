const pi = 3.14;

var calc_btn = document.querySelector('#calc-btn');
var diamInput = document.querySelector('#diameter-input');
var result = document.querySelector('.result');

var diameter = parseFloat(diamInput.value);
console.log(diameter);

calc_btn.addEventListener('click', function (e) {
    e.preventDefault();
    result.textContent = sphereVolume(diameter);
})

function sphereVolume(diameter) {
    var diameter = parseFloat(diamInput.value);
    console.log(diameter);

    var radius = diameter / 2.0;
    var volume = 4 / 3 * pi * radius ** 3;
    return volume.toFixed(2);
}