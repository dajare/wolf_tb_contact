== ABOUT

TB_Contactform
http://labs.thinkbright.nl/tb_contactform/

A semantic and usable contact form for Frog CMS
by Marijn Scholtus (http://thinkbright.nl)

Updated for Wolf CMS
by David Reimer (http://adajer.byethost5.com)

This is a straight forward and semantic contact form with usability in mind.
It provides a standard contact form with name / email / subject / message fields.
It will check and validate all field input and return errors while keeping
the user's input untouched.

It also includes an non-obtrusive way of combatting spambots.

== HOW TO INSTALL

1.	Unzip the file and move the tb_contactform folder to your /frog/plugins/ directory.
	Make sure that the folder on the server is called "tb_contactform" and rename it if
	it's not.
	
2.	Go to the Administration > Plugins tab in your Frog CMS Admin, and enable the plugin.

3.	Insert the following code where you want your contact form to appear:

	<?php TB_Contactform('youremail@yourdomain.com'); ?>
	
	(Replace the example email address in the code sample above with your actual email address)
	
4.	Add to following basic CSS to your CSS file (or style the form yourself):

	.tbContactform .antispam {
		display:  none;
		visibility: hidden;
	}

	.tbContactform label {
		width:  95px;
		display:  inline-block;
		vertical-align: top;
		clear: both;
	}

	.tbContactform input.text,
	.tbContactform textarea {
		width:  225px;
		padding: 2px;
	}

	.tbContactform textarea {
		height:  115px;
	}

	.tbContactform input.submit {
		display: block;
      	margin-left: 250px;
      	width:  auto;
	}

	.tbContactform .tbErrors p {
		color: #FF0000;
	}

5.	Done! You can edit the index.php file to finetune the form to your likings.

== EXTRA SETTINGS

The TB_Contactform function takes four variables:

	<?php TB_Contactform('youremail@yourdomain.com', 'ccemail@yourdomain.com', 'Success message heading', 'Success message body'); ?>

- Email address the form is sent to (mandatory)
- CC email address (optional, default: FALSE)
- Success message heading (optional, default: Your message was sent successfully)
- Success message body (optional, default: Please allow up to three days for a reply.)

Only the first variable is mandatory. Leave any of the other variables blank to keep the defaults. For example, to override the default success message without sending a CC use the following code:

	<?php TB_Contactform('youremail@yourdomain.com', '', 'Success message heading', 'Success message body'); ?>
	
== CHANGELOG

Wolf:
1.0.3	4 January 2011		Lightly modified to work natively in Wolf CMS.

Frog:
1.0.2	21 December 2009	Fixed a syntax error in the makeSafe function.
							Thanks Stefan Probst!
1.0.1	3 September 2009	Fixed a bug in the makeSafe function with the handling some special characters.
							Thanks to Konstantin Baev for notifying me of the bug.
1.0		29 April 2009		Initial stable release.

== LICENSE

TB_Contactform is licensed under a Creative Commons Attribution-Share Alike 3.0 Netherlands License:
	http://creativecommons.org/licenses/by-sa/3.0/nl/deed.en

Please attribute the original author and keep a link to http://labs.thinkbright.nl/tb_contactform/ when redistributing this plugin in any way.
