<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\View\Helper\Dialog;

use Zend\View\Helper\Url as UrlHelper,
    CmsTwbs\Form\View\Helper\Decorator\Btn as BtnHelper;

class Confirm extends AbstractDialog
{
    /**
     * @var string
     */
    protected $resultKey = 'result';

    /**
     * @var UrlHelper
     */
    protected $urlHelper;

    /**
     * @var string
     */
    protected $defaultUrlHelper = 'url';

    /**
     * {@inheritDoc}
     */
    public function __invoke($content = null, array $attribs = [], $title = null, $resultKey = null)
    {
        if (func_num_args() === 0) {
            return $this;
        }

        return $this->render($content, $attribs, $title, $resultKey);
    }

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], $title = null, $resultKey = null)
    {
        $panelHelper = $this->getPanelHelper();
        return $panelHelper($content, $attribs, $title, $this->renderFooter($resultKey ?: $this->resultKey));
    }

    /**
     * @return string
     */
    private function renderFooter($resultKey)
    {
        $buttonHelper = $this->getButtonHelper();
        $urlHelper = $this->getUrlHelper();

        $markup  = '<form action="' . $urlHelper(null, [], true) . '" method="post">';
        $markup .= sprintf(
            '%s %s',
            $buttonHelper('OK',     ['class' => 'btn-primary btn-inline', 'name' => $resultKey, 'value' => 1]),
            $buttonHelper('Cancel', ['class' => 'btn-default btn-inline', 'name' => $resultKey, 'value' => 0])
        );

        $markup .= '</form>';

        return $markup;
    }

    /**
     * @param string $key
     * @return self
     */
    public function setResultKey($key)
    {
        $this->resultKey = $key;

        return $this;
    }

    /**
     * @return UrlHelper
     */
    protected function getUrlHelper()
    {
        if ($this->urlHelper) {
            return $this->urlHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->urlHelper = $this->view->plugin($this->defaultUrlHelper);
        }

        if (!$this->urlHelper instanceof UrlHelper) {
            $this->urlHelper = new UrlHelper();
            $this->urlHelper->setView($this->getView());
        }

        return $this->urlHelper;
    }
}
