let array = [];
let arrayJson;
let count = 0;
const formulario = document.querySelector('.inputFiles');
const divImage = document.querySelector('.mySlides');

function readURL(input) {

    count++;
    array.push(input.files[0]);


    input.style.display = 'none';

    const inputTwo = `<input type="file" class="inputfile" id="file${count}" name="images[]" onchange="readURL(this);" />`;
    inputTwo.files = input.files[0];

    const img = ``


    formulario.insertAdjacentHTML('beforeend', inputTwo);

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
