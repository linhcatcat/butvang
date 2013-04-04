<?php
/*
 * @author Alex (LinhTran)
 * @Date : 02/04/2013
 */

namespace Butvang\BvBundle\Extension;

class BvExtension extends \Twig_Extension
{
	
    public function __construct(){
    }

    public function getName(){
        return 'bv_extension';
    }

    public function getFunctions(){
        return array(
        	'bv_test'	=> new \Twig_Function_Method($this, 'bvTest'),
            'bv_price' => new \Twig_Function_Method($this, 'priceFilter'),            
        );
	}

    public function getFilters()
    {
        return array(
            'bv_filter' => new \Twig_Filter_Method($this, 'bvPriceFilter'),
            'bv_filter1' => new \Twig_Filter_Method($this, 'bvPriceFilter1'),
        );
    }

    public function bvTest($a, $b){
        return $a + $b;
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;
        return $price;
    }

    public function bvPriceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;
        return $price;
    }

    public function bvPriceFilter1($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;
        return $price;
    }
}