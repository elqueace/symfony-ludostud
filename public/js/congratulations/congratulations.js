function playAudio() { 
    
    var randomNb = Math.floor((Math.random() * 3));
    if(randomNb == 0)
    {   audio_congrats0.load();
          audio_congrats0.play(); 
        audio_congrats0.currentTime = 0;
 
    }else if(randomNb == 1)
    {       audio_congrats1.load();
          audio_congrats1.play(); 
        audio_congrats1.currentTime = 0;
 
    }else if(randomNb == 2)
    {       audio_congrats2.load();
          audio_congrats2.play(); 
        audio_congrats2.currentTime = 0;
 
    }
}