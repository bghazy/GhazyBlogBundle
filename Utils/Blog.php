<?php 
namespace Ghazy\BlogBundle\Utils;
class Blog
{
	const limit = 100;
    static public function slugify($text)
    {
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);
 
        // trim and lowercase
        $text = strtolower(trim($text, '-'));
 
        return $text;
    }
    
    static public function truncate($string, $limit, $break=".", $pad="...")
	{
	  // return with no change if string is shorter than $limit
	  if(strlen($string) <= $limit) return $string;
	
	  // is $break present between $limit and the end of the string?
	  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
	    if($breakpoint < strlen($string) - 1) {
	      $string = substr($string, 0, $breakpoint) . $pad;
	    }
	  }
	
	  return $string;
	}
    
}