<?php
	function parseDate($date){
		$dateObject = new DateTime($date);
		$curTime = new DateTime();
		if($curTime->format("mY") !== $dateObject->format("mY")){
			//if the month/year is different, print in natural language
			return $dateObject->format("jS F, Y");
		} else if ($curTime->format("W") > $dateObject->format("W")){
			//check if week is later
			$difference = $curTime->format("W")-$dateObject->format("W");
			if($difference === 1){
				return "last ".strtolower($dateObject->format("l"));
			} else {
				return $difference." weeks ago";
			}
		} else if($curTime->format("w") > $dateObject->format("w")){
			//check if day of the week is later
			$difference = $curTime->format("w")-$dateObject->format("w");
			if($difference === 1){
				return "yesterday, at ".$dateObject->format("h:i a");
			} else {
				return "$difference days ago, at ".$dateObject->format("h:i a");
			}
		} else if($curTime->format("G") > $dateObject->format("G")){
			//check if same hour
			$difference = $curTime->format("G")-$dateObject->format("G");
			if($difference === 1){
				return "an hour ago";
			} else {
				return "$difference hours ago";
			}
		} else if($curTime->format("i") > $dateObject->format("i")){
			//check if same minute
			$difference = $curTime->format("i")-$dateObject->format("i");
			if($difference === 1){
				return "a minute ago";
			} else {
				return "$difference minutes ago";
			}
		} else if($curTime->format("s") > $dateObject->format("s")){
			//check if same second
			$difference = $curTime->format("s")-$dateObject->format("s");
			if($difference === 1){
				return "a mere second ago";
			} else {
				return "$difference seconds ago";
			}
		} else { return "just now"; }
	}
?>