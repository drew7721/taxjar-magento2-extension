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

namespace Taxjar\SalesTax\Test\Integration\Model\Tax\Sales\Total\Quote;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Tax\Model\Config;
use Magento\Tax\Model\Calculation;

class SetupUtil
{
    /**
     * Default tax related configurations
     *
     * @var array
     */
    protected $defaultConfig = [
        Config::CONFIG_XML_PATH_SHIPPING_TAX_CLASS => '0',
        Config::CONFIG_XML_PATH_PRICE_INCLUDES_TAX => 0, //Excluding tax
        Config::CONFIG_XML_PATH_SHIPPING_INCLUDES_TAX => 0, //Excluding tax
        Config::CONFIG_XML_PATH_BASED_ON => 'shipping', // or 'billing'
        Config::CONFIG_XML_PATH_APPLY_ON => '0',
        Config::CONFIG_XML_PATH_APPLY_AFTER_DISCOUNT => '0',
        Config::CONFIG_XML_PATH_DISCOUNT_TAX => '0',
        Config::XML_PATH_ALGORITHM => Calculation::CALC_TOTAL_BASE,
        //@TODO: add config for cross border trade
    ];

    public const TAX_RATE_TX = 'tax_rate_tx';
    public const TAX_RATE_AUSTIN = 'tax_rate_austin';
    public const TAX_RATE_SEATTLE = 'tax_rate_seattle';
    public const TAX_RATE_INDIA = 'tax_rate_india';
    public const TAX_RATE_SHIPPING = 'tax_rate_shipping';
    public const TAX_STORE_RATE = 'tax_store_rate';
    public const REGION_CA = '12';
    public const REGION_CO = '13';
    public const REGION_FL = '18';
    public const REGION_MO = '36';
    public const REGION_NY = '43';
    public const REGION_TX = '57';
    public const REGION_WA = '62';
    public const COUNTRY_US = 'US';
    public const COUNTRY_IN = 'IN';
    public const AUSTIN_POST_CODE = '79729';
    public const SEATTLE_POST_CODE = '98101';

    /**
     * Tax rates data
     *
     * @var array
     */
    protected $taxRates = [
        self::TAX_RATE_TX => [
            'data' => [
                'tax_country_id' => self::COUNTRY_US,
                'tax_region_id' => self::REGION_TX,
                'tax_postcode' => '*',
                'code' => self::TAX_RATE_TX,
                'rate' => '20',
            ],
            'id' => null,
        ],
        self::TAX_RATE_AUSTIN => [
            'data' => [
                'tax_country_id' => self::COUNTRY_US,
                'tax_region_id' => self::REGION_TX,
                'tax_postcode' => self::AUSTIN_POST_CODE,
                'code' => self::TAX_RATE_AUSTIN,
                'rate' => '5',
            ],
            'id' => null,
        ],
        self::TAX_RATE_SEATTLE => [
            'data' => [
                'tax_country_id' => self::COUNTRY_US,
                'tax_region_id' => self::REGION_WA,
                'tax_postcode' => self::SEATTLE_POST_CODE,
                'code' => self::TAX_RATE_SEATTLE,
                'rate' => '9.6',
            ],
            'id' => null,
        ],
        self::TAX_RATE_INDIA => [
            'data' => [
                'tax_country_id' => self::COUNTRY_IN,
                'tax_postcode' => '*',
                'code' => self::TAX_RATE_INDIA,
                'rate' => '14.5',
            ],
            'id' => null,
        ],
        self::TAX_RATE_SHIPPING => [
            'data' => [
                'tax_country_id' => self::COUNTRY_US,
                'tax_region_id' => '*',
                'tax_postcode' => '*',
                'code' => self::TAX_RATE_SHIPPING,
                'rate' => '7.5',
            ],
            'id' => null,
        ],
        self::TAX_STORE_RATE => [
            'data' => [
                'tax_country_id' => self::COUNTRY_US,
                'tax_region_id' => self::REGION_CA,
                'tax_postcode' => '*',
                'code' => self::TAX_STORE_RATE,
                'rate' => '8.25',
            ],
            'id' => null,
        ],
    ];

