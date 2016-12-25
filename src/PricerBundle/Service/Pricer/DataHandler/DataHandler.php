<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 13.08.2016
 * Time: 10:04
 */

namespace PricerBundle\Service\Pricer\DataHandler;


use PricerBundle\Service\Pricer\DataHandler\DataInterface\DataHandlerInterface;

class DataHandler implements DataHandlerInterface
{
    private $brandRulers = array();

    private $vendorCodeRulers = array();

    private $data = array();

    private $readyPriceLists = array();

    private $config = array();

    public function __construct(array $data, array $brandRulers, array $vendorCodeRulers, array $priceListConfig)
    {
        $this->data = $data;
        $this->brandRulers = $brandRulers;
        $this->vendorCodeRulers = $this->normalizeVendorCodeRulers($vendorCodeRulers);
        $this->config = $priceListConfig;
    }

    public function getHandledData()
    {
        foreach ($this->data as $data) {
            $this->readyPriceLists[] = $this->handleData($data);
        }
        return $this->readyPriceLists;
    }

    protected function normalizeVendorCodeRulers($vendorCodeRulers = array())
    {
        $normalizedRulers = array();
        foreach ($vendorCodeRulers as $vendorCodeRuler) {
            $normalizedRulers[$vendorCodeRuler['brand']]['rulers'][] = array(
                'pattern'     => $vendorCodeRuler['ruler'],
                'replacement' => $vendorCodeRuler['replacement']
            );
        }
        return $normalizedRulers;
    }

    protected function handleData(array $data)
    {

        $readyPriceList = array();
        $readyPriceList['brand'] = $this->handleBrand($data);
        $readyPriceList['vendorCode'] = $this->handleVendorCode($data, $readyPriceList['brand']);
        $readyPriceList['name'] = $data['name'];
        $readyPriceList['description'] = $data['description'];
        $readyPriceList['price'] = $this->handlePrice($data);
        $readyPriceList['quantity'] = $data['quantity'];
        $readyPriceList['parent_id'] = $data['id'];

        return $readyPriceList;
    }

    protected function handleBrand(array $data)
    {
        $brand = trim($data['brand']);
        if (key_exists($brand, $this->brandRulers)) {
            $brand = preg_replace("|$brand|", "{$this->brandRulers[$brand]}", $brand);
        }
        return $brand;
    }

    protected function handleVendorCode(array $data, $handledBrandName)
    {
        $vendorCode = trim($data['vendorCode']);
        $brand = trim($handledBrandName);
        if (key_exists($brand, $this->vendorCodeRulers)) {
            foreach ($this->vendorCodeRulers[$brand]['rulers'] as $ruler) {
                $vendorCode = preg_replace("|{$ruler['pattern']}|", $ruler['replacement'], $vendorCode);
            }
        }
        $vendorCode = preg_replace("|[',-.\s]|", '', $vendorCode);

        return $vendorCode;
    }

    protected function handlePrice(array $data)
    {
        $price = (float)preg_replace('|(,)|', '.', $data['price']);

        if ($this->config['currency'] != $this->config['defaultCurrency']) {
            $price = $price/$this->config['exchangeRate'];
        }
        $price = $this->margePrice($price);
        return round($price, 2);
    }

    protected function margePrice($price)
    {
        foreach ($this->config['marginRates'] as $rates) {
            if ($price >= $rates['fromPrice'] && $price < $rates['toPrice']) {
                $price = $price *(1 + ($rates['marginRate'] / 100));
                return $price;
            }
        }
    }
}