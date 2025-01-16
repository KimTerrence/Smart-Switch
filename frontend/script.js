//--------------Kim Quines----------------
//--------------script for ui-------------

var title = "Smart Switch";
var subtitle = "Control Your Lights The Light Way ";;
i = 0;

const titleEffect = () => {
    if(i < title.length){
        document.querySelector(".title").innerHTML += title.charAt(i);
        i++;
        setTimeout(titleEffect ,100);
    }
   
}

a = 0;
const subtitleEffect = () => {
    if(i < subtitle.length){
        document.querySelector(".subtitle").innerHTML += subtitle.charAt(a);
        a++;
        setTimeout(subtitleEffect ,50);
    }
}

