/*
VALIDACIONES:
    -validar_string(input)
    -validar_string_formato(input, formato, separador, numeros=true)
    -validar_string_con_longitud(input, longitud, numeros=false)
    -validar_numero(input, min = 0, max = Infinity)
    -validar_nombre(input)
    -validar_fecha(input)  //formato dd/mm/aaaa
    -validar_correo(input)
*/ 

function validar_string(input) {
    if (input.value.trim() != "") {
        valido(input);
    } else {
        invalido(input);
    }
    submit_form();
}
function validar_string_formato(input, formato, separador, numeros = true) {
    let string = input.value;
    let array_formato = formato.split(separador);
    let array_string = string.split(separador);


    if (array_formato.length == array_string.length && formato.length == string.length) {
        if (numeros) {
            let ok = true;
            for (let index = 0; index < array_formato.length; index++) {
                if (isNaN(Number(array_string[index]))) {
                    ok = false;
                    break;
                }
            }
            if (ok) {
                valido(input);
            } else {
                invalido(input);
            }
        } else {
            // let ok = true;
            // for (let index = 0; index < array_string.length; index++) {
            //     if(array_formato[index].length !== array_string[index].length
            //         && array_string[index] != []
            //         ){
            //         ok = false;
            //         break;
            //     }
            // }
            // if (ok) {
            //     valido(input);
            // } else {
            //     invalido(input);
            // }
            valido(input);
        }
    } else {
        invalido(input);
    }
    submit_form();
}

function validar_string_con_longitud(input, longitud, numeros = false) {
    if (numeros) {
        if (input.value.trim() != "" && input.value.trim().length === longitud) {
            let ok = true;
            let array_string = input.value.trim();
            for (let index = 0; index < array_string.length; index++) {
                if (isNaN(Number(array_string[index]))) {
                    ok = false;
                    break;
                }
            }
            if (ok) {
                valido(input);
            } else {
                invalido(input);
            }
        } else {
            invalido(input);
        }
    } else {
        if (input.value.trim() != "" && input.value.trim().length >= longitud) {
            valido(input);
        } else {
            invalido(input);
        }
    }

    submit_form();
}
function validar_numero(input, min = 0, max = Infinity) {
    let valor = Number(input.value);
    if (!isNaN(valor)) {
        if (valor >= min && valor <= max) {
            valido(input);
        } else {
            invalido(input);
        }
    } else {
        invalido(input);
    }
    submit_form();
}
function validar_nombre(input) {
    if (input.value.trim() != "" && isNaN(Number((input.value)[0]))) {
        valido(input);
    } else {
        invalido(input);
    }
    submit_form();
}

function validar_fecha(input) {
    const RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
    if ((input.value.match(RegExPattern)) && (input.value != '')) {
        let fecha = input.value.split("/");
        let day = fecha[0];
        let month = fecha[1];
        let year = fecha[2];
        let date = new Date(year, month, '0');
        if ((day - 0) > (date.getDate() - 0)) {
            invalido(input)
        } else {
            valido(input);
        }
    } else {
        invalido(input);
    }
    submit_form();
}

function validar_correo(input) {
    let valor = input.value;
    let patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (patron.test(valor)) {
        valido(input);
    } else {
        invalido(input);
    }
    submit_form();
}

function submit_form() {
    if ($(".is-invalid").length == 0) {
        $("#btn_submit").removeAttr('disabled');
    } else {
        $("#btn_submit").attr('disabled', 'disabled');
    }
}

function valido(input) {
    $(input).removeClass("is-invalid");
    $(input).addClass("is-valid");
    $(input).next().css("display", "none");
}
function invalido(input) {
    $(input).removeClass("is-valid");
    $(input).addClass("is-invalid");
    $(input).next().css("display", "block");
}