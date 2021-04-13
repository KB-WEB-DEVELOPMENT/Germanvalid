1.INTRODUCTION
----------------
Germanvalid - A php tool to check the validity of any: 

(A) geographically based landline phone numbers in Germany (entered with or without the geographical zone number)

(B) non geographically based landline phone numbers in Germany

(C) private mobile operators mobile phone numbers in Germany

(D) emergency and services based phone numbers in Germany 

To understand the regulation of telephone numbers in Germany under the responsability of 
the Federal Network Agency (German: Bundesnetzagentur, BNetzA - run by the German government)
for (A), (B), (C) and (D), take a careful look at:

https://en.wikipedia.org/wiki/Telephone_numbers_in_Germany

2.INSTALLATION
----------------

in your project root folder: git clone https://github.com/KB-WEB-DEVELOPMENT/Germanvalid.git projectname

3.USAGE
---------

Note that the string input can be entered with empty spaces, parentheses, dashes, dots, etc ... all
non-digits characters are removed before the validity of the phone number is evaluated.

3.1) validate_geo_number(STRING $input)
-----------------------------------------

    <?php	
         	// in file: projectname/index.php
		
		require_once __DIR__ . '/vendor/autoload.php';
		use KB-WEB-DEVELOPMENT\Germanvalid;

		$validator =  new Germanvalid();

		echo $validator->validate_geo_number("08992396655") // output: 1 (TRUE)

		echo "<br/>";

		echo $validator->validate_geo_number("8992396655") // output: 0 (FALSE)
    ?>

3.2) validate_non_geo(STRING $input)
-------------------------------------

	<?php
		       
         	// in file: projectname/index.php
		
		require_once __DIR__ . '/vendor/autoload.php';
		use KB-WEB-DEVELOPMENT\Germanvalid;

		echo $validator->validate_non_geo("01371234567894"); // output: 1 (TRUE)

		echo "<br/>";

		echo $validator->validate_non_geo("0137123456789");  // output: 0 (FALSE)
	?>

3.3) validate_mobile_operator(STRING  $input)
----------------------------------------------

	<?php
		
         	// in file: projectname/index.php
		
		require_once __DIR__ . '/vendor/autoload.php';
		use KB-WEB-DEVELOPMENT\Germanvalid;

		$validator =  new Germanvalid();

		echo $validator->validate_mobile_operator("015203917799") // output: 1 (TRUE)

		echo "<br/>";

		echo $validator->validate_mobile_operator("15203917799") // output: 0 (FALSE)
	?>

3.4) validate_emergency(STRING $input)
---------------------------------------

	<?php
		
         	// in file: projectname/index.php
		
		require_once __DIR__ . '/vendor/autoload.php';
		use KB-WEB-DEVELOPMENT\Germanvalid;

		$validator =  new Germanvalid();

		echo $validator->validate_emergency("11800"); // output: 1 (TRUE)

		echo "<br/>";

		echo $validator->validate_emergency("118000"); // output: 0 (FALSE)
	?>
	
3.5 ) printPhoneNumberType(STRING $input)
-------------------------------------------

        <?php
			
         	// in file: projectname/index.php
		
		require_once __DIR__ . '/vendor/autoload.php';
		use KB-WEB-DEVELOPMENT\Germanvalid;

		$validator =  new Germanvalid();

		$validator->printPhoneNumberType("(089)-92396645"); //output: "Valid German landline phone number format including the geographic zone"

		echo "<br/>";
	
		$validator->printPhoneNumberType("(0152)-03917795"); //output: "Valid German commercial mobile phone number format"
	
		echo "<br/>";
	
		$validator->printPhoneNumberType("#19#222"); //output: "Valid German emergency/government service phone number format"
	
		echo "<br/>";
	
		$validator->printPhoneNumberType("0137-1234567894"); //output: "Valid German landline phone number format excluding the geographic zone"
	
		echo "<br/>";
	
		$validator->printPhoneNumberType("(151)-03917795"); //output: "Unknown German phone number format"
	
	?>
