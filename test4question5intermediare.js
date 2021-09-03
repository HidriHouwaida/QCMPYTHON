function button1()
{
  document.getElementById('button1').style.backgroundColor='red';
  var audio=new Audio('song/faux.mp3')
  audio.play()
}
function button2()
{
  document.getElementById('button2').style.backgroundColor='green';
  window.open("MenuIntermediare.html",'_self',false)
}

