<script>
//Gen new level
console.log("abe");
function get_exp(){
	add = $.ajax({type: "POST",
					url: "api/api.php",
					data: {comm:'g_exp',
						   email:'<?=$_SESSION['email']?>',
						   pass:'<?=$_SESSION['pass']?>'},
					success: function(data){
						//alert(data);
						hai(data);
					},
					dataType: "text"
	});
}
function hai(data)
{
	expp=parseInt(data);
	if (typeof data === 'undefined')
	{
		return;
	}
	console.log("data");
	console.log(data);
	var myexp=data;
	//var myexp=get_exp();
	console.log("myexp");
	console.log(myexp);
	var cumexp=new Array();
	cumexp=dp_levels(cumexp);
	var lvl=get_level(myexp,cumexp);
	console.log("lvl");
	console.log(lvl);
	var pc=exp_percent(cumexp,lvl+1,myexp);
	var nxt_lvl=exp_to_next_level(cumexp,lvl+1,myexp);
	exp_to_nxt_lvl=nxt_lvl;
	nl=lvl+1;
	$("#levelUp").html("<h3>Level "+(lvl+1).toString()+" <small>"+nxt_lvl.toString()+" point to the next level</small></h3>");
	$("#levelBar").css("width",pc.toString()+"%");
	//#levelBar => % Bar


	function exp_to_next_level(cumexpp,nxt_lvl,exp)
	{
		return (cumexpp[nxt_lvl]-exp);
	}

	function exp_percent(cumexpp,nxt_lvl,exp)
	{
		return Math.floor(((exp-cumexpp[nxt_lvl-1])/(cumexpp[nxt_lvl]-cumexpp[nxt_lvl-1]))*100);
	}

	function get_level(exp,cumexpp)
	{
		var max_limit=50;
		for (var ii=1; ii<=max_limit; ii+=1)
		{
			if (cumexpp[ii]>exp)
			{
				return ii-1;
			}
		}
		return max_limit;
	}

	function dp_levels(cumexpp)
	{
		var max_limit=50;
		cumexpp[0]=0;
		cumexpp[1]=500;
		for (var i=2; i<=max_limit+1; i+=1)
		{
			cumexpp[i]=Math.floor(cumexpp[i-1]*2.1+100);
		}
		return cumexpp;
	}
}

get_exp();
</script>