const pi = 3.14;

document.querySelector('#calc-btn').addEventListener('click', function (e) {
    e.preventDefault();
    //get diameter value
    var diameter = document.querySelector('#diameter-input').value;

    if (!isNaN(diameter)) {
        console.log(diameter);
        var volume = (4 / 3) * pi * (diameter / 2.0);

        document.querySelector('.result').textContent = volume.toFixed(2);
        document.querySelector('.input-result').value = volume.toFixed(2);
    }
    else {
        console.log('wrong input');
        document.querySelector('.error').textContent = 'Invalid Input';
        return;
    }
});


