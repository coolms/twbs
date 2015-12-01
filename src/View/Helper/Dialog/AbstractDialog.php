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

use CmsCommon\View\Helper\HtmlContainer,
    CmsTwbs\Form\View\Helper\Decorator\Btn as ButtonHelper,
    CmsTwbs\View\Helper\Panel as PanelHelper;

abstract class AbstractDialog extends HtmlContainer
{
    /**
     * @var PanelHelper
     */
    protected $panelHelper;

    /**
     * @var string
     */
    protected $defaultPanelHelper = 'panel';

    /**
     * @var ButtonHelper
     */
    protected $buttonHelper;

    /**
     * @var string
     */
    protected $defaultButtonHelper = 'btn';

    /**
     * @param string $content
     * @param array $attribs
     * @param string $title
     * @return self|string
     */
    public function __invoke($content = null, array $attribs = [], $title = null)
    {
        if (func_num_args() === 0) {
            return $this;
        }

        return $this->render($content, $attribs, $title);
    }

    /**
     * @param string $content
     * @param array $attribs
     * @param string $title
     * @return string
     */
    public function render($content, array $attribs = [], $title = null)
    {
        $panelHelper = $this->getPanelHelper();
        return $panelHelper($content, $attribs, $title);
    }

    /**
     * @return PanelHelper
     */
    protected function getPanelHelper()
    {
        if ($this->panelHelper) {
            return $this->panelHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->panelHelper = $this->view->plugin($this->defaultPanelHelper);
        }

        if (!$this->panelHelper instanceof PanelHelper) {
            $this->panelHelper = new PanelHelper();
            $this->panelHelper->setView($this->getView());
        }

        return $this->panelHelper;
    }

    /**
     * @return ButtonHelper
     */
    protected function getButtonHelper()
    {
        if ($this->buttonHelper) {
            return $this->buttonHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->buttonHelper = $this->view->plugin($this->defaultButtonHelper);
        }

        if (!$this->buttonHelper instanceof ButtonHelper) {
            $this->buttonHelper = new ButtonHelper();
            $this->buttonHelper->setView($this->getView());
        }

        return $this->buttonHelper;
    }
}
