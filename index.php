<?php

class CheckOut
{
    public $total = 0 ;
    public $ipdPrice;
    public $ipdCount = 0;
    public $mbpPrice;
    public $mbpCount = 0;
    public $atvPrice;
    public $atvCount = 0;
    public $vgaPrice;
    public $vgaCount = 0;
    public $type;
    

    public function __construct(float $ipdPrice,float $mbpPrice, float $atvPrice, float $vgaPrice )
    {
        $this->ipdPrice = $ipdPrice;
        $this->mbpPrice = $mbpPrice;
        $this->atvPrice = $atvPrice;
        $this->vgaPrice = $vgaPrice;
       

    }

   

    public function getItemPrice()
    {
       
        $base = 'Ipd Price '.$this->ipdPrice.' <br>';
        $base .= 'Mba Price '.$this->mbpPrice.' <br>';
        $base .= 'Atv Price '.$this->atvPrice.' <br>';
        $base .= 'Vga Price '.$this->vgaPrice.' <br>';
        return $base;
       
    }

    public function scan(string $type){
        switch ($type) {
            case "ipd":
                echo "<br>Your add ipd. Price per unit is : ".$this->ipdPrice;
                $this->ipdCount = $this->ipdCount + 1 ;
                echo ', Number of ipd : '.$this->ipdCount;
                echo  "<br>Total ipd price after discount : ".$this->ipdPricingRules().'<br>';
                break;
            case "mbp":
                echo "<br>Your add mbp. Price per unit is : ".$this->mbpPrice;
                $this->mbpCount = $this->mbpCount + 1 ;
                
                echo ', Number of mbp : '.$this->mbpCount;
                echo  "<br>Total mbp price after discount : ".$this->mbpPricingRules().'<br>';
                break;
            case "atv":
                echo "<br>Your add atv. Price per unit is : ".$this->atvPrice;
                $this->atvCount = $this->atvCount + 1 ;
                
                echo ', Number of atv : '.$this->atvCount;
                echo  "<br>Total atv price after discount : ".$this->atvPricingRules().'<br>';
                break;
            case "vga":
                echo "<br>Your add vga. Price per unit is : ".$this->vgaPrice;
                $this->vgaCount = $this->vgaCount + 1 ;
                
                echo ', Number of vga : '.$this->vgaCount;
                echo  "<br>Total vga price after discount : ".$this->vgaPricingRules().'<br>';
                break;        
            default:
                echo "Scan Error";
        }

    }

    public function atvPricingRules(){
        $unitatvPrice = $this->atvPrice;
        $totalatv = $this->atvCount;

        $number = (int) ($totalatv / 3) ;
        $remainder = (int) ($totalatv % 3) ;

        $numberPrice = $number * $unitatvPrice * 2;
        $remainderPrice = $remainder * $unitatvPrice ;

        $atvTotalPrice = $numberPrice + $remainderPrice;

        return $atvTotalPrice;

    }

    public function vgaPricingRules(){
        $unitvgaPrice = $this->vgaPrice;
        $totalvga = $this->vgaCount;
        $totalmbp = $this->mbpCount;

        if($totalvga > $totalmbp){
            $vgaTotalPrice = ( $totalvga - $totalmbp) * $unitvgaPrice ;

        } else {
            $vgaTotalPrice = 0 ;
        }

        

        return $vgaTotalPrice;

    }

    public function mbpPricingRules(){
        $unitmbpPrice = $this->mbpPrice;
        $totalmbp = $this->mbpCount;
        

        $mbpTotalPrice = $unitmbpPrice * $totalmbp ;

        return $mbpTotalPrice;

    }

    public function ipdPricingRules(){
        
        $totalipd = $this->ipdCount;

        if($totalipd > 4){
            $unitipdPrice = 499.99;
            $ipdTotalPrice = $unitipdPrice * $totalipd ;
        } else {
            $unitipdPrice = $this->ipdPrice;
            $ipdTotalPrice = $unitipdPrice * $totalipd ;
        }

        
        return $ipdTotalPrice;

    }

    public function total(){
        return $this->atvPricingRules() + $this->vgaPricingRules() + $this->ipdPricingRules() + $this->mbpPricingRules() ;
    }






}



     $url = 'data.json'; // path to your JSON file
     $data = file_get_contents($url); // put the contents of the file into a variable
     $characters = json_decode($data); // decode the JSON feed
     

echo '<h1>Section 2 : Simple Checkout System Output</h1>';


       

        foreach ($characters as $character) {
            echo $character->sku . ', ';
            echo $character->name . ', ';
            echo $character->price . ' <br>';
        }

$item1 = $characters[0]->price ;
$item2 = $characters[1]->price ;
$item3 = $characters[2]->price ;
$item4 = $characters[3]->price ;



echo "<br>Sku Scanned : atv, atv, atv , vga";
$co = new CheckOut($item1, $item2, $item3, $item4);
// echo $co->getItemPrice();
$additem1 = 'atv';
$co->scan($additem1);
$additem2 = 'atv';
$co->scan($additem2);
$additem3 = 'atv';
$co->scan($additem3);
$additem4 = 'vga';
$co->scan($additem4);
echo '<p><span style="color:red;font-weight:bold"> $ '.$co->total().'</span><p>';

echo '<br><br>';

echo 'Sku Scanned : atv, ipd, ipd, atv, ipd, ipd, ipd';
$co1 = new CheckOut($item1, $item2, $item3, $item4);
// echo $co->getItemPrice();
$additem1 = 'atv';
$co1->scan($additem1);
$additem2 = 'ipd';
$co1->scan($additem2);
$additem3 = 'ipd';
$co1->scan($additem3);
$additem4 = 'atv';
$co1->scan($additem4);
$additem5 = 'ipd';
$co1->scan($additem5);
$additem6 = 'ipd';
$co1->scan($additem6);
$additem7 = 'ipd';
$co1->scan($additem7);
echo '<p><span style="color:red;font-weight:bold"> $ '.$co1->total().'</span><p>';
// echo $co1->total();

echo '<br><br>';


echo 'Sku Scanned : mbp, vga, ipd';
$co2 = new CheckOut($item1, $item2, $item3, $item4);
// echo $co->getItemPrice();
$additem1 = 'mbp';
$co2->scan($additem1);
$additem2 = 'vga';
$co2->scan($additem2);
$additem3 = 'ipd';
$co2->scan($additem3);
echo '<p><span style="color:red;font-weight:bold"> $ '.$co2->total().'</span><p>';
// echo $co2->total();

echo '<br><br>';

  



   


