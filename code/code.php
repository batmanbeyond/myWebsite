<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title> joe mckenney </title>
	
		<!-- Include required JS: Core and at least one Brush (XML here).
		     You need to include a brush for every language you want.    -->
		<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.js"></script>
		<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJava.js"></script>
		<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushMatlab.js"></script>
		

		<!-- Include required CSS: Core and one Theme (Default here). -->
		<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCore.css"/>
		<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemeRDark.css"/>

		<!-- Start the highlighter. -->
		<script type="text/javascript">
		    SyntaxHighlighter.all();
		</script>
		
		<link  href="http://cs.mills.edu/~jmckenney/style.css" rel="stylesheet"    type="text/css" /> 
		<script language="JavaScript">
		    function toggle(id) {
		        var state = document.getElementById(id).style.display;
		            if (state == 'block') {
		                document.getElementById(id).style.display = 'none';
		            } else {
		                document.getElementById(id).style.display = 'block';
		            }
		        }
		</script>	
		
		<script language="JavaScript" type="text/javascript">

		function ExpandCollapse(ElementId) {
			var ClickedElement = document.getElementById(ElementId);
			var SectionElement = ClickedElement.parentNode;
			var GroupElement = SectionElement.parentNode;
			var SpanSiblings = SectionElement.getElementsByTagName("span");
			var DivSiblings = SectionElement.getElementsByTagName("div");
			if (ClickedElement.innerHTML == "hide") {
				// this code turns this section off
				ClickedElement.innerHTML = "{...}";
				SpanSiblings[1].innerHTML = "";
				DivSiblings[0].style.display = "none";
			} else {
				// this code turns this section on and all other sections off
				ClickedElement.innerHTML = "hide";
				SpanSiblings[1].innerHTML = "";
				DivSiblings[0].style.display = "block";
				var otherSections = GroupElement.getElementsByTagName("div");
				for (i=0; i<otherSections.length; i++) {
					// first make sure this div is an immediate child of the parent group
					if (otherSections[i].parentNode.id == GroupElement.id ) {
						// next make sure this section is not the one you just expanded
						if (otherSections[i].id != SectionElement.id) {
							// collapse this section
							var x = document.getElementById(otherSections[i].id);
							var SpanSiblings = x.getElementsByTagName("span");
							var DivSiblings = x.getElementsByTagName("div");
							SpanSiblings[0].innerHTML = "{...}";
							SpanSiblings[1].innerHTML = "Show";
							DivSiblings[0].style.display = "none";
						}
					}
				}
			}
		}
		</script>
		
	</head>

<body>
<div id="group">

<div id="post1">			
 <div class="post_title">				
			<h2>
				<a onClick= "toggle('androidCalc');" href="" >a simple brain for my android calculator</a>
			</h2>	
		<span id="tick1" class="clickit" onclick="ExpandCollapse(this.id);">{...}</span>
		<span id="act1"></span>
		<div id="text1" style="display: none;">
			
		So I wrote a little android calculator when I was beginning to get into android. 
		I thought that the "brain" of the calculator I created was a neat and intuitive 
		way to complete this calculations.  Here it is: 

		For each of our operations I grab the number value from the TextView: 
		<pre class="brush: java; title: Code;">
			TextView numValue = (TextView)findViewById(R.id.NumValue);  
			CharSequence currentValue = numValue.getText(); 
			String theCurrentValue = currentValue.toString(); 
		</pre>

		I convert the value to a string and... 
		<pre class="brush: java; title: Code;">
			storeStack.push(theCurrentValue); 
			storeStack.push("the symbol for operand you are using"); 
			numValue.setText(""); 
		</pre>

		We are simply pushing all of the values onto a stack and waiting for the equals 
		button to be pressed.

		Once equals is pressed: 
		<pre class="brush: java; title: Code;">
			private double sumValue(){ 
				if(storeStack.isEmpty()) {return value;} 
		 		else{ 
					val = storeStack.pop(); 
			 		if(val.equals(PLUS)) {value = value + sumValue();} 
					else if(val.equals(MINUS)) {value = -value + sumValue();} 
					else if(val.equals(DIV)) { value = (1/value); value = value * sumValue();} 
					else if(val.equals(TIMES)) {value = value * sumValue();} 
					else{value = Double.parseDouble(val); sumValue();} 
					} 
					return value; 
				} 
		</pre>
		</div>
 </div>	
</div>	

