<?php 
class Predict {
    private $nums = array();
    private $rawPattern = array();

    function __construct($nums) {
        $this->nums = $nums;
        $this->createPattern();
    }

    private function patternPart($num) {
        if($num >= 0) {
            $patternPart = "+{$num}";
        } else {
            $patternPart = "{$num}";
        }

        return $patternPart;
    }

    private function createPattern() {
        foreach($this->nums as $key => $num) {
            if($key > 0) {
                $prev = $this->nums[$key - 1];
                $diff = $num - $prev;

                $this->rawPattern[] = $this->patternPart($diff);
            }
        }
    }

    function getPattern($del = ' ') {
        $first = reset($this->rawPattern);

        // When all values are same just print the first one
        if(count(array_unique($this->rawPattern)) === 1 && end($this->rawPattern) === $first) {
            return $first;
        } else {
            $resultPattern = array();
            $patternToAppend = array();
            $doCheckIndex = 0;

            foreach($this->rawPattern as $key => $part) {
                if($key == 0) {
                    $resultPattern[] = $part;
                } else {
                    $checkNum = $this->rawPattern[$doCheckIndex];

                    if($checkNum == $part) {
                        $patternToAppend[] = $part;
                        $doCheckIndex++;
                    } else {
                        $patternToAppend[] = $part;
                        $doCheckIndex = 0;

                        if(!empty($patternToAppend)) {
                            $resultPattern = array_merge($resultPattern, $patternToAppend);
                            $patternToAppend = array();
                        }
                    }
                }
            }

            return implode($del, $resultPattern);
        }
    }
}

// $nums1 = new Predict(array(3, 6, 9));
// $nums2 = new Predict(array(4, 10, 5, 11, 6));
// $nums3 = new Predict(array(2, 16, 8, 13, 104, 52, 57, 456));

// echo $nums1->getPattern(); // prints +3
// echo $nums2->getPattern(); // prints +6 -5
// echo $nums3->getPattern(); // prints +14 -8 +5 +91 -52 +5 +399

$nums1 = new Predict(array(2,1,17,24,23,20,25,8,16,7,5));

echo $nums1->getPattern();
 ?>