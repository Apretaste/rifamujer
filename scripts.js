function status() {
    // get the values
    
    if ($('#target').hasClass( "a" )){var status = true;}
    if ($('#target').hasClass( "b" )){var status = false;}

    // check status of the user
    if (status == true) {
        M.toast({ html: 'Felicidades, ya está participando' });
        return false;
    } else{
        M.toast({ html: 'Abra el servicio Encuesta y finalice la encuesta vigente' });
        return false;
    }
}