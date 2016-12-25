<?php

namespace PricerBundle\Controller;

use PricerBundle\Entity\MarginRate;
use PricerBundle\Entity\OriginalPriceList;
use PricerBundle\Entity\PriceList;
use PricerBundle\Entity\PriceSetting;
use PricerBundle\Entity\ReadyPriceList;
use PricerBundle\Entity\Supplier;
use PricerBundle\Service\GlobalHelper;
use PricerBundle\Service\Pricer\FileReader\FileReader;
use PricerBundle\Service\Pricer\Pricer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PriceListController extends Controller
{

    public function showPriceListAction($supplierId)
    {
        $supplier = $this->getDoctrine()->getRepository('PricerBundle:Supplier')->find($supplierId);
        $allPriceLists = $this->getDoctrine()->getRepository('PricerBundle:PriceList')->findBy(array(
            'user'     => $this->getUser(),
            'supplier' => $supplier,
        ));

        return $this->render('@Pricer/priceList/show/showAll.html.twig', array(
            'priceLists' => $allPriceLists,
            'supplier'   => $supplier
        ));
    }

    public function addPriceListAction($supplierId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $supplier = $em->getRepository('PricerBundle:Supplier')->findOneBy(array(
                'user' => $this->getUser(),
                'id'   => $supplierId
            )
        );
        if (!$supplier) {
            throw $this->createNotFoundException('Такого поставщика не существует или у вас нет прав для его просмотра!');
        }
        $priceSettings = array();
        $priceConfig = GlobalHelper::getPriceSettingsConfig();
        foreach ($priceConfig as $pc) {
            $priceSettings[$pc] = $request->get($pc);
        }
        $priceList = new PriceList();
        $priceListErrors = array();
        if ($request->isMethod('POST')) {
            $request->files->get('priceList')->move(__DIR__ . '/../Resources/public/downloads/priceLists',
                $fileName = $request->files->get('priceList')->getClientOriginalName()
            );

            $validator = $this->get('validator');

            $priceList->setUser($this->getUser());
            $priceList->setSupplier($supplier);
            $priceList->setName($request->get('name'));
            $priceList->setCode($request->get('code'));
            $priceList->setFilePath($fileName);
            $em->persist($priceList);

            $setting = new PriceSetting();
            $setting->setSettingKey('fileName');
            $setting->setSettingValue($fileName);
            $setting->setPriceList($priceList);
            $em->persist($setting);
            foreach ($priceSettings as $key => $value) {
                $setting = new PriceSetting();
                $setting->setSettingKey($key);
                $setting->setSettingValue($value);
                $setting->setPriceList($priceList);
                $em->persist($setting);
            }
            $errors = $validator->validate($priceList);
            if (count($errors) == 0) {
                $em->flush();
            } else {
                foreach ($errors as $error) {
                    $priceListErrors[$error->getPropertyPath()] = $error->getMessage();
                }
            }
        }

        return $this->render('PricerBundle:priceList/form:priceList_form.html.twig', array(
            'formHeader' => 'Создание прайслиста',
            'action'     => $this->generateUrl('pricer_addPriceList', array(
                'supplierId' => $supplierId,
            )),
            'supplier'   => $supplier,
            'priceList'  => $priceList,
            'settings'   => $priceSettings,
            'errors'     => $priceListErrors,
        ));
    }

    public function updatePriceListAction($priceListId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $priceList = $em->getRepository('PricerBundle:PriceList')->findOneBy(array(
                'user' => $this->getUser(),
                'id'   => $priceListId
            )
        );
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        $settingsFromDB = $em->getRepository('PricerBundle:PriceSetting')->findBy(array(
                'priceList' => $priceList,
            )
        );
        $priceSettings = $this->getPriceListSettings($settingsFromDB);

        if ($request->isMethod('POST')) {
            $priceList->setName($request->get('name'));
            $priceList->setCode($request->get('code'));
            $priceList->setFilePath($fileName = $request->files->get('priceList')->getClientOriginalName());
            $request->files->get('priceList')->move(__DIR__ . '/../Resources/public/downloads/priceLists', $fileName);
            $em->persist($priceList);
            foreach ($settingsFromDB as $settingFromDB) {
                $settingFromDB->setSettingValue($request->get($settingFromDB->getSettingKey()));

                $priceSettings[$settingFromDB->getSettingKey()] = $settingFromDB->getSettingValue();

                $em->persist($settingFromDB);
            }
            $em->flush();
        }

        return $this->render('@Pricer/priceList/form/priceList_form.html.twig', array(
            'formHeader' => 'Редактирование прайслиста',
            'action'     => $this->generateUrl('pricer_updatePriceList', array(
                'priceListId' => $priceListId,
            )),
            'priceList'  => $priceList,
            'settings'   => $priceSettings,
            'supplier'   => $priceList->getSupplier(),
        ));
    }

    public function loadPriceListAction($priceListId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $priceList = $em->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        $priceSettings = $em->getRepository('PricerBundle:PriceSetting')->getNormalizedSettings($priceList);

        if ($request->isXmlHttpRequest() && $request->isMethod('POST')) {

            set_time_limit(600);
            ini_set("memory_limit", "512M");
            $fileLoader = Pricer::getReader(__DIR__ . '/../Resources/public/downloads/priceLists/' . $priceList->getFilePath(),
                'CSV'
            );
            $session = $this->get('session');

            if ($request->get('toClean') == 'true') {
                $session->remove('currentRow');
                $session->remove('lastRow');
            }

            $stepSize = 5000;
            if (empty($session->get('currentRow'))) {
                $session->set('currentRow', $priceSettings['startRow'] - 1);
            }
            $fileLoader->setSettings($stepSize, $session->get('currentRow'));
            $data = $fileLoader->getData();

            if ($request->get('toClean') == 'true') {
                $toClean = true;
            } else {
                $toClean = false;
            }


            $originalPLRepository = $this->getDoctrine()->getRepository('PricerBundle:OriginalPriceList');
            $originalPLRepository->multipleInsert($data, array(
                'priceListId' => $priceList->getId(),
                'userId'      => $this->getUser()->getId(),
            ), $priceSettings, $toClean);


            $session->set('currentRow', $session->get('currentRow') + $stepSize);

            $endOfFile = false;
            $totalRows = $session->get('currentRow') - $priceSettings['startRow'] + 1;
            $message = "Считано $totalRows строк!";
            $lastRow = $fileLoader->getLastRow();
            if ($lastRow < $session->get('currentRow') - 1) {
                $message = "Готово! Считано {$lastRow}!";
                $session->remove('currentRow');
                $session->remove('lastRow');
                $endOfFile = true;
            } else {
                $session->set('lastRow', $lastRow);
            }

            return new JsonResponse(array(
                'endOfFile' => $endOfFile,
                'message'   => $message
            ));
        }

        return $this->render('@Pricer/priceList/load/load.html.twig', array(
            'priceList' => $priceList,
            'settings'  => $priceSettings,
            'supplier'  => $priceList->getSupplier()
        ));
    }

    public function handlePriceListAction($priceListId, Request $request)
    {
        $doctrine = $this->getDoctrine();

        $priceList = $doctrine->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        if ($request->isMethod('POST') && $request->isXmlHttpRequest()) {
            set_time_limit(600);
            ini_set("memory_limit", "512M");
            $stepSize = 5000;
            $session = $this->get('session');


            if ($request->get('toClean') == 'true') {
                $toClean = true;
            } else {
                $toClean = false;
            }

            if ($toClean) {
                $session->remove('currentRow');
            }

            if (empty($session->get('currentRow'))) {
                $session->set('currentRow', 0);
            }

            $settingsFromDB = $doctrine->getRepository('PricerBundle:PriceSetting')->findBy(array(
                    'priceList' => $priceList,
                )
            );
            $priceSettings = $this->getPriceListSettings($settingsFromDB);

            $originalPLRepository = $doctrine->getRepository('PricerBundle:OriginalPriceList');
            $originalPLCount = $originalPLRepository->getCount($priceList->getId());

            $brandRulersDB = $doctrine->getRepository('PricerBundle:BrandRuler')->findBy(array(
                'supplier' => $priceList->getSupplier(),
            ));
            $brandRulers = array();
            foreach ($brandRulersDB as $brandRulerDB) {
                $brandRulers[$brandRulerDB->getRuler()] = $brandRulerDB->getBrand()->getName();
            }

            $vendorCodeRulersDB = $doctrine->getRepository('PricerBundle:VendorCodeRuler')->findBy(array(
                'supplier' => $priceList->getSupplier(),
            ));
            $vendorCodeRulers = array();
            foreach ($vendorCodeRulersDB as $vendorCodeRulerDB) {
                $vendorCodeRulers[] = array(
                    'brand'       => $vendorCodeRulerDB->getBrand()->getName(),
                    'ruler'       => $vendorCodeRulerDB->getRuler(),
                    'replacement' => $vendorCodeRulerDB->getReplacement(),
                );
            }

            $originalPriceData = $this->getDoctrine()->getRepository('PricerBundle:OriginalPriceList')->findByPriceListId(
                $priceList->getId(),
                $stepSize,
                $session->get('currentRow')
            );

            $dataHandler = Pricer::getDataHandler('common', array(
                $originalPriceData,
                $brandRulers,
                $vendorCodeRulers,
                array(
                    'currency'        => $priceSettings['currency'],
                    'exchangeRate'    => $priceSettings['exchangeRate'],
                    'defaultCurrency' => 'EUR',
                    'marginRates'     => $doctrine->getRepository('PricerBundle:MarginRate')->getRatesByUserId($this->getUser()->getId()),
                    'supplier'        => $priceList->getSupplier(),
                )
            ));

            $readyPriceData = $dataHandler->getHandledData();
            $doctrine->getRepository('PricerBundle:ReadyPriceList')->multipleInsert(
               $readyPriceData,
                array(
                    'priceListId' => $priceList->getId(),
                    'userId'      => $this->getUser()->getId(),
                ),
                $priceSettings,
                $toClean
            );

            $endOfFile = false;
            $session->set('currentRow', $session->get('currentRow') + $stepSize);
            $message = "Считано {$session->get('currentRow')} строк!";
            if ($originalPLCount < $session->get('currentRow')) {
                $message = "Готово! Считано {$originalPLCount}!";
                $session->remove('currentRow');
                $endOfFile = true;
            }

            return new JsonResponse(array(
                'endOfFile' => $endOfFile,
                'message'   => $message
            ));
        }

        return $this->render('@Pricer/priceList/handle/handlePriceList.html.twig', array(
            'priceList' => $priceList,
            'supplier'  => $priceList->getSupplier(),
            'marginRates' => $this->getUser()->getMarginRate(),
        ));
    }

    public function downLoadReadyPriceListAction($priceListId)
    {
        set_time_limit(600);
        ini_set("memory_limit", "512M");
        $doctrine = $this->getDoctrine();
        $priceList = $doctrine->getRepository('PricerBundle:PriceList')->findOneBy(array(
            'id'   => $priceListId,
            'user' => $this->getUser(),
        ));
        if (!$priceList) {
            throw $this->createNotFoundException('Такого прайслиста не существует или у вас нету прав для просмотра этого прайслиста!');
        }
        $file = __DIR__ . '/../Resources/public/uploads/priceLists/' . time() . '_' . $this->getUser()->getId() . '.csv';
        $writer = Pricer::getWriter($file, 'csv');


        $writer->save($this->readyPriceListToArray($priceList));
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);

        return $response;
    }

    public function saveMarginRatesAction(Request $request)
    {
        $marginRatesData = array();
        if ($request->isXmlHttpRequest()) {
            $marginRatesData = $request->get('marginRatesData');
            $em = $this->getDoctrine()->getManager();
            $this->getDoctrine()->getRepository('PricerBundle:MarginRate')->clearBy('user_id', $this->getUser()->getId());
            foreach ($marginRatesData as $ratesData) {
                $marginRate = new MarginRate();
                $marginRate->setFromPrice($ratesData['from']);
                $marginRate->setToPrice($ratesData['to']);
                $marginRate->setMarginRate($ratesData['rate']);
                $marginRate->setUser($this->getUser());
                $em->persist($marginRate);
                $em->flush();
            }
        }
        return new JsonResponse($marginRatesData);
    }

    private function getPriceListSettings($settingsFromDB)
    {

        $priceSettings = array();

        foreach ($settingsFromDB as $setting) {
            $priceSettings[$setting->getSettingKey()] = $setting->getSettingValue();
        }

        return $priceSettings;
    }

    private function readyPriceListToArray(PriceList $priceList)
    {
        $readyPriceListArray = array();

        $readyPriceLists = $this->getDoctrine()->getRepository('PricerBundle:ReadyPriceList')->findAllByPriceListId($priceList->getId());
        foreach ($readyPriceLists as $readyPriceList) {
            $readyPriceListArray[] = array(
                $readyPriceList['vendorCode'],
                $readyPriceList['brand'],
                $readyPriceList['name'],
                preg_replace('|(\.)|', ',', $readyPriceList['price']),
                $readyPriceList['quantity'],
                'EUR',
            );
        }
        return $readyPriceListArray;
    }
}