let array = [];
let arrayJson;

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };
        $('#formulary').append(`<input type="hidden" name="images" value="${input.files[0]}">`);
        prepareArray(input.files[0]);
        reader.readAsDataURL(input.files[0]);
    }
}

function prepareArray(image){
    array.push(image);
}

// $('#formulary').on('submit', function(e){
//     array.forEach(element => {
//         console.log(element)
//         element = JSON.stringify(element);
//         $('#formulary').append(`<input type="hidden" name="images[]" value="${element}">`);
//     });
// })
