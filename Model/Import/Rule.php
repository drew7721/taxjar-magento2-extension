<?php
/**
 * Taxjar_SalesTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Taxjar
 * @package    Taxjar_SalesTax
 * @copyright  Copyright (c) 2017 TaxJar. TaxJar is a trademark of TPS Unlimited, Inc. (http://www.taxjar.com)
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Taxjar\SalesTax\Model\Import;

use Taxjar\SalesTax\Model\Import\RuleModelFactory as CalculationRuleFactory;

class Rule
{
    /**
     * @var \Magento\Tax\Model\Calculation\RuleFactory
     */
    protected $ruleFactory;

    /**
     * @param CalculationRuleFactory $ruleFactory
     */
    public function __construct(
        CalculationRuleFactory $ruleFactory
    ) {
        $this->ruleFactory = $ruleFactory;
        return $this;
    }

    /**
     * Create new tax rule based on code
     *
     * @param string $code
     * @param array $customerClasses
     * @param array $productClasses
     * @param integer $position
     * @param array $rates
     * @throws \Exception
     * @return void
     */
    public function create($code, $customerClasses, $productClasses, $position, $rates)
    {
        $ruleModel = $this->ruleFactory->create();
        $ruleModel->load($code, 'code');
        $ruleModel->setTaxRateIds(array_merge($ruleModel->getRates(), $rates));
        $ruleModel->setCode($code);
        $ruleModel->setCustomerTaxClassIds($customerClasses);
        $ruleModel->setProductTaxClassIds($productClasses);
        $ruleModel->setPosition($position);
        $ruleModel->setPriority(1);
        $ruleModel->setCalculateSubtotal(0);
        $ruleModel->save();
        $this->saveCalculationData($ruleModel, $rates);
    }

    /**
     * @param $ruleModel
     * @param $rates
     */
    public function saveCalculationData($ruleModel, $rates)
    {
        $ctc = $ruleModel->getData('customer_tax_class_ids');
        $ptc = $ruleModel->getData('product_tax_class_ids');

        foreach ($ctc as $c) {
            foreach ($ptc as $p) {
                foreach ($rates as $r) {
                    $dataArray = [
                        'tax_calculation_rule_id' => $ruleModel->getId(),
                        'tax_calculation_rate_id' => $r,
                        'customer_tax_class_id' => $c,
                        'product_tax_class_id' => $p,
                    ];
                    $calculation = $ruleModel->getCalculationModel();

                    $calculationModel = $calculation->getCollection()
                        ->addFieldToFilter('tax_calculation_rate_id', $r)
                        ->addFieldToFilter('customer_tax_class_id', $c)
                        ->addFieldToFilter('product_tax_class_id', $p)
                        ->getFirstItem();

                    if ($calculationModel->getId()) {
                        $calculationModel->delete();
                    }

                    $calculation->setData($dataArray)->save();
                }
            }
        }
    }
}
