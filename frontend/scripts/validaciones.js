function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1) {
        if (!tecla_especial)
            return false;
    }
}

function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1) {
        if (!tecla_especial)
            return false;
    }
}

function soloDecimales(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789.";
    especiales = "8-9-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1) {
        if (!tecla_especial)
            return false;
    }
}

function validarCedula() {
    var cedula = document.add_empleado.cedula.value
    longitud = cedula.length;
    valor = cedula;
    prov = valor.substring(0, 2);
    if ((prov >= 1) && (prov <= 24))
    {
        if (longitud == 10) {
            if (valor.substring(3, 2) >= 0 && valor.substring(3, 2) <= 5) {
                suma = 0;
                aux = 0;
                for (cont = 0; cont < 9; cont++) {
                    if ((cont % 2) == 0) {
                        if ((parseInt(valor[cont]) * 2) >= 10) {
                            aux = (parseInt(valor[cont])) * 2;
                            suma = suma + parseInt(aux / 10) + (aux % 10);
                        }
                        else {
                            suma = suma + (parseInt(valor[cont]) * 2);
                        }
                    }
                    else {
                        suma = suma + parseInt(valor[cont]);
                    }
                }
                if ((10 - (suma % 10)) == valor[9]) {
                    ban = 1;
                }
                else {
                    if ((suma % 10) == 0 && valor[9] == 0) {
                        ban = 1;
                    }
                    else {
                        ban = 0;
                    }
                }
            }
            else {
                ban = 0;
            }
        }
        else {
            if (longitud == 13) {
                if (valor.substring(11, 10) == 0 && valor.substring(12, 11) == 0 && valor.substring(13, 12) >= 1
                    && valor.substring(13, 12) <= 9) {
                    if (valor.substring(3, 2) == 9) {
                        suma = 0;
                        aux = 0;
                        coef = 4;
                        for (cont = 0; cont < 9; cont++) {
                            if (cont == 3) {
                                coef = 7;
                            }
                            suma = suma + (parseInt(valor[cont]) * coef);
                            coef = coef - 1;
                        }
                        if ((suma % 11) == 0 && valor[9] == 0) {
                            ban = 1;
                        }
                        else {
                            if ((11 - (suma % 11)) == valor[9]) {
                                ban = 1;
                            }
                            else {
                                ban = 0;
                            }
                        }
                    }
                    else {
                        if (valor.substring(3, 2) == 6) {
                            suma = 0;
                            aux = 0;
                            coef = 3;
                            for (cont = 0; cont < 8; cont++) {
                                if (cont == 2) {
                                    coef = 7;
                                }
                                suma = suma + (parseInt(valor[cont]) * coef);
                                coef = coef - 1;
                            }
                            if ((suma % 11) == 0 && valor[8] == 0) {
                                ban = 1;
                            }
                            else {
                                if ((11 - (suma % 11)) == valor[8]) {
                                    ban = 1;
                                }
                                else {
                                    ban = 0;
                                }
                            }
                        }
                        else {
                            suma = 0;
                            aux = 0;
                            for (cont = 0; cont < 9; cont++) {
                                if ((cont % 2) == 0) {
                                    if ((parseInt(valor[cont]) * 2) >= 10) {
                                        aux = (parseInt(valor[cont])) * 2;
                                        suma = suma + parseInt(aux / 10) + (aux % 10);
                                    }
                                    else {
                                        suma = suma + (parseInt(valor[cont]) * 2);
                                    }
                                }
                                else {
                                    suma = suma + parseInt(valor[cont]);
                                }
                            }
                            if ((10 - (suma % 10)) == valor[9]) {
                                ban = 1;
                            }
                            else {
                                if ((suma % 10) == 0 && valor[9] == 0) {
                                    ban = 1;
                                }
                                else {
                                    ban = 0;
                                }
                            }
                        }
                    }
                }
                else {
                    ban = 0;
                }
            }
            else {
                ban = 0;
            }
        }
    }
    else {
        ban = 0;
    }
    if (ban == 1) {
        return 1;
    }
    else {
        alert("Identificación incorrecta...");
    }
}

function leerURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}