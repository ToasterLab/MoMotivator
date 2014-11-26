	var betweenBlink = Math.floor(1300);
	var blinkDuration = Math.floor(50);
	
	var clicks = 0;
	
	var moodString = 'happy';//happy,fedUp,angry
	
	var blue = '#51A7F9';
	var lightBlue = '#BCD9F3';
	
	var interval;
	var timeout;
	var angryTime;
	
	function startBlink(){
		interval = window.setInterval(function(){blink()},betweenBlink);
		timeout = window.setTimeout(function(){hai()},blinkDuration);
	}
	
	$(document).ready(function(){
		$("img.mo").hide();
	});
	
	function hai(){
		window.setInterval(function(){openEyes()},betweenBlink);
	}
	
	function stopBlink(){
		clearTimeout(timeout);
		clearInterval(interval);
	}
	
	function changeMood(newMood){
		console.log('moodString changed to '+newMood);
		$(".mo").hide();
		moodString = newMood;
		$("img."+newMood+".openEye").show();
		if(newMood == 'angry'){
			$(".mainBar").css({boxShadow:'inset 0 0 20px 3px #FF0000'});
			angryTime = window.setInterval(function(){
				if(moodString == 'angry'){
					$(".mainBar").animate({boxShadow:'inset 0 0 20px 3px #FF0000'}).delay(500).animate({boxShadow:'inset 0 0 20px 10px #FF0000'});
				}
			},1000);
		}
		if(newMood == 'happy'){
			window.clearInterval(angryTime);
			$(".mainBar").css({boxShadow:'inset 0 0 0 0 #FFF'});
		}
	}
	
	function blink(){
		console.log('blink .openEye.'+moodString);
		$(".openEye."+moodString).hide();
		$(".closeEye."+moodString).show();
	}
	
	function openEyes(){
		console.log('open');
		$(".openEye."+moodString).show();
		$(".closeEye."+moodString).hide();
	}
	
	function wink(){
		/*face.animate({
			backgroundColor: "#008DE8"
		}, 400 );
		leftEye.transition({ rotate: '360deg' });
		rightEye.transition({ rotate: '360deg' });
		leftEye.replaceWith(blinkLeft);
		face.animate({
			backgroundColor: "#0071BA"
		}, 400 );*/
	}
	