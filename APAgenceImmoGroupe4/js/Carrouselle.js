var slide = new Array();
var i = 0;

function ChangeImage(sens) {
    i = i + sens;
    if (i < 0)
        i = slide.length - 1;
    if (i > slide.length - 1)
        i = 0;
    document.getElementById("slide").src = slide[i];
}


