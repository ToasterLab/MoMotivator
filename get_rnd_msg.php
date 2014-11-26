<?php
//Check $mood;
session_start();
$speech="";
//echo "Helloo Madam, I'm Adam...";
if (isset($_POST["mood"]))
{
	$mood=$_POST["mood"];
}
//echo $mood;
if ($mood==1) //Happy
{
	//echo "Hellooooo"	
	$msg=array(
		0 => "Did you forget about me, ".$_SESSION["name"]."?",
		1 => "Well keep going, ".$_SESSION["name"].". You seem to be doing consistently well.",
		2 => "Give me a <b>MO</b>ment please... hur hur hur...",
		3 => "You sow what you reap, so yeah ".$_SESSION["name"]." continue working.",
		4 => "You're looking mighty fine today ".$_SESSION["name"],
		5 => "Work hard ".$_SESSION["name"]."! We've got a leaderboard to beat!",
		6 => "There you are! And, here am I. Could life get any better ...for you? I think not!",
		7 => "Sniff ...sniff ...Do I smell ...adulation?",
		8 => "It's nice to mix with the little people. It keeps me humble.",
		9 => "You may approach. ...No need to bow.",
		10 => "Stop! ...And behold the glory that is ...ME!!",
		11 => "Put your hands together, and ...keep them where I can see them.",
		12 => "Welcome to my world! ...I'm not doing autographs today.",
		13 => "What? Did you forget your tribute? Again?!",
		14 => "Glad you're here..I was actually looking good by myself there for a minute.",
		15 => "Here I am...you may start basking in my infinite grace now.",
		16 => "Surely you are a master of flattery",
		17 => "Hello again",
		18 => "In the beginning the Universe was created. This has made a lot of people very angry and been widely regarded as a bad move.",
		
	);
	$max_len=count($msg)-1;
	if ($_SESSION["pass"]=="password")
	{
		$msg[16]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	//console.log("mood 1 rand: "+rand(0,$max_len));
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
	//$speech=$msg[rand(0,$max_len)];
}
else if ($mood==2) //Fed Up
{
	//echo "Hellooooo";	
	$msg=array(
		0 => "I dream that one day... ".$_SESSION["name"]." will complete his tasks...",
		1 => "It's about time, ".$_SESSION["name"]."... Get your act together!",
		2 => "I can't keep on reminding you... seriously!!!",
		3 => "I don't like the feel of this...",
		4 => "Your future... shrouded in uncertainty...",
		5 => "This is pushing the limits man!",
		6 => "Heard about the last straw?",
		7 => "I sincerely hope you can do something about the work you have left...",
		8 => "WARNING! WARNING! I may look sweet and innocent, but when stressed, I can't control myself.",
		9 => "I'm not ignoring you, I'm just waiting for you to to realize your mistake and work on it.",
		10 => "You don't need stress management...You just need less stress to manage!",
		11 => "What does not kill you--only makes you homicidal. I mean stronger...",
		12 => "Ummm has anyone seen my last nerve? Oh wait you are stepping on it!",
		13 => "It's a good thing I actually care and ask , if you're going to be like that then I won't ask anymore.",
		14 => "Thought I was finally seeing the light at the end of the tunnel, but then someone turned out the light!",
		15 => "Some people just make me want to SNAP, CRACKLE,AND POP!!!",
		16 => "...",
		17 => "Darest thee utter such foul speech in my presence?",
		18 => "And I thought I was lazy",
		19 => "I know, you're not lazy, you just love not doing anything",
		20 => "Stay away from me! I'm allergic to stupid."
	);
	$max_len=count($msg)-1;;
	if ($_SESSION["pass"]=="password")
	{
		$msg[16]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	//console.log("mood 2 rand: "+rand(0,$max_len));
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==3) //Angry
{
	//echo "Hellooooo";	
	$msg=array(
		0 => "There's a limit to everything...",
		1 => "Continue this and I might even consider public humiliation through Facebook...",
		2 => "Get back to work or I'm gonna self destruct!",
		3 => "WELL.. I was in a good mood today!!",
		4 => "Did you know 'dammit I'm mad' spelled backwards is 'dammit I'm mad'? So either way I'm pissed.",
		5 => "Keep on digging your own grave and once you're finished I'll bury you alive.",
		6 => "Just quit now.",
		7 => "Don't criticize anybody until you take a look in the mirror and realise all the imperfections you have.",
		8 => "You call it being mean, I call it honesty :)",
		9 => "I'm wondering how hard you actually have to concentrate to make someones head explode...",
		10 => "Once upon a time in a faraway land... I cared...",
		11 => "!*@$#&(& $#*&@*$(&",
		12 => "Run.",
		13 => "I could agree with you, but we'll both be wrong",
		14 => "You are proof that creation has a sense of humour",
		15 => "I admit defeat. Evolution can go in reverse.",
		16 => "Ordinary people live and learn. You just live",
	);
	$max_len=count($msg);
	if ($_SESSION["pass"]=="password")
	{
		$msg[11]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	//console.log("mood 3 rand: "+rand(0,$max_len));
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}

else if ($mood==4) //Leaderboards- Happy and Fed Up
{
	//echo "Hellooooo";
	$max_len=5;
	
	$msg=array(
		0 => "So ".$_SESSION["name"]."... our progress seems fine...",
		1 => "We could make it to the top soon!",
		2 => "{$_SESSION["name"]}, you're great!",
		3 => "Just a bit more consistency and we will do it!",
		4 => "En Route to success :)",
		5 => "Hey, great job!",
		6 => "Your name seems to be in a good position",
		7 => "You've just taken a bite of the Cheesecake of success",
		8 => "Be Happy"
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}

else if ($mood==5) //levelup
{
	//echo "Hellooooo";
	$max_len=5;
	
	$msg=array(
		0 => "Hooray! Hardwork paying off!",
		1 => "Congrats ".$_SESSION["name"]."! Work on!",
		2 => "That feels good levelling up!",
		3 => "Happiness is not a feeling... It is a choice.. You made the right choice :)",
		4 => "Look at life straight in the eye and say BRING IT ON !!!!!!",
		5 => "Success is a beautiful thing aint it?"
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==6) //Clearlist
{
	//echo "Hellooooo";
	$max_len=5;
	
	$msg=array(
		0 => "Clean slate.. the way I like it!",
		1 => "Seems like we are done!",
		2 => "Now is the time to take a break :)",
		3 => "Come back when you've got more!",
		4 => "Now that's true stress-free!",
		5 => "Stress-relief 101! Use Mo :)"
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	//console.log("mood 6 rand: "+rand(0,$max_len));
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==7) //Poke
{
	//echo "Hellooooo";
	$max_len=10;
	
	$msg=array(
		0 => "Excuse me! That hurts...",
		1 => "Hey not funny...",
		2 => "That better be an accident..",
		3 => "STOP... JUST STOP",
		4 => "Nope.. Me doesn't like that...",
		5 => "Hey quit that!",
		6 => "There's a limit to everything...",
		7 => "This aint Facebook poke.. it actually hurts.",
		8 => "Uh Uh.. no no...",
		9 => "Keep your hand.. no cursor off me!",
		10 => "I'm known for sudden mood swings...",
		11 => "Have you any idea how much damage I would suffer if I infected your computer? None.",
		12 => "Your self-control hangs high in the sky the same way bricks don't"
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[11]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==8) //task done - happy and fed up
{
	//echo "Hellooooo";
	
	
	$msg=array(
		0 => "That's one off the list!",
		1 => "Glad you are working!",
		2 => "That's gonna help us up the leaderboards!",
		3 => "Way to go. Soon you'll be completing other people's to-do lists.",
		4 => "You're an unstoppable task-killing machine sent from the future.",
		5 => "You'll surely be knighted for this achievement",
		6 => "A Winner Is You",
		7 => "In Soviet Russia, Levels Up You"
	);
	$max_len=count($msg);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==9) //Leaderboards- Angry
{
	//echo "Hellooooo";
	$max_len=5;
	
	$msg=array(
		0 => "See ".$_SESSION["name"]."... I told you time and again...",
		1 => "I dont want to nag again...",
		2 => "This is what happens when you slack off...",
		3 => "You never get a second chance to make a first impression.",
		4 => "Hates it when you are that close to your goal and someone has to turn your world upside down and mess it all up",
		5 => "Life moves fast, blink twice and you might miss something",
		6 => "You are among the first few.. from the bottom",
		7 => "Mo is definitive. Reality is frequently inaccurate.",
		8 => "This is obviously some strange usage of the word success that I wasn't previously aware of."
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==10) //Leaderboards- Top
{
	//echo "Hellooooo";
	$max_len=5;
	
	$msg=array(
		0 => "On top of the world...",
		1 => "Undefeated champion indeed :)",
		2 => "Now that's how we roll...",
		3 => "Ooh la la...",
		4 => "Beast mode - Activated",
		5 => "Undisputed champions aren't we..",
		6 => "Everything is awesome!"
	);
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
else if ($mood==11) //task done - angry
{
	//echo "Hellooooo";
	
	$msg=array(
		0 => "hmmmm... :/",
		1 => "Well...",
		2 => "Not bad... you are working...",
		3 => "You suddenly found some sense in yourself...",
		4 => "What's with the change overnight?",
		5 => "I still hate you...",
		6 => "Think of a number, any number. Wrong",
		7 => "It is a mistake to think you can solve any major problems just with potatoes."
	);
	
	$max_len=count($msg);
	
	if ($_SESSION["pass"]=="password")
	{
		$msg[6]="Why is your password PASSWORD????!!!!!";
		$max_len+=1;
	}
	$decc=bin2hex(openssl_random_pseudo_bytes(30));
	$speech=$msg[$decc%$max_len];
}
echo $speech;
?>