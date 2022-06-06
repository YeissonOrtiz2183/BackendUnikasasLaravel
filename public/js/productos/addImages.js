let array = [];
let arrayJson;
let count = 0;
const formulario = document.querySelector('.inputFiles');

function readURL(input) {

    count++;
    array.push(input.files[0]);
    console.log(array)
    console.log(input)

    // El input que llega como parametro volverlo invisible
    input.style.display = 'none';
    //Crear un input igual al input que llega como parametro pero con un name diferente
    const inputTwo = `<input type="file" class="inputfile" id="file${count}" name="images[]" onchange="readURL(this);" />`;
    inputTwo.files = input.files[0];
    //Agregar el input al formulario
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
