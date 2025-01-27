//--------------Kim Terrence Quines----------------



//--------------script for ui-------------

var title = "Smart Switch";
var subtitle = "Control Your Lights The Light Way ";;
i = 0;

//--------landing page typing effect
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

//-----handle responsive navbar
const handleNav = () => {
    var nav = document.querySelector("#NavCon");
    if (nav.className == "navCon"){
        nav.className = "responsive";
    }else{
        nav.className = "navCon"
    }
}

