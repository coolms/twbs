<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Datagrid;

use RuntimeException,
    Zend\Http\PhpEnvironment\Request as HttpRequest,
    CmsDatagrid\Column,
    CmsDatagrid\Datagrid,
    CmsDatagrid\Filter,
    CmsDatagrid\Renderer\AbstractRenderer;

class Renderer extends AbstractRenderer
{
    /**
     * {@inheritDoc}
     */
    public function isExport()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function isHtml()
    {
        return true;
    }

    /**
     * @return HttpRequest
     * @throws RuntimeException
     */
    public function getRequest()
    {
        $request = parent::getRequest();

        if (!$request instanceof HttpRequest) {
            throw new RuntimeException(sprintf(
                'Request must be an instance of %s for HTML rendering',
                HttpRequest::class
            ));
        }

        return $request;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Exception
     */
    public function getSortConditions()
    {
        if (is_array($this->sortConditions)) {
            // set from cache! (for export)
            return $this->sortConditions;
        }

        $request = $this->getRequest();

        $optionsRenderer = $this->getOptionsRenderer();
        $parameterNames  = $optionsRenderer['parameterNames'];

        $sortConditions = [];
        $sortColumns = $request->getPost(
            $parameterNames['sortColumns'],
            $request->getQuery($parameterNames['sortColumns'])
        );
        $sortDirections = $request->getPost(
            $parameterNames['sortDirections'],
            $request->getQuery($parameterNames['sortDirections'])
        );

        if ($sortColumns != '') {
            $sortColumns    = explode(',', $sortColumns);
            $sortDirections = explode(',', $sortDirections);

            if (count($sortColumns) != count($sortDirections)) {
                throw new \Exception('Count missmatch order columns/direction');
            }

            foreach ($sortColumns as $key => $sortColumn) {
                $sortDirection = strtoupper($sortDirections[$key]);

                if ($sortDirection != 'ASC' && $sortDirection != 'DESC') {
                    $sortDirection = 'ASC';
                }

                /* @var $column Column\AbstractColumn */
                foreach ($this->getColumns() as $column) {
                    if ($column->getUniqueId() == $sortColumn) {
                        $sortConditions[] = [
                            'sortDirection' => $sortDirection,
                            'column'        => $column,
                        ];

                        $column->setSortActive($sortDirection);
                    }
                }
            }
        }

        if (!empty($sortConditions)) {
            $this->sortConditions = $sortConditions;
        } else {
            // No user sorting -> get default sorting
            $this->sortConditions = $this->getSortConditionsDefault();
        }

        return $this->sortConditions;
    }

    /**
     * {@inheritDoc}
     *
     * @todo Make parameter config
     */
    public function getFilters()
    {
        if (is_array($this->filters)) {
            return $this->filters;
        }

        $request = $this->getRequest();

        $filters = [];
        if (($request->isPost() === true || $request->isGet() === true) &&
            ($toolbarFilters = $request->getPost('toolbarFilters', $request->getQuery('toolbarFilters'))) !== null
        ) {
            foreach ($toolbarFilters as $uniqueId => $value) {
                if ($value == '') continue;
                /* @var $column Column\AbstractColumn */
                foreach ($this->getColumns() as $column) {
                    if ($column->getUniqueId() == $uniqueId) {
                        $filter = new Filter();
                        $filter->setFromColumn($column, $value);

                        $filters[] = $filter;

                        $column->setFilterActive($filter->getDisplayColumnValue());
                    }
                }
            }
        }

        if (!empty($filters)) {
            $this->filters = $filters;
        } else {
            // No user sorting -> get default sorting
            $this->filters = $this->getFiltersDefault();
        }

        return $this->filters;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getCurrentPageNumber()
    {
        $optionsRenderer = $this->getOptionsRenderer();
        $parameterNames  = $optionsRenderer['parameterNames'];

        $request = $this->getRequest();
        if ($request instanceof HttpRequest) {
            $this->currentPageNumber = (int) $request->getPost(
                $parameterNames['currentPage'],
                $request->getQuery($parameterNames['currentPage'], 1)
            );
        }

        return (int) $this->currentPageNumber;
    }

    /**
     * {@inheritDoc}
     */
    public function prepareViewModel(Datagrid $grid)
    {
        parent::prepareViewModel($grid);

        $options = $this->getOptionsRenderer();

        $viewModel = $this->getViewModel();

        // Check if the datarange picker is enabled
        if (isset($options['daterange']['enabled']) && $options['daterange']['enabled'] === true) {
            $dateRangeParameters = $options['daterange']['options'];

            $viewModel->setVariable('daterangeEnabled', true);
            $viewModel->setVariable('daterangeParameters', $dateRangeParameters);
        } else {
            $viewModel->setVariable('daterangeEnabled', false);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function execute()
    {
        $viewModel = $this->getViewModel();
        $viewModel->setTemplate($this->getTemplate());

        return $viewModel;
    }
}
