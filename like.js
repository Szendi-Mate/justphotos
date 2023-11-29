function addLike(id){
    window.location.replace("addLike.php?type=1&id="+id);
}

function addDislike(id){
    window.location.replace("addLike.php?type=0&id="+id);
}