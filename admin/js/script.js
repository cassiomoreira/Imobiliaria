<script>    
    function ValidarData(data){
        var splitData = data.slit("/");
        var dt = new Date();
        if(splitData.length === 3){
            if(slitData[0] >= 01 && splitData[0] <= 31){
                if(splitData[1] >= 01 && splitData[1] <= 12){
                    if(splitData[2] >= (dt.getFullYear() - 100) && splitData[2] <= (dt.getFullYear() - 10)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function delete_cookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

    
</script>