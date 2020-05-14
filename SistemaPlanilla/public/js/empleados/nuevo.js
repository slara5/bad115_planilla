
function submit(btn, campos) {
    console.log( btn);
    return true;
    if ($(".is-invalid").length === 0 && $(".is-valid").length === campos) {
        console.log(true);
        
        return true;
    } else {
        console.log(false);
        
        return false;
    }
}