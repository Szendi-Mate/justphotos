const tagInputs = document.getElementsByClassName("tagInput");

function refresh(){
    for (let i = 0; i < tagInputs.length; i++) {
        const inputs = tagInputs[i].getElementsByClassName("form-check-input");
        const labels = tagInputs[i].getElementsByClassName("form-check-label");
        let input = inputs[0];
        let label = labels[0];
        if(input.checked){
            label.classList.remove("bg-danger");
            label.classList.add("bg-success");
        }else{
            
            label.classList.add("bg-danger");
            label.classList.remove("bg-success");
        }
    }
}

window.onload = function() {
    var labels = document.getElementsByTagName('label');
    for (var i = 0; i < labels.length; i++) {
        disableSelection(labels[i]);
    }
};
function disableSelection(element) {
    if (typeof element.onselectstart != 'undefined') {
        element.onselectstart = function() { return false; };
    } else if (typeof element.style.MozUserSelect != 'undefined') {
        element.style.MozUserSelect = 'none';
    } else {
        element.onmousedown = function() { return false; };
    }
}