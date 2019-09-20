<?php

	 /**
	 *   Germanvalid - A php tool to check if a user submitted input matches any of a: (1) geographic ,(2) non-geographic, 
	 *   (3) mobile operators or (4) emergency and services PHONE NUMBERS IN GERMANY.
	 *
	 *  The contents of this file are subject to the terms of the GNU General
	 *  Public License Version 3.0. You may not use this file except in
	 *  compliance with the license. Any of the license terms and conditions
	 *  can be waived if you get permission from the copyright holder.
	 *	 *
	 *  Copyright (c) 2017 by KB DESIGN
	 *  Kami Barut-Wanayo <kamibarut@yahoo.com>
	 *  https://github.com/KB-WEB-DEVELOPMENT/
	 *
	 *  @package Germanvalid
	 *  @version 1.0.1-dev
	 *  @date  03.06.2017
	 *  @since 03.06.2017
	 */

	class Germanvalid {
		
		const MOBILE_EXCEPTION_1 = "0176";
		const MOBILE_EXCEPTION_2 = "01609";
			
			 /**
			 * returns whether the entered input is a valid assignable German geographic phone number 
			 *[Government run and controlled]
			 * @param string
			 * @return bool
			 */

			public function validate_geo_number($input) {
		
				// removes all non digits
				$input = preg_replace('~\D~','', $input);
			
				$length = strlen($input);
				
				// say length < 11 or length > 12, incorrect mobile number - needed for the switch statement 
				$geographic_zone_number = "00";

				// user included a geographic zone number, 11 digits total
				if ($length == 11)  {
					
					$geographic_zone_number = substr($input,0,2);
				}
				
				// user included a geographic zone number, 12 digits total
				if ($length == 12)  {
		
					$geographic_zone_number = substr($input,0,2);
				}
								
				switch($geographic_zone_number) {												
				
					case '02':
						$regex = '/^02[0-9]{9,10}$/';
						break;

					case '03':
						$regex = '/^03[0-9]{9,10}$/';
						break;	

					case '04':
						$regex = '/^04[0-9]{9,10}$/';
						break;
						
					case '05':
						$regex = '/^05[0-9]{9,10}$/';
						break;
						
					case '06':
						$regex = '/^06[0-9]{9,10}$/';
						break;
						
					case '07':
						$regex = '/^07[0-9]{9,10}$/';
						break;				

					case '08':
						$regex = '/^08[0-9]{9,10}$/';
						break;
						
					case '09':
						$regex = '/^09[0-9]{9,10}$/';
						break;					
					
					default:
						$regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($regex, $input) == 1) {
					$result = true;    
				} else {    
					$result = false;    
				  }	
				  
				// exclude all numbers with more than 12 digits
				if ($length > 12) {
					
					$result = false;
				}
				
				// exclude all numbers with less than 6 digits
				if ($length < 6) {
					
					$result = false;
				}
				
				// any 6 digits is correct, i.e: user entered the number without the geographic zone number
				if ($length == 6) {
					
					$result = true;
				
				} 
				// any 7 digits is correct, i.e: user entered the number without the geographic zone number
				if ($length == 7) {
					
					$result = true;
				
				} 
							  
				// any 8 digits is correct, i.e: user entered the number without the geographic zone number
				if ($length == 8) {
					
					$result = true;
							
				} 
				// the user entered 9 digits, too few with the geographic zone number, too many without.
				if ($length == 9) {
					
					$result = false;
				
				} 
				// the user entered 10 digits, too few with the geographic zone number, too many without.
				if ($length == 10) {
					
					$result = false;
					
				}
							
				return $result;
			
			}
		
			 /**
			 * returns whether the entered input is a valid assignable German non-geographic mobile phone number 
			 * tied to a registered mobile operator in Germany
			 * @param string
			 * @return bool
			 */

			public function validate_mobile_operator($input) {

				// removes all non digits
				$input = preg_replace('~\D~','', $input);
			
				$length = strlen($input);

				if ($length < 4)  {
		
					$firstFourDigits = "0000"; // wrong first four digits, used in switch statement below 
				} 
				
				if ($length == 4)  {
					
					$firstFourDigits = substr($input,0,4);
				
				}
				
				if ($length > 4)  {
					
					$firstFourDigits = substr($input,0,4);
				
				}
				
				switch($firstFourDigits) {				
					case '0150':
						$regex = '/^0150[0-9]{7,8}$/';
						break;
					case '0151':
						$regex = '/^0151[0-9]{7,8}$/';
						break;				
					case '0152':
						$regex = '/^0152[0-9]{7,8}$/';
						break;			
					case '0155':
						$regex = '/^0155[0-9]{7,8}$/';
						break;			
					case '0157':
						$regex = '/^0157[0-9]{7,8}$/';
						break;		
					case '0159':
						$regex = '/^0159[0-9]{7,8}$/';
						break;
					case '0160':
						$regex = '/^0160[0-9]{7,8}$/';
						break;					
					case '0161':
						$regex = '/^0161[0-9]{7,8}$/';
						break;		
					case '0162':
						$regex = '/^0162[0-9]{7,8}$/';
						break;		
					case '0163':
						$regex = '/^0163[0-9]{7,8}$/';
						break;
					case '0164':
						$regex = '/^0164[0-9]{7,8}$/';
						break;
					case '0168':
						$regex = '/^0168[0-9]{7,8}$/';
						break;
					case '0169':
						$regex = '/^0169[0-9]{7,8}$/';
						break;
					case '0170':
						$regex = '/^0170[0-9]{7,8}$/';
						break;
					case '0171':
						$regex = '/^0171[0-9]{7,8}$/';
						break;
					case '0172':
						$regex = '/^0172[0-9]{7,8}$/';
						break;					
					case '0173':
						$regex = '/^0173[0-9]{7,8}$/';
						break;					
					case '0174':
						$regex = '/^0174[0-9]{7,8}$/';
						break;					
					case '0175':
						$regex = '/^0175[0-9]{7,8}$/';
						break;					
					case '0177':
						$regex = '/^0177[0-9]{7,8}$/';
						break;					
					case '0178':
						$regex = '/^0178[0-9]{7,8}$/';
						break;					
					case '0179':
						$regex = '/^0179[0-9]{7,8}$/';
						break;
					default:
						$regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($regex, $input) == 1) {
					$result = true;    
				} else {    
					$result = false;    
				  }
				
				// checking for exceptions - mandatory 12 digits for 0176 - xxx - xxxxx and for 01609 - xxx - xxxx
				if ($length == 11) {
					
					$firstFourDigitsEntered = substr($input,0,4);
					$firstFiveDigitsEntered = substr($input,0,5);
				}	
			
				if ($firstFourDigitsEntered == MOBILE_EXCEPTION_1) {

					$result = false;
				}
				
				if ($firstFiveDigitsEntered == MOBILE_EXCEPTION_2) {

					$result = false;
				}
				
				return $result;
			}

			 /**
			 * returns whether the entered input is a valid German emergency and network services number [Government run and controlled]
			 * @param string
			 * @return bool
			 */
		
			public function validate_emergency($input)	{
							
				$fixed_numbers =array("110","112","115","19222");
				$regex1 = '/^116[0-9]{3}$/';
				$regex2 = '/^118[0-9]{2}$/';
				
				$input = preg_replace('~\D~','',$input);
				
				if (in_array($input, $fixed_numbers)) {
					
					$result = true;
					
				} elseif (preg_match($regex1, $input) == 1) {
					
					$result = true;
				
				} elseif (preg_match($regex2, $input) == 1) {
					
					$result = true;
				
				} else {
					
					$result = false;
				}
				
				return $result;
				
			}
			
			 /**
			 * returns whether the entered input is a valid German non-geographic phone number [Government run and controlled]
			 * @param string
			 * @return bool
			 */
			
			public function validate_non_geo($input) {

				// fixed set length correct numbers 
				$fixed_4_digits_numbers =array("0191","0192","0193","0194");
				$fixed_5_char_numbers ="010xy";
				$fixed_6_char_numbers ="0100yy";
			
				// removes all non digits
				$input = preg_replace('~\D~','', $input);
			
				$length = strlen($input);
									
				if ($length < 3)  {
		
					$firstThreeDigits = "000"; // incorrect first three digits, used in switch statement
				} 
					
				$firstThreeDigits = substr($input,0,3);
				
				switch($firstThreeDigits) {												
					case '011':
						$regex = '/^011[0-9]{1,9}$/';
						break;
					case '012':
						$regex = '/^012[0-9]{9,}$/';
						break;
					case '013':
						$regex = '/^013(?=7)[0-9]{10}|(?=8)1[0-9]{1,}$/';
						break;
					case '018':
						$regex = '/^018(?=0)[0-9]{7}|[1-9]{1,}$/';
						break;
					case '019':
						$regex = '/^019(?=8)[0-9]{1,}|(?=9)[0-9]{1,}|[0-9]{3}$/';
						break;
					case '031':
						$regex = '/^031[0-9]{1}$/';
						break
					case '032':
						$regex = '/^032[0-9]{9}$/';
						break;
					case '070':
						$regex = '/^0700[0-9]{8}$/';
						break;
					case '080':
						$regex = '/^0800[0-9]{7}$/';
						break;
					case '090':
						$regex = '/^09000(?=9)[0-9]{7}|[0-9]{7}$/';
						break;
					default:
						$regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($regex, $input) == 1) {
					
					$result = true;    
				
				} else {    
				
				$result = false;    

				}
							
				if (in_array($input, $fixed_4_digits_numbers)) {
					
					$result = true;
				
				} 
				
				if ($input == $fixed_5_char_numbers) {
					
					$result = true;
				
				} 
				
				if ($input == $fixed_6_char_numbers) {
					
					$result = true;
				
				} 
				
				return $result;
				  
			}
		
	/**
	* prints the category to which the phone number entered belongs to in Germany.
	* @param string
	* @return string
	*/

	public function printPhoneNumberType($input)	{

		// removes all non digits
		$input = preg_replace('~\D~','', $input);

		if ($this->validate_geo_number($input) == true) {
	
			$message = "Valid German geographically based phone number format";
	
		} elseif ($this->validate_mobile_operator($input) == true) {
				
			$message = "Valid German commercial mobile phone number format";
			
		  } elseif ($this->validate_emergency($input) == true) {
				
			$message = "Valid German emergency/government service phone number format";
			
		   } elseif ($this->validate_non_geo($input) == true) {
					
			$message = "Valid German non-geographically based phone number format";
	
		   } else {
		
			$message = "Unknown German phone number format";
		     }
		
		echo $message;
		
	 }
		
	
    }

?>
