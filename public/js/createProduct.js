document.getElementById('addCharacteristicButton').addEventListener('click', function () {
    var characteristicsDiv = document.querySelector('.characteristics');
    var newCharacteristicDiv = document.createElement('div');
    newCharacteristicDiv.classList.add('m-2')
    newCharacteristicDiv.innerHTML = `
            <input type="text" name="characteristics[]" placeholder="Characteristic" class="form-control">
            <input type="text" name="value[]" placeholder="Value" class="form-control">
        `;
    characteristicsDiv.appendChild(newCharacteristicDiv);
});
