<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"> 
<style>
*{box-sizing: border-box}

body{margin:0;overflow:hidden}

/*	
@keyframes animation_slide {
0% {left:0}
20%{left:0}

25%{left:-100%}
45%{left:-100%}

50%{left:-200%}
70%{left:-200%}

75%{left:-300%}
95%{left:-300%}

100%{left:-400%}}*/

@keyframes animation_slide {
	
0% {transform:translatex(0)}
20%{transform:translatex(0)}

25%{transform:translatex(-20%)}
45%{transform:translatex(-20%)}

50%{transform:translatex(-40%)}
70%{transform:translatex(-40%)}

75%{transform:translatex(-60%)}
95%{transform:translatex(-60%)}

100%{transform:translatex(-80%)}
	
	}



	
figure img{
	
pointer-events:none;
height:100vh;
object-fit:contain;
float:left;
width:20%
	
	}
	
	
figure{
position:relative;
/* width:500%; */
width: max-content;
margin:0;
animation:30s animation_slide infinite; 
	
}

@media (min-width:62.75rem){
		
figure img{
	
	object-fit:cover
	
	}
		
	}
</style>

<body>
<figure>
<img src="https://www.guyom-design.com/blog/images/1.jpg" alt/>
<img src="https://www.guyom-design.com/blog/images/2.jpg" alt/>
<img src="https://www.guyom-design.com/blog/images/3.jpg" alt/>
<img src="https://www.guyom-design.com/blog/images/4.jpg" alt/>
<img src="https://www.guyom-design.com/blog/images/1.jpg" alt/>
<div style="width: 20%; margin: 0 auto; position:absolute;">
    <button>Texte</button>
</div>
</figure>
</body>
</html>
