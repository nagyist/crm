<?php

namespace Oro\Bundle\SalesBundle\Datagrid\Extension\Customers;

use Oro\Bundle\AccountBundle\Entity\Account;

use Oro\Bundle\DataGridBundle\Datagrid\Common\DatagridConfiguration;
use Oro\Bundle\DataGridBundle\Datasource\Orm\OrmDatasource;

class AccountRelatedEntitiesExtension extends RelatedEntitiesExtension
{
    /**
     * {@inheritdoc}
     */
    public function isApplicable(DatagridConfiguration $config)
    {
        return
            $config->getDatasourceType() === OrmDatasource::TYPE &&
            $this->parameters->get('customer_class') === Account::class &&
            $this->parameters->get('related_entity_class') === $this->relatedEntityClass &&
            $this->parameters->get('customer_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function getCustomerField($customerClass)
    {
        return 'account';
    }
}