<div id="post2">
<div class="post_title">				
			<h2>
				<a href="">	a phase vocoder for time compressions and expansion</a>
			</h2>
		<span id="tick2" class="clickit" onclick="ExpandCollapse(this.id);">{...}</span>
		<span id="act2"></span>
		<div id="text2" style="display: none;">	
		this was a project from undergraduate which "put some hair on my chest" so to speak.
		the idea was to code up a phase vocoder for time compression expansion in Matlab for 
		my final project in Music and DSP.  My first couple attempts were completely flawed
		and resulted in a wonderful IC on my transcript for the fall semester.  Well months 
		later I got it up and running.  More work to come but as of now it works pretty well.

		so, I make the signal mono for the sake of simplicity:
		<pre class="brush: matlab; title: Code;">
			%make the signal mono
			x=x(:,1);
		</pre>

		After scanning the parameters for inaccuracies on the part of the user I find the 
		length of the input single and create a hanning window the length of the window.
		<pre class="brush: matlab; title: Code;">
			sigLen=length(x);        % length of input signal (Column)
			hW= hanning(wL);         % hanning window the length of parameter wL						
		</pre>

		where the legnth of the window is a power of two:
		<pre class="brush: matlab; title: Code;">
			%check wL to be power of two, if not find and adjust
			if(wL==2^nextpow2(wL))
		    	wL=wL;
			else 
		    	wL=2^nextpow2(wL);
			end
		</pre>

		I establish the analysis and synthesis parameters along with some variables 
		to take care of potential situations:
		<pre class="brush: matlab; title: Code;">
			hIa=floor((1-h)*wL); %hop in analysis
			hOs=floor(tCe*hIa);  %hop out synthesis 
			PL= (sigLen*tCe)+wL; %potential length of signal
			z = zeros(wL+ceil(PL),1); %allocation of space given potential length of signal                       
		</pre>

		on the the loop, I do all of the processing in one while loop as I move through the 
		entire signal.  First is the windowing:

		<pre class="brush: matlab; title: Code;">
			win = x(l+1:l+wL).*hW; %window, each element multiplied 
		                    	   %by hanning window equivalent
			ft=fft(win);  		   %amplitude  
			ft=abs(ft);		       %magnitude
			Phas=tCe*angle(ft);    %phase
		</pre>

		then the encoding: 

		<pre class="brush: matlab; title: Code;">
			ft = ft.*exp(1i*Phas); 
		</pre>

		then the decoding: 
		<pre class="brush: matlab; title: Code;">
			xNew  = real(ifft(ft)).*hW; 
		</pre>
		
		followed by the resynthesis with hOS and updating of parameters:
		<pre class="brush: matlab; title: Code;">
			z(r+1:r+wL) = z(r+1:r+wL)+xNew; %resythesize with hOs paraemter

			l = l+hIa; %update hIa parameter
			r = r+hOs; %update hOs parameter
		</pre>

		</div>
 </div>	
</div>

<div id="post3">		
<div class="post_title">				
			<h2>
				<a href="https://github.com/batmanbeyond/HTMLparser">	an html validator</a>
			</h2>
		<span id="tick3" class="clickit" onclick="ExpandCollapse(this.id);">{...}</span>
		<span id="act3"></span>
		<div id="text3" style="display: none;">	
		this was a little project I worked on while coding a website for a client in SF. 
		It proved handy to have a little console application to check the for syntax 
		errors in my HTML.  

		First I grab all the source from the URL I am working on: 

		<pre class="brush: java; title: Code;">
			InputStreamReader pageInput = new InputStreamReader(url.openStream());
	
			BufferedReader source = new BufferedReader(pageInput);
	
			String sourceLine;
			String html= null;
		</pre>

		Then I read the lines of source into a single string: 
		<pre class="brush: java; title: Code;">
			while ((sourceLine = source.readLine()) != null) 
		    	{
					html += sourceLine + "\t";
		    	}
		</pre>

		After stripping out any embedded css and js I use a simple regex to capture the carrots
		in the code and check to see that they match accordingly:

		<pre class="brush: java; title: Code;">
			html = html.replaceAll("\\s",""); //removes all whitespaces  //NOT WORKING
			int htmlLength = html.length();
	
			Pattern content = Pattern.compile("(<|>).*?(<|>)");
			Matcher mcontent = content.matcher(html);
			Boolean flag = true;
	
			Stack&lt;String&gt stack = new Stack&lt;String&gt();

		</pre>

		I then push all the values pairs onto the stack and check for validity: 

		<pre class="brush: java; title: Code;">
			if(val.toString() == ">>" || val.toString() == "<<" || val.toString() == "><")
			{
				System.out.println("The HTML is not syntactially correct");
				flag = false;
			}

		</pre>
		</div>
 </div>	
</div>



<div id="post4">
<div class="post_title">				
	<h2>
		<a href="">	shell script to show hidden files in OSx </a>
	</h2>
		<span id="tick4" class="clickit" onclick="ExpandCollapse(this.id);">{...}</span>
		<span id="act4"></span>
		<div id="text4" style="display: none;">
		this is a bit of reblogging from a long time ago, but this was a highly useful
		shell script I ran into a while back.  If you implement it with automator in 
		OSx it will come in handy all the time:

		<pre class="brush: java; title: Code;">
			defaults write com.apple.finder AppleShowAllFiles TRUE
			killall Finder
		</pre>

		if you change TRUE to FALSE you can implement the program which reverts us to 
		no seeing any hidden files.
		</div>
 </div>	
</div>

</div> <!--End of id = group -->	
</body>