    public const PRODUCT_TYPE_BUNDLE = \Magento\Catalog\Model\Product\Type::TYPE_BUNDLE;
    public const PRODUCT_TYPE_CONFIGURABLE = \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE;
    public const PRODUCT_TYPE_SIMPLE = \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE;

    public const PRODUCT_DEFAULT_TAX_CLASS = 'product_default_tax_class';
    public const PRODUCT_CLOTHING_TAX_CLASS = 'product_clothing_tax_class';
    public const PRODUCT_GROCERY_TAX_CLASS = 'product_grocery_tax_class';
    public const SHIPPING_TAX_CLASS = 'shipping_tax_class';

    /**
     * List of product tax class that will be created
     *
     * @var array
     */
    protected $productTaxClasses = [
        self::PRODUCT_DEFAULT_TAX_CLASS => null,
        self::PRODUCT_CLOTHING_TAX_CLASS => null,
        self::PRODUCT_GROCERY_TAX_CLASS => null,
        self::SHIPPING_TAX_CLASS => null,
    ];

    /**
     * Product tax class metadata such as TaxJar category tax codes
     *
     * @var array
     */
    protected $productTaxClassesMetadata = [
        self::PRODUCT_CLOTHING_TAX_CLASS => [
            'tj_salestax_code' => '20010'
        ],
        self::PRODUCT_GROCERY_TAX_CLASS => [
            'tj_salestax_code' => '40030'
        ]
    ];

    public const CUSTOMER_TAX_CLASS_1 = 'customer_tax_class_1';
    public const CUSTOMER_PASSWORD = 'password';

    /**
     * List of customer tax class to be created
     *
     * @var array
     */
    protected $customerTaxClasses = [
        self::CUSTOMER_TAX_CLASS_1 => null,
    ];

    /**
     * List of tax rules
     *
     * @var array
     */
    protected $taxRules = [];

    public const CONFIG_OVERRIDES = 'config_overrides';
    public const TAX_RATE_OVERRIDES = 'tax_rate_overrides';
    public const TAX_RULE_OVERRIDES = 'tax_rule_overrides';
    public const NEXUS_OVERRIDES = 'nexus_overrides';

    /**
     * Nexus address defaults
     *
     * @var array
     */
    protected $nexusAddresses = [
        [
            'street' => '123 Main St',
            'city' => 'San Francisco',
            'country_id' => 'US',
            'region' => 'California',
            'region_id' => 12,
            'region_code' => 'CA',
            'postcode' => '94111'
        ],
        [
            'street' => '123 Main St',
            'city' => 'Austin',
            'country_id' => 'US',
            'region' => 'Texas',
            'region_id' => 57,
            'region_code' => 'TX',
            'postcode' => '73301'
        ],
        [
            'street' => '123 Wall St',
            'city' => 'New York',
            'country_id' => 'US',
            'region' => 'New York',
            'region_id' => 43,
            'region_code' => 'NY',
            'postcode' => '10001'
        ]
    ];

    /**
     * Default data for shopping cart rule
     *
     * @var array
     */
    protected $defaultShoppingCartPriceRule = [
        'name' => 'Shopping Cart Rule',
        'is_active' => 1,
        'customer_group_ids' => [\Magento\Customer\Model\GroupManagement::CUST_GROUP_ALL],
        'coupon_type' => \Magento\SalesRule\Model\Rule::COUPON_TYPE_NO_COUPON,
        'simple_action' => 'by_percent',
        'discount_amount' => 40,
        'discount_step' => 0,
        'stop_rules_processing' => 1,
        'website_ids' => [1],
    ];

    /**
     * @var mixed
     */
    protected $configurableProductAttributes;

