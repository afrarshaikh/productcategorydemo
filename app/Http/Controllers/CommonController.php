<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getTestResult(Request $request)
    {
         //First Question Solution
            $array = ['Google',"Apple","Microsoft"];
            echo "First Question Array : <br>";
            echo "<pre>"; print_r($array);
            $resulted_array = $this->sortByLength($array);
            echo "First Question Result : <br>";
            echo "<pre>"; print_r($resulted_array);

            $resulted_array = $this->sortByLengthLargerToSmaller($array);
            echo "First Question Larger to smaller Result : <br>";
            echo "<pre>"; print_r($resulted_array);


         //Second Question Solution
            $array = [2, 7, 4, 9, 6, 1, 6, 3];//valid values
            echo "Second Question Valid Array : <br>";
            echo "<pre>"; print_r($array);
            $resulted_data = $this->isSpecialArray($array);
            echo "Second Question With Valid Data Result: $resulted_data <br>";
         

            $array = [2, 7, 9, 1, 6, 1, 6, 3];//Invalid values
            echo "Second Question Invalid Array : <br>";
            echo "<pre>"; print_r($array);
            $resulted_data = $this->isSpecialArray($array);
            echo "Second Question With Invalid Data Result: $resulted_data <br>";

            $array = [2, 7, 8, 8, 6, 1, 6, 3];//Invalid values
            echo "Second Question Invalid Array : <br>";
            echo "<pre>"; print_r($array);
            $resulted_data = $this->isSpecialArray($array);
            echo "Second Question With Invalid Data Result: $resulted_data <br>";
    }
    public function sortByLengthLargerToSmaller($array){
        // usort($array, function($a, $b){
        //     return strlen($a) < strlen($b);
        // });
        // return $array;
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if (strlen($array[$i]) < strlen($array[$j])) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }
    public function sortByLength($array){
        // usort($array, function($a, $b){
        //     return strlen($a) > strlen($b);
        // });
        // return $array;
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if (strlen($array[$i]) > strlen($array[$j])) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }
    public function isSpecialArray($array){
        $is_special = true;
        if(sizeof($array)>0){
            foreach($array as $key =>$value){
                if($key % 2 == 0 ){
                    $is_even = $this->compareEvenValue($key,$value);
                    if(!$is_even){
                        $is_special = false;
                        break;
                    }
                }else{
                    $is_odd = $this->compareOddValue($key,$value);
                    if(!$is_odd){
                        $is_special = false;  
                        break;
                    }
                }
            }
        }
        return $is_special;
    }
    public function compareOddValue($key,$value){
        $is_odd = false;
        if($key % 2 != 0 && $value % 2 != 0){
            $is_odd = true;
        }
        return $is_odd;
    }
    public function compareEvenValue($key,$value){
        $is_even = false;
        if($key % 2 == 0 && $value % 2 == 0){
            $is_even = true;
        }
        return $is_even;
    }
    /**
     * Returns  categories lists in this order
     * Decouple it with list().
     *
     * @return array
     */
    protected function commonDropdown($action)
    {
        $categories = Category::all();
        return [$categories->pluck('name', 'id')->prepend('Select','')];
    }
}
