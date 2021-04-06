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
		
		const GEOGRAPHIC_ZONE_NUMBER = "00";
		
		const FIRST_FOUR_DIGITS = "0000";
		
		const FIXED_NUMBERS = array("110","112","115","19222");
		
		const REGEX1 = '/^116[0-9]{3}$/';
		
		const REGEX2 = '/^118[0-9]{2}$/';
		
		const FIXED_FOUR_DIGITS_NUMBERS = array("0191","0192","0193","0194");
		const FIXED_FIVE_CHAR_NUMBERS = "010xy";
		const FIXED_SIX_CHAR_NUMBERS = "0100yy";
		
		const FIRST_THREE_DIGITS = "000";
		
		protected $input = "";
		protected $length = 0;
		
		protected $geographic_zone_number = "";

		protected $firstThreeDigits = "";
		protected $firstFourDigits = "";
		
		protected $firstFourDigitsEntered = "";
		protected $firstFiveDigitsEntered = "";
		
		protected $fixed_4_digits_numbers = "";
		protected $fixed_5_char_numbers = "";
		protected $fixed_6_char_numbers = "";
		
		protected $regex = "";
		
		protected $result = false;
			
		protected $message = "";
			
				
			 /**
			 * returns whether the entered input is a valid assignable German geographic phone number 
			 *[Government run and controlled]
			 * @param string
			 * @return bool
			 */

			public function validate_geo_number($input) {
				
				$input = trim($input);
    
				if (isset($input) === true && $input === '') {
    
				  die("You cannot enter an empty string. Your string must contain at least one character."); 
  
 				}
		
				// removes all non digits
				$this->input = preg_replace('~\D~','', $input);
			
				$this->length = (int)strlen($this->input);
				
				// say length < 11 or length > 12, incorrect mobile number - needed for the switch statement 
				$this->geographic_zone_number = self::GEOGRAPHIC_ZONE_NUMBER;

				// user included a geographic zone number, 11 digits total
				if ($this->length == 11)  {
					
					$this->geographic_zone_number = substr($this->input,0,2);
				}
				
				// user included a geographic zone number, 12 digits total
				if ($this->length == 12)  {
		
					$this->geographic_zone_number = substr($this->input,0,2);
				}
								
				switch($this->geographic_zone_number) {												
				
					case '02':
						$this->regex = '/^02[0-9]{9,10}$/';
						break;

					case '03':
						$this->regex = '/^03[0-9]{9,10}$/';
						break;	

					case '04':
						$this->regex = '/^04[0-9]{9,10}$/';
						break;
						
					case '05':
						$this->regex = '/^05[0-9]{9,10}$/';
						break;
						
					case '06':
						$this->regex = '/^06[0-9]{9,10}$/';
						break;
						
					case '07':
						$this->regex = '/^07[0-9]{9,10}$/';
						break;				

					case '08':
						$this->regex = '/^08[0-9]{9,10}$/';
						break;
						
					case '09':
						$this->regex = '/^09[0-9]{9,10}$/';
						break;					
					
					default:
						$this->regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($this->regex, $this->input) == 1) {
					$this->result = true;    
				} else {    
					$this->result = false;    
				  }	
				  
				// exclude all numbers with more than 12 digits
				if ($this->length > 12) {
					
					$this->result = false;
				}
				
				// exclude all numbers with less than 6 digits
				if ($this->length < 6) {
					
					$this->result = false;
				}
				
				// any 6 digits is correct, i.e: user entered the number without the geographic zone number
				if ($this->length == 6) {
					
					$this->result = true;
				
				} 
				// any 7 digits is correct, i.e: user entered the number without the geographic zone number
				if ($this->length == 7) {
					
					$this->result = true;
				
				} 
							  
				// any 8 digits is correct, i.e: user entered the number without the geographic zone number
				if ($this->length == 8) {
					
					$this->result = true;
							
				} 
				// the user entered 9 digits, too few with the geographic zone number, too many without.
				if ($thi->length == 9) {
					
					$this->result = false;
				
				} 
				// the user entered 10 digits, too few with the geographic zone number, too many without.
				if ($this->length == 10) {
					
					$this->result = false;
					
				}
							
				return $this->result;
			
			}
		
			 /**
			 * returns whether the entered input is a valid assignable German non-geographic mobile phone number 
			 * tied to a registered mobile operator in Germany
			 * @param string
			 * @return bool
			 */

			public function validate_mobile_operator($input) {
				
				$input = trim($input);
    
				if (isset($input) === true && $input === '') {
    
			          die("You cannot enter an empty string. Your string must contain at least one character."); 
 				}

				// removes all non digits
				$this->input = preg_replace('~\D~','', $input);
			
				$this->length = (int)strlen($this->input);

				if ($this->length < 4)  {
		
					$this->firstFourDigits = self::FIRST_FOUR_DIGITS; // wrong first four digits, used in switch statement below 
				} 
				
				if ($this->length == 4)  {
					
					$this->firstFourDigits = substr($this->input,0,4);
				
				}
				
				if ($this->length > 4)  {
					
					$this->firstFourDigits = substr($this->input,0,4);
				
				}
				
				switch($this->firstFourDigits) {				
					case '0150':
						$this->regex = '/^0150[0-9]{7,8}$/';
						break;
					case '0151':
						$this->regex = '/^0151[0-9]{7,8}$/';
						break;				
					case '0152':
						$this->regex = '/^0152[0-9]{7,8}$/';
						break;			
					case '0155':
						$this->regex = '/^0155[0-9]{7,8}$/';
						break;			
					case '0157':
						$this->regex = '/^0157[0-9]{7,8}$/';
						break;		
					case '0159':
						$this->regex = '/^0159[0-9]{7,8}$/';
						break;
					case '0160':
						$this->regex = '/^0160[0-9]{7,8}$/';
						break;					
					case '0161':
						$this->regex = '/^0161[0-9]{7,8}$/';
						break;		
					case '0162':
						$this->regex = '/^0162[0-9]{7,8}$/';
						break;		
					case '0163':
						$this->regex = '/^0163[0-9]{7,8}$/';
						break;
					case '0164':
						$this->regex = '/^0164[0-9]{7,8}$/';
						break;
					case '0168':
						$this->regex = '/^0168[0-9]{7,8}$/';
						break;
					case '0169':
						$this->regex = '/^0169[0-9]{7,8}$/';
						break;
					case '0170':
						$this->regex = '/^0170[0-9]{7,8}$/';
						break;
					case '0171':
						$this->regex = '/^0171[0-9]{7,8}$/';
						break;
					case '0172':
						$this->regex = '/^0172[0-9]{7,8}$/';
						break;					
					case '0173':
						$this->regex = '/^0173[0-9]{7,8}$/';
						break;					
					case '0174':
						$this->regex = '/^0174[0-9]{7,8}$/';
						break;					
					case '0175':
						$this->regex = '/^0175[0-9]{7,8}$/';
						break;					
					case '0177':
						$this->regex = '/^0177[0-9]{7,8}$/';
						break;					
					case '0178':
						$this->regex = '/^0178[0-9]{7,8}$/';
						break;					
					case '0179':
						$this->regex = '/^0179[0-9]{7,8}$/';
						break;
					default:
						$this->regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($this->regex, $this->input) == 1) {
					$this->result = true;    
				} else {    
					$this->result = false;    
				  }
				
				// checking for exceptions - mandatory 12 digits for 0176 - xxx - xxxxx and for 01609 - xxx - xxxx
				if ($this->length == 11) {
					
					$this->firstFourDigitsEntered = substr($this->input,0,4);
					$this->firstFiveDigitsEntered = substr($this->input,0,5);
				}	
			
				if ($this->length == 11 && $this->firstFourDigitsEntered === self::MOBILE_EXCEPTION_1) {

					$this->result = false;
				}
				
				if ($this->length == 11 && $this->firstFiveDigitsEntered === self::MOBILE_EXCEPTION_2) {

					$this->result = false;
				}
				
				return $this->result;
			}

			 /**
			 * returns whether the entered input is a valid German emergency and network services number [Government run and controlled]
			 * @param string
			 * @return bool
			 */
		
			public function validate_emergency($input)	{
				
				$input = trim($input);
    
				if (isset($input) === true && $input === '') {
    
				  die("You cannot enter an empty string. Your string must contain at least one character."); 
 				}
											
				$this->input = preg_replace('~\D~','',$input);
				
				if (in_array($this->input, self::FIXED_NUMBERS)) {
					
					$this->result = true;
					
				} elseif (preg_match(self::REGEX1, $this->input) == 1) {
					
					$this->result = true;
				
				} elseif (preg_match(self::REGEX2, $this->input) == 1) {
					
					$this->result = true;
				
				} else {
					
					$this->result = false;
				}
				
				return $this->result;
				
			}
			
			 /**
			 * returns whether the entered input is a valid German non-geographic phone number [Government run and controlled]
			 * @param string
			 * @return bool
			 */
			
			public function validate_non_geo($input) {
				
				$input = trim($input);
    
				if (isset($input) === true && $input === '') {
    
				  die("You cannot enter an empty string. Your string must contain at least one character."); 
  
 				}
			
				// removes all non digits
				$this->input = preg_replace('~\D~','', $input);
			
				$this->length = (int)strlen($this->input);
									
				if ($this->length < 3)  {
		
					$this->firstThreeDigits = self::FIRST_THREE_DIGITS; // incorrect first three digits, used in switch statement
				} 
					
				$this->firstThreeDigits = substr($this->input,0,3);
				
				switch($this->firstThreeDigits) {												
					case '011':
						$this->regex = '/^011[0-9]{1,9}$/';
						break;
					case '012':
						$this->regex = '/^012[0-9]{9,}$/';
						break;
					case '013':
						$this->regex = '/^013(?=7)[0-9]{10}|(?=8)1[0-9]{1,}$/';
						break;
					case '018':
						$this->regex = '/^018(?=0)[0-9]{7}|[1-9]{1,}$/';
						break;
					case '019':
						$this->regex = '/^019(?=8)[0-9]{1,}|(?=9)[0-9]{1,}|[0-9]{3}$/';
						break;
					case '031':
						$this->regex = '/^031[0-9]{1}$/';
						break
					case '032':
						$this->regex = '/^032[0-9]{9}$/';
						break;
					case '070':
						$this->regex = '/^0700[0-9]{8}$/';
						break;
					case '080':
						$this->regex = '/^0800[0-9]{7}$/';
						break;
					case '090':
						$this->regex = '/^09000(?=9)[0-9]{7}|[0-9]{7}$/';
						break;
					default:
						$this->regex = '/^alwayswrong!!!!$/';
						break;						
				}
				
				if (preg_match($this->regex, $this->input) == 1) {
					
					$this->result = true;    
				
				} else {    
				
				$this->result = false;    

				}
							
				if (in_array($this->input, self::FIXED_FOUR_DIGITS_NUMBERS)) {
					
					$this->result = true;
				
				} 
				
				if ($this->input === self::FIXED_FIVE_CHAR_NUMBERS) {
					
					$this->result = true;
				
				} 
				
				if ($this->input === self::FIXED_SIX_CHAR_NUMBERS) {
					
					$this->result = true;
				
				} 
				
				return $this->result;
				  
			}
		
	/**
	* prints the category to which the phone number entered belongs to in Germany.
	* @param string
	* @return string
	*/

	public function printPhoneNumberType($input)	{
		
		$input = trim($input);
    
		if (isset($input) === true && $input === '') {
    
	           die("You cannot enter an empty string. Your string must contain at least one character."); 
 		}

		// removes all non digits
		$this->input = preg_replace('~\D~','', $input);

		if ($this->validate_geo_number($this->input) == true) {
	
			$this->message = "Valid German geographically based phone number format";
	
		} elseif ($this->validate_mobile_operator($this->input) == true) {
				
			$this->message = "Valid German commercial mobile phone number format";
			
		  } elseif ($this->validate_emergency($this->input) == true) {
				
			$this->message = "Valid German emergency/government service phone number format";
			
		   } elseif ($this->validate_non_geo($this->input) == true) {
					
			$this->message = "Valid German non-geographically based phone number format";
	
		   } else {
		
			$this->message = "Unknown German phone number format";
		     
			}
		
		echo $this->message;
		
	 }
		
	
    }

?>
