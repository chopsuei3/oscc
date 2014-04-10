<?php
/**
 * This class implements the GEO IP API <http://geoip.dmwtechnologies.com>
 * 
 * @author Rochak Chauhan
 * @package GeoIp.dmwtechnologies.com
 *
 * @uses PHP5, Fopen and SimpleXml 
 * @version 2.0
 */
class GeoIpApiConnector {
	private $url="http://geoip.dmwtechnologies.com/api.php";
	private $ip="";
	private $apiKey="";
	private $xmlContent="";
	
	/**
	 * Construction function
	 *
	 * @param string $apiKey
	 * @access public
	 * @return class object
	 */
	public function __construct($apiKey) {
		$this->apiKey=$apiKey;
	}

	/**
	 * Function to extract entire information from the API as array 
	 *
	 * @param string $ip
	 * @return array
	 */ 
	public function getInformationArray($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		return (array) $xmlObject->CountryFromIp;
	}

	/**
	 * Function to extract the Country Name from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCountryName($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CountryName'];
	}
	
	/**
	 * Function to extract the Country Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCountryCode($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CountryCode'];
	}
	
	/**
	 * Function to extract the Region Name from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getRegionName($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['RegionName'];
	}
	
	/**
	 * Function to extract the City Name from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCityName($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CityName'];
	}
	
	/**
	 * Function to extract the Latitude from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getLatitude($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['Latitude'];
	}

	/**
	 * Function to extract the Longitude from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getLongitude($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['Longitude'];
	}

	/**
	 * Function to extract the PIN Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getPinCode($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['PinCode'];
	}

	/**
	 * Function to extract the DMA Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getDmaCode($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['DmaCode'];
	}

	/**
	 * Function to extract the Area Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getAreaCode($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['AreaCode'];
	}

	/**
	 * Function to extract the Local Time from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getLocalTime($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['LocalTime'];
	}
	
	/**
	 * Function to extract the Current Temperature from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCurrentTemperature($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CurrentTemperature'];
	}
	
	/**
	 * Function to extract the Capital Name from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCapitalName($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CountryCapital'];
	}
	
	/**
	 * Function to extract the Currency Name from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCurrencyName($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['Currency'];
	}
	
	/**
	 * Function to extract the Current conversion rate from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCurrentConversionRate($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CurrentConversionRate'];
	}
	
	/**
	 * Function to extract the Calling Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getCallingCode($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['CallingCode'];
	}
	
	/**
	 * Function to extract the AccountType from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getAccountType($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['AccountType'];
	}

	/**
	 * Function to extract the Total Requests Made from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getTotalRequestsMade($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['TotalRequestsMade'];
	}
	
	/**
	 * Function to extract the Remaining Requests Code from the xml 
	 *
	 * @param string $ip
	 * @return string
	 */ 
	public function getRemainingRequests($ip) {
		$xmlContent=$this->getXmlFromApi($this->apiKey,$ip);
		$xmlObject = simplexml_load_string($xmlContent);
		if (isset($xmlObject->Error->ErrorMessage)) { return $xmlObject->Error->ErrorCode.": ".$xmlObject->Error->ErrorMessage; }
		$infoArray=(array) $xmlObject->CountryFromIp;
		return $infoArray['RemainingRequests'];
	}

	/**
	 * Function to extract xml code from API using fopen
	 *
	 * @param string $apiKey
	 * @param string $ip
	 * @access public
	 * @return string
	 */
	private function getXmlFromApi($apiKey,$ip){
		$oldIp=trim($this->ip);
		if ($oldIp==$ip) {
			return $this->xmlContent;
		}
		$apiKey=trim($apiKey);
		$ip=trim($ip);
		$this->ip=$ip;
		$url=$this->url."?apikey=$apiKey&ip=$ip";
		$returnStr="";
		$fp=fopen($url, "r") or die("<div>Failed to open this API: $url for reading via this script.<br />Please try again after sometime.</div>");
		while (!feof($fp)) {
			$returnStr.=fgetc($fp);
		}
		fclose($fp);
		$this->xmlContent=$returnStr;
		return $returnStr;
	}

}
?>