    /**
     * Object manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    public $objectManager;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var \Magento\Customer\Api\AccountManagementInterface
     */
    private $accountManagement;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
        $this->customerRepository = $this->objectManager->create(
            \Magento\Customer\Api\CustomerRepositoryInterface::class
        );
        $this->accountManagement = $this->objectManager->create(
            \Magento\Customer\Api\AccountManagementInterface::class
        );
    }

    /**
     * Create customer tax classes
     *
     * @return $this
     */
    protected function createCustomerTaxClasses()
    {
        foreach (array_keys($this->customerTaxClasses) as $className) {
            $taxClass = $this->objectManager->create(\Magento\Tax\Model\ClassModel::class)
                ->setClassName($className)
                ->setClassType(\Magento\Tax\Model\ClassModel::TAX_CLASS_TYPE_CUSTOMER);
            if (isset($this->customerTaxClassesMetadata[$className])) {
                foreach ($this->customerTaxClassesMetadata[$className] as $attr => $val) {
                    $taxClass->setData($attr, $val);
                }
            }
            $taxClass->save();
            $this->customerTaxClasses[$className] = $taxClass->getId();
        }

        return $this;
    }

    /**
     * Create product tax classes
     *
     * @return $this
     */
    protected function createProductTaxClasses()
    {
        foreach (array_keys($this->productTaxClasses) as $className) {
            $taxClass = $this->objectManager->create(\Magento\Tax\Model\ClassModel::class)
                ->setClassName($className)
                ->setClassType(\Magento\Tax\Model\ClassModel::TAX_CLASS_TYPE_PRODUCT);
            if (isset($this->productTaxClassesMetadata[$className])) {
                foreach ($this->productTaxClassesMetadata[$className] as $attr => $val) {
                    $taxClass->setData($attr, $val);
                }
            }
            $taxClass->save();
            $this->productTaxClasses[$className] = $taxClass->getId();
        }

        return $this;
    }

    /**
     * Set the configuration.
     *
     * @param array $configData
     * @return $this
     */
    protected function setConfig($configData)
    {
        /** @var \Magento\Config\Model\ResourceModel\Config $config */
        $config = $this->objectManager->get(\Magento\Config\Model\ResourceModel\Config::class);
        foreach ($configData as $path => $value) {
            if ($path == Config::CONFIG_XML_PATH_SHIPPING_TAX_CLASS) {
                $value = $this->productTaxClasses[$value];
            }
            $config->saveConfig(
                $path,
                $value,
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
                0
            );
        }

        /** @var \Magento\Framework\App\Config\ReinitableConfigInterface $config */
        $config = $this->objectManager->get(\Magento\Framework\App\Config\ReinitableConfigInterface::class);
        $config->reinit();

        return $this;
    }

    /**
     * Create tax rates
     *
     * @param array $overrides
     * @return $this
     * @SuppressWarnings(MEQP1.Performance.Loop.ModelLSD)
     */
    protected function createTaxRates($overrides)
    {
        $taxRateOverrides = empty($overrides[self::TAX_RATE_OVERRIDES]) ? [] : $overrides[self::TAX_RATE_OVERRIDES];
        foreach (array_keys($this->taxRates) as $taxRateCode) {
            if (isset($taxRateOverrides[$taxRateCode])) {
                $this->taxRates[$taxRateCode]['data']['rate'] = $taxRateOverrides[$taxRateCode];
            }
            $this->taxRates[$taxRateCode]['id'] = $this->objectManager
                ->create(\Magento\Tax\Model\Calculation\Rate::class)
                ->setData($this->taxRates[$taxRateCode]['data'])
                ->save()
                ->getId();
        }
        return $this;
    }

    /**
     * Convert the code to id for productTaxClass, customerTaxClass and taxRate in taxRuleOverrideData
     *
     * @param array $taxRuleOverrideData
     * @param array $taxRateIds
     * @return array
     */
    protected function processTaxRuleOverrides($taxRuleOverrideData, $taxRateIds)
    {
        if (!empty($taxRuleOverrideData['customer_tax_class_ids'])) {
            $customerTaxClassIds = [];
            foreach ($taxRuleOverrideData['customer_tax_class_ids'] as $customerClassCode) {
                $customerTaxClassIds[] = $this->customerTaxClasses[$customerClassCode];
            }
            $taxRuleOverrideData['customer_tax_class_ids'] = $customerTaxClassIds;
        }
        if (!empty($taxRuleOverrideData['product_tax_class_ids'])) {
            $productTaxClassIds = [];
            foreach ($taxRuleOverrideData['product_tax_class_ids'] as $productClassCode) {
                $productTaxClassIds[] = $this->productTaxClasses[$productClassCode];
            }
            $taxRuleOverrideData['product_tax_class_ids'] = $productTaxClassIds;
        }
        if (!empty($taxRuleOverrideData['tax_rate_ids'])) {
            $taxRateIdsForRule = [];
            foreach ($taxRuleOverrideData['tax_rate_ids'] as $taxRateCode) {
                $taxRateIdsForRule[] = $taxRateIds[$taxRateCode];
            }
            $taxRuleOverrideData['tax_rate_ids'] = $taxRateIdsForRule;
        }

        return $taxRuleOverrideData;
    }

    /**
     * Return a list of product tax class ids NOT including shipping product tax class
     *
     * @return array
     */
    protected function getProductTaxClassIds()
    {
        $productTaxClassIds = [];
        foreach ($this->productTaxClasses as $productTaxClassName => $productTaxClassId) {
            if ($productTaxClassName != self::SHIPPING_TAX_CLASS) {
                $productTaxClassIds[] = $productTaxClassId;
            }
        }

        return $productTaxClassIds;
    }

    /**
     * Return a list of tax rate ids NOT including shipping tax rate
     *
     * @return array
     */
    protected function getDefaultTaxRateIds()
    {
        $taxRateIds = [
            $this->taxRates[self::TAX_RATE_TX]['id'],
            $this->taxRates[self::TAX_STORE_RATE]['id'],
        ];

        return $taxRateIds;
    }

    /**
     * Return the default customer group tax class id
     *
     * @return int
     */
    public function getDefaultCustomerTaxClassId()
    {
        /** @var  \Magento\Customer\Api\GroupManagementInterface $groupManagement */
        $groupManagement = $this->objectManager->get(\Magento\Customer\Api\GroupManagementInterface::class);
        $defaultGroup = $groupManagement->getDefaultGroup();
        return $defaultGroup->getTaxClassId();
    }

    /**
     * Create tax rules
     *
     * @param array $overrides
     * @return $this
     */
    protected function createTaxRules($overrides)
    {
        $taxRateIds = [];
        foreach ($this->taxRates as $taxRateCode => $taxRate) {
            $taxRateIds[$taxRateCode] = $taxRate['id'];
        }

        //The default customer tax class id is used to calculate store tax rate
        $customerClassIds = [
            $this->customerTaxClasses[self::CUSTOMER_TAX_CLASS_1],
            $this->getDefaultCustomerTaxClassId()
        ];

        //By default create tax rule that covers all product tax classes except SHIPPING_TAX_CLASS
        //The tax rule will cover all tax rates except TAX_RATE_SHIPPING
        $taxRuleDefaultData = [
            'code' => 'Test Rule',
            'priority' => '0',
            'position' => '0',
            'customer_tax_class_ids' => $customerClassIds,
            'product_tax_class_ids' => $this->getProductTaxClassIds(),
            'tax_rate_ids' => $this->getDefaultTaxRateIds(),
        ];

        //Create tax rules
        if (empty($overrides[self::TAX_RULE_OVERRIDES])) {
            //Create separate shipping tax rule
            $shippingTaxRuleData = [
                'code' => 'Shipping Tax Rule',
                'priority' => '0',
                'position' => '0',
                'customer_tax_class_ids' => $customerClassIds,
                'product_tax_class_ids' => [$this->productTaxClasses[self::SHIPPING_TAX_CLASS]],
                'tax_rate_ids' => [$this->taxRates[self::TAX_RATE_SHIPPING]['id']],
            ];
            $this->taxRules[$shippingTaxRuleData['code']] = $this->objectManager
                ->create(\Magento\Tax\Model\Calculation\Rule::class)
                ->setData($shippingTaxRuleData)
                ->save()
                ->getId();

            //Create a default tax rule
            $this->taxRules[$taxRuleDefaultData['code']] = $this->objectManager
                ->create(\Magento\Tax\Model\Calculation\Rule::class)
                ->setData($taxRuleDefaultData)
                ->save()
                ->getId();
        } else {
            foreach ($overrides[self::TAX_RULE_OVERRIDES] as $taxRuleOverrideData) {
                //convert code to id for productTaxClass, customerTaxClass and taxRate
                $taxRuleOverrideData = $this->processTaxRuleOverrides($taxRuleOverrideData, $taxRateIds);
                $mergedTaxRuleData = $taxRuleDefaultData + $taxRuleOverrideData;
                $this->taxRules[$mergedTaxRuleData['code']] = $this->objectManager
                    ->create(\Magento\Tax\Model\Calculation\Rule::class)
                    ->setData($mergedTaxRuleData)
                    ->save()
                    ->getId();
            }
        }

        return $this;
    }

    /**
     * Set up tax classes, tax rates and tax rules
     * The override structure:
     * override['self::CONFIG_OVERRIDES']
     *      [
     *          [config_path => config_value]
     *      ]
     * override['self::TAX_RATE_OVERRIDES']
     *      [
     *          ['tax_rate_code' => tax_rate]
     *      ]
     * override['self::TAX_RULE_OVERRIDES']
     *      [
     *          [
     *              'code' => code //Required, has to be unique
     *              'priority' => 0
     *              'position' => 0
     *              'tax_customer_class' => array of customer tax class names as defined in this class
     *              'tax_product_class' => array of product tax class names as defined in this class
     *              'tax_rate' => array of tax rate codes as defined in this class
     *          ]
     *      ]
     *
     * @param array $overrides
     * @return void
     */
    public function setupTax($overrides)
    {
        //Create product tax classes
        $this->createProductTaxClasses();

        //Create customer tax classes
        $this->createCustomerTaxClasses();

        //Create tax rates
        $this->createTaxRates($overrides);

        //Create tax rules
        $this->createTaxRules($overrides);

        //Create nexus addresses
        $this->createNexusAddresses($overrides);

        //Tax calculation configuration
        if (!empty($overrides[self::CONFIG_OVERRIDES])) {
            $this->setConfig($overrides[self::CONFIG_OVERRIDES]);
        }
    }

    /**
     * Create a simple product with given sku, price and tax class
     *
     * @param string $sku
     * @param float $price
     * @param int $taxClassId
     * @param array $attributes
     * @return \Magento\Catalog\Model\Product
     */
    public function createSimpleProduct($sku, $price, $taxClassId, $attributes = [])
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->objectManager->create(\Magento\Catalog\Model\Product::class);
        $product->isObjectNew(true);
        $product->setTypeId('simple')
            ->setAttributeSetId(4)
            ->setName('Simple Product ' . $sku)
            ->setSku($sku)
            ->setPrice($price)
            ->setTaxClassId($taxClassId)
            ->setWebsiteIds([1])
            ->setStockData(
                [
                    'use_config_manage_stock' => 1,
                    'qty' => 100,
                    'is_qty_decimal' => 0,
                    'is_in_stock' => 1
                ]
            )->setMetaTitle('meta title')
            ->setMetaKeyword('meta keyword')
            ->setMetaDescription('meta description')
            ->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
            ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);

        foreach ($attributes as $attributeKey => $attribute) {
            $product->setData($attributeKey, $attribute);
        }

        $product->save();

        $product = $product->load($product->getId());
        return $product;
    }

    public function createConfigurableProduct($sku, $price, $taxClassId, $itemData)
    {
        /* Create simple products per each option value*/
        $options = $itemData['options'];
        $attribute = $this->createConfigurableProductAttribute('test_attribute', $options);
        $options = $attribute->getOptions();
        $attributeValues = [];
        $attributeSetId = 4;
        $associatedProductIds = [];

        array_shift($options); //remove the first option which is empty

        foreach ($options as $optionKey => $option) {
            $optionSku = $sku . '-option-' . $optionKey;
            $optionAttribute = [
                'test_attribute' => $option->getValue()
            ];
            $attributeValues[] = [
                'label' => 'test',
                'attribute_id' => $attribute->getId(),
                'value_index' => $option->getValue(),
            ];

            $associatedProductIds[] = $this
                ->createSimpleProduct($optionSku, $price, $taxClassId, $optionAttribute)
                ->getId();
        }

        /** @var $product \Magento\Catalog\Model\Product */
        $product = $this->objectManager->create(\Magento\Catalog\Model\Product::class);
        $product->setTypeId(self::PRODUCT_TYPE_CONFIGURABLE)
            ->setAttributeSetId($attributeSetId)
            ->setName('Configurable Product')
            ->setSku($sku)
            ->setWebsiteIds([1])
            ->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
            ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
            ->setStockData(
                [
                    'use_config_manage_stock' => 1,
                    'qty' => 100,
                    'is_qty_decimal' => 0,
                    'is_in_stock' => 1
                ]
            )
            ->setCanSaveConfigurableAttributes(true)
            ->setConfigurableAttributesData(
                [
                    [
                        'attribute_id' => $attribute->getId(),
                        'attribute_code' => $attribute->getAttributeCode(),
                        'frontend_label' => 'test',
                        'values' => $attributeValues,
                    ],
                ]
            );
        $product->setAssociatedProductIds($associatedProductIds);
        $product->save();

        return $product;
    }

    protected function createConfigurableProductAttribute($attributeCode, $options)
    {
        $eavConfig = $this->objectManager->get(\Magento\Eav\Model\Config::class);
        $attribute = $eavConfig->getAttribute('catalog_product', 'test_configurable');
        if ($attribute instanceof \Magento\Eav\Model\Entity\Attribute\AbstractAttribute
            && $attribute->getId()
        ) {
            $attribute->delete();
        }
        $eavConfig->clear();
        /* Create attribute */
        /** @var $installer \Magento\Catalog\Setup\CategorySetup */
        $installer = $this->objectManager->create(\Magento\Catalog\Setup\CategorySetup::class);

        /** @var $attribute \Magento\Catalog\Model\ResourceModel\Eav\Attribute */
        $attribute = $this->objectManager->create(
            \Magento\Catalog\Model\ResourceModel\Eav\Attribute::class
        );
        $attribute->setData(
            [
                'attribute_code' => $attributeCode,
                'entity_type_id' => $installer->getEntityTypeId('catalog_product'),
                'is_global' => 1,
                'is_user_defined' => 1,
                'frontend_input' => 'select',
                'is_unique' => 0,
                'is_required' => 1,
                'is_searchable' => 0,
                'is_visible_in_advanced_search' => 0,
                'is_comparable' => 0,
                'is_filterable' => 0,
                'is_filterable_in_search' => 0,
                'is_used_for_promo_rules' => 0,
                'is_html_allowed_on_front' => 1,
                'is_visible_on_front' => 0,
                'used_in_product_listing' => 0,
                'used_for_sort_by' => 0,
                'frontend_label' => ['Test Configurable'],
                'default_value' => 'Test Configurable',
                'backend_type' => 'int',
                'option' => $options
            ]
        );
        $attribute->save();

        /* Assign attribute to attribute set */
        $installer->addAttributeToGroup('catalog_product', 'Default', 'General', $attribute->getId());

        /** @var \Magento\Eav\Model\Config $eavConfig */
        $eavConfig = $this->objectManager->get(\Magento\Eav\Model\Config::class);
        $eavConfig->clear();

        $this->configurableProductAttributes[$attributeCode] = $attribute;

        return $attribute;
    }

    protected function createConfigurableProductRequestInfo($qty)
    {
        $attribute = $this->configurableProductAttributes['test_attribute'];
        $options = $attribute->getOptions();
        $superAttributes = [];

        array_shift($options);

        $superAttributes[$attribute->getId()] = $options[0]->getValue();

        $requestInfo = new \Magento\Framework\DataObject([
            'qty' => $qty,
            'super_attribute' => $superAttributes
        ]);

        return $requestInfo;
    }

    /**
     * Create a customer group and associated it with given customer tax class
     *
     * @param int $customerTaxClassId
     * @return int
     */
    protected function createCustomerGroup($customerTaxClassId)
    {
        /** @var \Magento\Customer\Api\GroupRepositoryInterface $groupRepository */
        $groupRepository = $this->objectManager->create(\Magento\Customer\Api\GroupRepositoryInterface::class);
        $customerGroupFactory = $this->objectManager->create(\Magento\Customer\Api\Data\GroupInterfaceFactory::class);
        $customerGroup = $customerGroupFactory->create()
            ->setCode('custom_group')
            ->setTaxClassId($customerTaxClassId);
        $customerGroupId = $groupRepository->save($customerGroup)->getId();
        return $customerGroupId;
    }

    /**
     * Create a customer
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    protected function createCustomer()
    {
        $customerGroupId = $this->createCustomerGroup($this->customerTaxClasses[self::CUSTOMER_TAX_CLASS_1]);
        /** @var \Magento\Customer\Model\Customer $customer */
        $customer = $this->objectManager->create(\Magento\Customer\Model\Customer::class);
        $customer->isObjectNew(true);
        $customer->setWebsiteId(1)
            ->setEntityTypeId(1)
            ->setAttributeSetId(1)
            ->setEmail('customer@example.com')
            ->setPassword('password')
            ->setGroupId($customerGroupId)
            ->setStoreId(1)
            ->setIsActive(1)
            ->setFirstname('Firstname')
            ->setLastname('Lastname')
            ->save();

        return $this->customerRepository->getById($customer->getId());
    }

    /**
     * Create customer address
     *
     * @param array $addressOverride
     * @param int $customerId
     * @return \Magento\Customer\Model\Address
     */
    protected function createCustomerAddress($addressOverride, $customerId)
    {
        $defaultAddressData = [
            'attribute_set_id' => 2,
            'telephone' => 3468676,
            'postcode' => self::AUSTIN_POST_CODE,
            'country_id' => self::COUNTRY_US,
            'city' => 'CityM',
            'company' => 'CompanyName',
            'street' => ['Green str, 67'],
            'lastname' => 'Smith',
            'firstname' => 'John',
            'parent_id' => 1,
            'region_id' => self::REGION_TX,
        ];
        $addressData = array_merge($defaultAddressData, $addressOverride);

        /** @var \Magento\Customer\Model\Address $customerAddress */
        $customerAddress = $this->objectManager->create(\Magento\Customer\Model\Address::class);
        $customerAddress->setData($addressData)
            ->setCustomerId($customerId)
            ->save();

        return $customerAddress;
    }

    /**
     * Create shopping cart rule
     *
     * @param array $ruleDataOverride
     * @return $this
     */
    protected function createCartRule($ruleDataOverride)
    {
        /** @var \Magento\SalesRule\Model\Rule $salesRule */
        $salesRule = $this->objectManager->create(\Magento\SalesRule\Model\Rule::class);
        $ruleData = array_merge($this->defaultShoppingCartPriceRule, $ruleDataOverride);
        $salesRule->setData($ruleData);
        $salesRule->save();

        return $this;
    }

    /**
     * Create a quote object with customer
     *
     * @param array $quoteData
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     * @return \Magento\Quote\Model\Quote
     */
    protected function createQuote($quoteData, $customer)
    {
        /** @var \Magento\Customer\Api\AddressRepositoryInterface $addressService */
        $addressService = $this->objectManager->create(\Magento\Customer\Api\AddressRepositoryInterface::class);

        /** @var array $shippingAddressOverride */
        $shippingAddressOverride = empty($quoteData['shipping_address']) ? [] : $quoteData['shipping_address'];
        /** @var  \Magento\Customer\Model\Address $shippingAddress */
        $shippingAddress = $this->createCustomerAddress($shippingAddressOverride, $customer->getId());

        /** @var \Magento\Quote\Model\Quote\Address $quoteShippingAddress */
        $quoteShippingAddress = $this->objectManager->create(\Magento\Quote\Model\Quote\Address::class);
        $quoteShippingAddress->importCustomerAddressData($addressService->getById($shippingAddress->getId()));

        /** @var array $billingAddressOverride */
        $billingAddressOverride = empty($quoteData['billing_address']) ? [] : $quoteData['billing_address'];
        /** @var  \Magento\Customer\Model\Address $billingAddress */
        $billingAddress = $this->createCustomerAddress($billingAddressOverride, $customer->getId());

        /** @var \Magento\Quote\Model\Quote\Address $quoteBillingAddress */
        $quoteBillingAddress = $this->objectManager->create(\Magento\Quote\Model\Quote\Address::class);
        $quoteBillingAddress->importCustomerAddressData($addressService->getById($billingAddress->getId()));

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->objectManager->create(\Magento\Quote\Model\Quote::class);
        $quote->setStoreId(1)
            ->setIsActive(true)
            ->setIsMultiShipping(false)
            ->assignCustomerWithAddressChange($customer, $quoteBillingAddress, $quoteShippingAddress)
            ->setCheckoutMethod('register')
            ->setPasswordHash($this->accountManagement->getPasswordHash(static::CUSTOMER_PASSWORD));

        return $quote;
    }

    /**
     * Add products to quote
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param array $itemsData
     * @return $this
     */
    protected function addProductToQuote($quote, $itemsData)
    {
        foreach ($itemsData as $itemData) {
            $sku = $itemData['sku'];
            $price = $itemData['price'];
            $qty = isset($itemData['qty']) ? $itemData['qty'] : 1;
            $taxClassName =
                isset($itemData['tax_class_name']) ? $itemData['tax_class_name'] : self::PRODUCT_DEFAULT_TAX_CLASS;
            $taxClassId = isset($this->productTaxClasses[$taxClassName]) ? $this->productTaxClasses[$taxClassName] : 0;

            switch ($itemData['type']) {
                case self::PRODUCT_TYPE_CONFIGURABLE:
                    $product = $this->createConfigurableProduct($sku, $price, $taxClassId, $itemData);
                    $request = $this->createConfigurableProductRequestInfo($qty);
                    break;
                default:
                    $product = $this->createSimpleProduct($sku, $price, $taxClassId);
                    $request = $qty;
                    break;
            }

            $quote->addProduct($product, $request);
        }
        return $this;
    }

    /**
     * Create a quote based on given data
     *
     * @param array $quoteData
     * @return \Magento\Quote\Model\Quote
     */
    public function setupQuote($quoteData)
    {
        $customer = $this->createCustomer();

        $quote = $this->createQuote($quoteData, $customer);

        $this->addProductToQuote($quote, $quoteData['items']);

        //Set shipping amount
        if (isset($quoteData['shipping'])) {
            $quote->getShippingAddress()->setShippingMethod($quoteData['shipping']['method'])
                ->setShippingDescription($quoteData['shipping']['description'])
                ->setShippingAmount($quoteData['shipping']['amount'])
                ->setBaseShippingAmount($quoteData['shipping']['base_amount'])
                ->save();
            $quote->getShippingAddress()->setCollectShippingRates(true);
        }

        if (isset($quoteData['currency'])) {
            $this->addCurrencyToQuote($quote, $quoteData['currency']);
        }

        //create shopping cart rules if necessary
        if (!empty($quoteData['shopping_cart_rules'])) {
            foreach ($quoteData['shopping_cart_rules'] as $ruleData) {
                $ruleData['customer_group_ids'] = [$customer->getGroupId()];
                $this->createCartRule($ruleData);
            }
        }

        return $quote;
    }

    /**
     * Create nexus addresses
     *
     * @param array $overrides
     * @return void
     */
    protected function createNexusAddresses($overrides)
    {
        $addresses = empty($overrides[self::NEXUS_OVERRIDES])
            ? $this->nexusAddresses
            : $overrides[self::NEXUS_OVERRIDES];

        foreach ($addresses as $address) {
            $nexusModel = $this->objectManager->create('Taxjar\SalesTax\Model\Tax\Nexus')
                ->setApiId(0)
                ->setStreet($address['street'])
                ->setCity($address['city'])
                ->setCountryId($address['country_id'])
                ->setRegion($address['region'])
                ->setPostcode($address['postcode']);

            if (isset($address['region_id'])) {
                $nexusModel->setRegionId($address['region_id']);
            }

            if (isset($address['region_code'])) {
                $nexusModel->setRegionCode($address['region_code']);
            }

            $nexusModel->save();
        }
    }

    /**
     * Add currency with conversion rate to quote
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param array $currencyData
     * @return $this
     */
    protected function addCurrencyToQuote($quote, $currencyData)
    {
        $currency = $this->objectManager->get(\Magento\Directory\Model\Currency::class);
        $baseCurrencyCode = $currencyData['base_code'];
        $activeCurrencyCode = $currencyData['active_code'];
        $conversionRate = $currencyData['conversion_rate'];

        $currency->saveRates([
            $baseCurrencyCode => [
                $activeCurrencyCode => $conversionRate
            ]
        ]);

        $quote->getStore()->getCurrentCurrency()->setData('currency_code', $activeCurrencyCode);
        $quote->save();

        return $this;
    }
}
