$(document).ready(function(){
    var boolean=$( "#content_section > div.box.box-default > div > table > tbody > tr:nth-child(3) > td:nth-child(2)" ).html();
    boolean=parseInt(boolean);
    console.log(boolean);
    if(boolean ==1 || boolean==0){
        var value= boolean ==1 ? "SI" : "NO";
        $( "#content_section > div.box.box-default > div > table > tbody > tr:nth-child(3) > td:nth-child(2)" ).replaceWith("<td>"+value+"</td");
    }
});
