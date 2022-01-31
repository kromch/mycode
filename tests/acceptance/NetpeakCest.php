<?php
use Codeception\Util\Locator;
class NetpeakCest
{
    private function RGB2Hex($sCSSString)
	{
	$sRegex="/rgb(\S?([0-9]{1,3}),\S?([0-9]{1,3}),\S?([0-9]{1,3}))/i";  
    preg_match($sRegex,str_replace(" ","",$sCSSString),$matches);
	if(count($matches)!= 5) {  
      $sHexValue="000000";  
    }  
	else {	
      $iRed=(int) $matches[2];  
      $iGreen=(int) $matches[3];  
      $iBlue=(int) $matches[4];
	  $sHexValue=str_pad(dechex($iRed),2,"0",STR_PAD_LEFT).str_pad(dechex($iGreen),2,"0",STR_PAD_LEFT).str_pad(dechex($iBlue),2,"0",STR_PAD_LEFT);
	}
    return strtoupper('#'.$sHexValue);	
	}	
	
	public function _before(AcceptanceTester $I)
    {
		$I->openNewTab();
    }

    public function tryToTest(AcceptanceTester $I)
    {
		$I->amOnPage('/');
		$I->seeInTitle('Netpeak Украина');
        $I->click(['link' =>'Карьера']); //['class=custom-link-black']
		$I->switchToNextTab();
		$I->seeInTitle('Работа в Netpeak');
		$I->click('//a[@class="btn btn-send-order btn-color-1"]');//'Заполнить анкету'
	    $I->seeElement(['id' => 'upload']);
		$I->attachFile('//input[@type="file"][@name="up_file"]','dr.png');
		$I->wait(10);
		$I->fillField("//input[@id='inputName']", "Hello World!");
		$I->fillField("//input[@id='inputLastname']", "Hello World!");
		$I->fillField("//input[@id='inputEmail']", "ello@orld.ua");
		$I->selectOption("//select[@name='by']","1981"); 
		$I->selectOption("//select[@name='bm']","11"); 
		$I->selectOption("//select[@name='bd']","05"); 
		$I->fillField("//input[@id='inputPhone']", "09547812489");
		$I->scrollTo(['css' => 'button[class="btn green-btn"]'], 0, 50);
		$I->checkOption('#agree_rules');
		$I->waitForElementClickable(['css' => 'button[class="btn green-btn"]'], 30);
		$I->click('//button[@id="submit"]');
		$I->scrollTo(['css' => 'nav[id="main-menu"]'], 0, 0);
		$text=$I->grabTextFrom("//p[@class='warning-fields help-block']");
		$textcolor=$I->executeJS('return jQuery("p.warning-fields.help-block").css("color");');
		$I->comment($text);
		$I->comment("IS");
		if(isset($textcolor)) 
		   $textcolor=$this->RGB2Hex($textcolor);
		else $textcolor="None";
		$I->comment($textcolor=='#FF0000'?'RED':'Another color '.$textcolor);
		$I->click(['link' =>'Интернатура']); 
	}
}
